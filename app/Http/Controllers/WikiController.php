<?php

namespace App\Http\Controllers;

use App\Models\{
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
    public function _filter($text, $deep = false) {
        if($deep) {
            return strip_tags($text);
        }
        $tags = 'a|b|i|u|h|ul|ol|li|strong|code|pre';
        return preg_replace(
            "/<({$tags}) [^>]*>/", "<$1>",
            strip_tags(
                $text,
                explode('|', $tags)
            )
        );
    }
    public function store(StorewikiRequest $request)
    {
        $wiki = Wiki::create([
            'user_id' => Auth::id(),
            'type' => 'wiki',
            'stack' => $request->stack,
            'file_id' => $request->file_id,
            'title' => $this->_filter($request->title),
            'category_id' => $request->category_id,
            'overview' => $this->_filter($request->overview, true),
            'requirements' => $this->_filter($request->requirements),
            'snippets' => $this->_filter($request->snippets, true),
            'examples' => $this->_filter($request->examples),
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
                ->with('file', $dir);
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

    public function update(UpdatewikiRequest $request, $id)
    {
        $wiki = Wiki::findOrFail($id)->update([
            'content' => $request->content
        ]);
        return redirect(route('wiki.show', compact('wiki')));
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
        $wikis = Wiki::where('type', 'wiki')
            ->where(function($query) {
                // if(request()->has('stack')) {
                //     $query->category()->has('name', request()->stack);
                // }
                if(request()->has('keyword')) {
                    $query->where(DB::raw('lower(title)'), 'like', '%'.request()->keyword.'%')
                        ->orderBy('downloads', 'desc')
                        ->latest('updated_at');
                } else {
                    $query->latest();
                }
            })
            ->paginate(12);
        return view('wiki.library', compact('wikis'));
    }

    public function searchAPI(Request $request) {
        $keyword = strtolower($request->keyword);
        $wiki = Wiki::select('title', 'id')
            ->where('type', 'wiki')
            ->where(DB::raw('lower(title)'), 'like', "%{$keyword}%")
            ->where(function($query) {
                // if(request()->has('stack')) {
                //     $query->whereHas('category', function(Builder $queryc){
                //         $queryc->where('name', request()->stack);
                //     });
                // }
            })
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
