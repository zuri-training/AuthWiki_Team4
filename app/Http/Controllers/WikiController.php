<?php

namespace App\Http\Controllers;

use App\Models\{
    Category,
    Wiki,
    Reaction,
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
    Http\Request
};

class WikiController extends Controller
{
    public function __construct()
    {
        // $this->middleware(['auth', 'verified'])->only('rating');
        // $this->authorizeResource(Wiki::class, 'wiki');
        $this->middleware('auth')->except(['index', 'show', 'search', 'downloadZip']);
        $this->middleware('isAdmin')->only(['create', 'uploadZip', 'store', 'edit', 'update', 'destroy']);
    }

    public function index(Request $request)
    {
        // $this->authorize('viewAny', Wiki::class);
        $keyword = strtolower($request->input('keyword'));
        $stack = strtolower($request->input('stack'));
        $wikis = Wiki::where(['type' => 'wiki', 'published' => 1])
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
                ->orWhere(DB::raw('lower(overview)'), 'like', "%{$keyword}%")
                ->orWhere(DB::raw('lower(contents)'), 'like', "%{$keyword}%")
                ->orderBy('downloads', 'desc')
                ->latest('updated_at');
            }, function($query){
                $query->latest();
            })
            ->paginate(12);
        return view('wiki.index', compact('wikis'));
    }
    public function create()
    {
        // $this->authorize('create', Wiki::class);
        return view('wiki.create');
    }
    public function store(StoreWikiRequest $request)
    {
        // $this->authorize('create', Wiki::class);
        $wiki = Wiki::create([
            'user_id' => Auth::id(),
            'type' => $request->type,
            'category_id' => $request->category,
            'title' => $request->title,
            'overview' => $request->overview,
            'contents' => $request->contents,
            'published' => 1
        ]);
        File::find($request->file)->update([
            'wiki_id' => $wiki->id
        ]);
        return redirect(route('library.show', ['wiki' => $wiki->id]));
    }
    public function show(Wiki $wiki)
    {
        // $this->authorize('view', Wiki::class);
        if($wiki->published) {
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
        abort(403);
    }
    public function edit(Wiki $wiki)
    {
        // $this->authorize('update', Wiki::class);
        if(Auth::id() == $wiki->user_id) {
            return view('wiki.edit', compact('wiki'));
        }
        abort(403);
    }
    public function update(UpdateWikiRequest $request, Wiki $wiki)
    {
        // $this->authorize('update', Wiki::class);
        if(Auth::id() == $wiki->user_id) {
            $wiki->update([
                'overview' => $request->overview,
                'contents' => $request->contents,
                'published' => $request->published
            ]);
            return redirect(route('wiki.show', compact('wiki')));
        }
        abort(403);
    }
    public function destroy(Wiki $wiki)
    {
        // $this->authorize('delete', Wiki::class);
        if(Auth::id() == $wiki->user_id) {
            $wiki->delete();
            return redirect(route('page.library'));
        }
        abort(403);
    }

    public function search(Request $request)
    {
        // $this->authorize('viewAny', Wiki::class);
        $keyword = strtolower($request->input('keyword'));
        $stack = strtolower($request->input('stack'));
        $wiki = Wiki::select('title', 'id')
            ->where(['type' => 'wiki', 'published' => 1])
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
    public function uploadZip(Request $request)
    {
        // $this->authorize('create', Wiki::class);
        $request->validate([
          'file' => 'required|mimes:zip|max:5120'
        ]);
        if($request->file()) {
            $id = Auth::id();
            $file = $request->file('file');
            $name = md5(time() .'_'. $file->getClientOriginalName()). '.' .$file->getClientOriginalExtension();
            $path = $file->storePubliclyAs("user_{$id}", $name, 'public');
            $dir = File::create([
                'user_id' => $id,
                'name' => $name,
                'path' => 'storage/'.$path
            ]);
            return redirect()
                ->to(route('library.create').'?file='.$dir->id)
                ->with('success','File uploaded.');
        }
    }
    public function downloadZip(Wiki $wiki)
    {
        // $this->authorize('view', $wiki);
        $file = File::where('wiki_id', $wiki->id);
        if($wiki && $file->exists()) {
            $get = $file->first();
            if(file_exists($get->path)) {
                $wiki->increment('downloads');
                $wiki->touch('downloaded_at');
                Log::updateOrCreate([
                    'user_id' => Auth::id()
                ],
                [
                    'file_id' => $get->id
                ]);
                return response()->download($get->path, $get->name);
            } else {
                return redirect(route('library.show', ['wiki' => $wiki->id]))->with('error', 'File error!');
            }
        }
        return redirect(route('library.show', ['wiki' => $wiki->id]))->with('error', 'No file associated with the request');
    }
    public function rating(Request $request, Wiki $wiki)
    {
        // $this->authorize('view', $wiki);
        $request->validate([
            'rating' => 'required|numeric|between:0,5'
        ]);
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