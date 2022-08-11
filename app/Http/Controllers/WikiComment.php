<?php

namespace App\Http\Controllers;

use App\Models\{
    Wiki,
    Comment,
    Reaction
};
use Illuminate\{
    Support\Facades\Auth,
    Http\Request,
    Support\Facades\Validator
};

class WikiComment extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified')->only(['store', 'update']);
    }
    public function store(Request $request, Wiki $wiki) {
        $request->validate([
            'comment' => 'required|string|max:500'
        ]);
        Comment::create([
            'wiki_id' => $wiki->id,
            'user_id' => Auth::id(),
            'comment' => $request->comment
        ]);
        return back();
    }
    public function update(Request $request, Comment $comment) {
        $request->validate([
            'comment' => 'required|string|max:500'
        ]);
        $comment->update([
            'comment' => $request->comment
        ]);
        return back();
    }

    public function vote(Request $request, $id)
    {
        $comment = Comment::find($id);
        $validator = Validator::make($request->all(), [
            'vote' => 'required|in:up,down'
        ]);
        if($validator->fails() || !$comment) {
            return response()->json([
                'status' => false
            ]);
        }
        $vote = Reaction::where([
            'wiki_id' => $comment->wiki->id,
            'user_id' => Auth::id(),
            'comment_id' => $comment->id
        ]);
        if($request->vote == 'up' && $vote->doesntExist()) {
            $vote = Reaction::create([
                'wiki_id' => $comment->wiki->id,
                'user_id' => Auth::id(),
                'comment_id' => $comment->id
            ]);
            $comment->increment('vote');
        } elseif($request->vote == 'down' && $vote->exists()) {
            $vote->delete();
            $comment->decrement('vote');
        }
        return response()->json([
            'status' => true,
            'votes' => $comment->vote
        ]);
        return back();
    }
}
