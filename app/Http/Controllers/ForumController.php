<?php

namespace App\Http\Controllers;

use App\Models\{
    Wiki,
    Reaction,
    User
};
use App\Http\Requests\{
    StoreWikiRequest,
    UpdateWikiRequest
};
use Illuminate\{
    Database\Eloquent\SoftDeletes,
    Support\Facades\Auth,
    Http\Request,
    Support\Facades\Validator
};

class ForumController extends Controller
{
    use SoftDeletes;

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'indexID', 'show', 'search', 'searchAPI']);
        $this->middleware('verified')->except('rating');
    }

    public function index()
    {
        $wiki =  Wiki::where('type', 'forum')
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('wiki.index', compact('wiki'));
    }

    public function create()
    {
        return view('wiki.create');
    }

    public function store(StorewikiRequest $request)
    {
        Wiki::create([
            'user_id' => Auth::id(),
            'type' => 'forum',
            'stack' => $request->stack,
            'file_dir' => $request->file_dir,
            'title' => $request->title,
            'content' => $request->content
        ]);
        return redirect(route('user.wiki'));
    }

    public function show(Wiki $wiki)
    {
        $wiki->touch('viewed_at');
        $wiki->increment('views');
        return view('wiki.show', compact('wiki'));
    }

    public function edit(Wiki $wiki)
    {
        return view('wiki.edit', compact('wiki'));
    }

    public function update(UpdatewikiRequest $request, Wiki $wiki)
    {
        $wiki->update([
            'content' => $request->content
        ]);
        return redirect(route('wiki.show', compact('wiki')));
    }

    public function destroy(Wiki $wiki)
    {
        $wiki->softDelete();
        return redirect(route('user.wiki'));
    }

    public function destroyPerm(Wiki $wiki)
    {
        $wiki->forceDelete();
        return redirect(route('user.wiki'));
    }

    public function indexID(User $user)
    {
        $wiki =  $user->wiki()
            ->where('type', 'forum')
            ->latest('updated_at')
            ->paginate(10);
        return view('user.index', compact('wiki'));
    }

    public function search(Request $request) {
        $request->validate([
            'keyword' => 'required|string|max:25',
            'stack' => 'string|max:10'
        ]);
        $keyword = $request->keyword;
        $wiki = Wiki::where('type', 'forum')
            ->where('title', 'LIKE', "%{$keyword}%")
            ->where(function($query) {
                if(request()->has('stack')) {
                    $query->where('stack', request()->stack);
                }
            })
            ->paginate(10)
            ->get();
        return view('wiki.search', [
            'wiki' => $wiki
        ]);
    }

    public function searchAPI(Request $request) {
        $validator = Validator::make($request->all(), [
            'keyword' => 'required|string|max:25',
            'stack' => 'string|max:10'
        ]);
        if($validator->fails()) {
            return response()->json([
                'status' => false
            ]);
        }
        $wiki = Wiki::select('title')
            ->where('type', 'forum')
            ->where('title', 'LIKE', "%{$request->keyword}%")
            ->where(function($query) {
                if(request()->has('stack')) {
                    $query->where('stack', request()->stack);
                }
            })
            ->limit(15)
            ->get();
        return response()->json([
            'data' => $wiki
        ]);
    }
    public function rating(Request $request, Wiki $wiki)
    {
        $validator = Validator::make($request->all(), [
            'rating' => 'required|numeric|between:0,5'
        ]);
        if($validator->fails()) {
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
