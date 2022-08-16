<?php

namespace App\Http\Controllers;

use App\Models\{
    Category,
    Wiki,
    Reaction,
    User,
    File,
    Log
};
use App\Http\Requests\{
    StoreWikiRequest,
    UpdateWikiRequest
};
use Illuminate\{
    Support\Facades\Auth,
    Support\Facades\DB,
    Http\Request,
    Support\Facades\Validator,
    Support\Facades\Storage
};

class WikiController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only(['rating', 'downloadZip']);
        $this->middleware('verified')->only(['indexID', 'uploadZip', 'edit', 'update']);
        $this->middleware('isAdmin')->only(['create', 'store']);
    }

    public function index()
    {
        $wiki =  Wiki::where('type', 'wiki')
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('wiki.index', compact('wiki'));
    }

    public function create()
    {
        return view('wiki.create');
    }
    public function store(StoreWikiRequest $request)
    {
        $wiki = Wiki::create([
            'user_id' => Auth::id(),
            'type' => $request->type,
            'category_id' => $request->category,
            'title' => $request->title,
            'overview' => $request->overview,
            'contents' => $request->contents
        ]);
        File::find($request->file)->update([
            'wiki_id' => $wiki->id
        ]);
        return redirect(route('library.show', ['id' => $wiki->id]));
    }
    public function uploadZip(Request $request){
        $request->validate([
          'file' => 'required|mimes:zip|max:5120'
        ]);
        if($request->file()) {
            $id = Auth::id();
            $file = $request->file('file');
            $name = md5(time() .'_'. $file->getClientOriginalName()). '.' .$file->getClientOriginalExtension();
            $path = $file->storeAs("user_{$id}", $name, 'public');
            $dir = File::create([
                'user_id' => $id,
                'name' => $name,
                'path' => $path
            ]);
            return redirect()
                ->to(route('library.create').'?file='.$dir->id)
                ->with('success','File uploaded.');
        }
    }
    public function downloadZip($id){
        $wiki = Wiki::find($id);
        $file = File::where('wiki_id', $wiki->id);
        if($wiki && $file->exists()) {
            $get = $file->first();
            $wiki->increment('downloads');
            $wiki->touch('downloaded_at');
            Log::updateOrCreate([
                'user_id' => Auth::id()
            ],
            [
                'file_id' => $get->id
            ]);
            return Storage::disk('public')->download($get->path, $get->name);
        }
        return redirect(route('page.library'))->with('error', 'No file associated with the request');
    }
    public function show($id)
    {
        $wiki = Wiki::findOrFail($id);
        $wiki->increment('views');
        $wiki->touch('viewed_at');
        if(Auth::check()) {
            Log::updateOrCreate([
                'user_id' => Auth::id()
            ],
            [
                'wiki_id' => $wiki->id
            ]);
        }
        return view('wiki.show', compact('wiki'));
    }

    public function edit(Wiki $wiki)
    {
        return view('wiki.edit', compact('wiki'));
    }

    public function update(UpdateWikiRequest $request, $id)
    {
        $wiki = Wiki::findOrFail($id)->update([
            'overview' => $request->overview,
            'contents' => $request->contents
        ]);
        return redirect(route('wiki.show', compact('id')));
    }

    public function destroy(Wiki $wiki)
    {
        $wiki->delete();
        return redirect(route('user.wiki'));
    }

    public function indexID(User $user)
    {
        $wiki =  Wiki::where(['type' => 'wiki', 'user_id' =>$user->id])
            ->latest('updated_at')
            ->paginate(10);
        return view('user.index', compact('wiki'));
    }

    public function search(Request $request) {
        $keyword = strtolower($request->input('keyword'));
        $stack = strtolower($request->input('stack'));
        $wikis = Wiki::where('type', 'wiki')
            ->when($stack, function($query, $stack) {
                $category = Category::where(DB::raw('lower(name)'), $stack)->first();
                if($category) {
                    $query->where('category_id', $category->id);
                } else {
                    $query->where('category_id', null);
                }
            })
            ->when($keyword, function($query, $keyword){
                $query->where(DB::raw('lower(title)'), 'like', "%{$keyword}%")
                ->orderBy('downloads', 'desc')
                ->latest('updated_at');
            }, function($query){
                $query->latest();
            })
            ->paginate(12);
        return view('wiki.library', compact('wikis'));
    }

    public function searchAPI(Request $request) {
        $keyword = strtolower($request->input('keyword'));
        $stack = strtolower($request->input('stack'));
        $wiki = Wiki::select('title', 'id')
            ->where('type', 'wiki')
            ->when($stack, function($query, $stack) {
                $category = Category::where(DB::raw('lower(name)'), $stack)->first();
                if($category) {
                    $query->where('category_id', $category->id);
                }
            })
            ->when($keyword, function($query, $keyword){
                $query->where(DB::raw('lower(title)'), 'like', "%{$keyword}%");
            })
            ->orderBy('downloads', 'desc')
            ->latest('updated_at')
            ->limit(5)
            ->get();
        return response()->json([
            'data' => $wiki
        ]);
    }
    public function rating(Request $request, $id)
    {
        $wiki = Wiki::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'rating' => 'required|numeric|between:0,5'
        ]);
        if($validator->fails() || !$wiki) {
            return response()->json([
                'status' => false
            ]);
        }
        Reaction::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'wiki_id' => $wiki->id,
                'comment_id' => null
            ],
            [
                'rating' => $request->rating,
            ]
        );
        return response()->json([
            'status' => true,
            'ratings' => $wiki->stars
        ]);
    }
}
