<?php

namespace App\Http\Controllers;

use App\Models\{
    Category,
    Wiki,
    Reaction,
    User,
    File
};
use App\Http\Requests\{
    StoreWikiRequest,
    UpdateWikiRequest
};
use Illuminate\{
    Database\Eloquent\Builder,
    Support\Facades\Auth,
    Support\Facades\DB,
    Http\Request,
    Support\Facades\Validator
};
use App\Helper\Helper;

class WikiController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only('rating');
        $this->middleware('verified')->except(['index', 'indexID', 'show', 'search', 'searchAPI']);
        $this->middleware('isAdmin')->only(['create', 'store', 'edit', 'update']);
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
            'type' => 'wiki',
            'stack' => $request->stack,
            'file_id' => $request->file_id,
            'title' => $request->title,
            'category_id' => $request->category_id,
            'overview' => $request->overview,
            'requirements' => $request->requirements,
            'snippets' => $request->snippets,
            'examples' => $request->examples,
            'links' => $request->links
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
                'file_dir' => '/storage/' . $path
            ]);
            return back()
                ->with('success','File has been uploaded.')
                ->with('file_id', $dir->id);
        }
    }

    public function show($id)
    {
        $wiki = Wiki::findOrFail($id);
        $wiki->increment('views');
        $wiki->touch('viewed_at');
        return view('wiki.show', compact('wiki'));
    }

    public function edit(Wiki $wiki)
    {
        return view('wiki.edit', compact('wiki'));
    }

    public function update(UpdateWikiRequest $request, $id)
    {
        $wiki = Wiki::findOrFail($id)->update([
            'content' => $request->content
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
        $keyword = $request->input('keyword');
        $stack = $request->input('stack');
        $wikis = Wiki::where('type', 'wiki')
            ->when($stack, function($query, $stack) {
                $category = Category::where('name', $stack)->first();
                if($category) {
                    $query->where('category_id', $category->id);
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
        $keyword = $request->input('keyword');
        $stack = $request->input('stack');
        $wiki = Wiki::select('title', 'id')
            ->where('type', 'wiki')
            ->when($stack, function($query, $stack) {
                $category = Category::where('name', $stack)->first();
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
