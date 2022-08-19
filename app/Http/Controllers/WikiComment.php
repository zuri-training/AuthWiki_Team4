<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Models\{
    Wiki,
    Comment,
    Reaction,
    Log
};
use App\Http\Requests\{
    StoreWikiCommentRequest,
    UpdateWikiCommentRequest
};
use Illuminate\{
    Http\Request,
    Support\Facades\Auth
};

class WikiComment extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function store(StoreWikiCommentRequest $request, Wiki $wiki) {
        // $this->authorize('view', $wiki);
        $comment = Comment::create([
            'wiki_id' => $wiki->id,
            'user_id' => Auth::id(),
            'comment' => $request->comment
        ]);
        Log::updateOrCreate([
            'user_id' => Auth::id()
        ],
        [
            'comment_id' => $comment->id
        ]);
        return redirect(route('library.show', ['wiki' => $wiki->id]));
    }
    public function update(UpdateWikiCommentRequest $request, Comment $comment) {
        if(Auth::id() == $comment->user_id) {
            $comment->update([
                'comment' => $request->comment
            ]);
            return redirect(route('library.show', ['wiki' => $comment->wiki->id]));
        }
        abort(403);
    }

    public function destroy(Comment $comment) {
        if(Auth::id() == $comment->user_id) {
            $comment->delete();
            return redirect(route('library.show', ['wiki' => $comment->wiki->id]));
        }
        abort(403);
    }

    public function vote(Request $request, Comment $comment)
    {
        // $this->authorize('view', $comment->wiki);
        $request->validate([
            'vote' => 'required|string|in:up,down'
        ]);
        Reaction::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'wiki_id' => $comment->wiki->id,
                'comment_id' => $comment->id
            ],
            [
                'rating' => $request->vote == 'up' ? '1' : '-1'
            ]
        );
        return response()->json([
            'status' => true,
            'votes' => Helper::shortNum($comment->reaction()->where('wiki_id', $comment->wiki->id)->sum('rating'))
        ]);
    }
}
