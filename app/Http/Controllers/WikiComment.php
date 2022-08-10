<?php

namespace App\Http\Controllers;

use App\Models\{
    Wiki,
    Comment,
    Reaction,
    Vote
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
        $this->middleware(['auth', 'verified'])->except('show');
    }
    public function show(Wiki $wiki) {
        $comment = Comment::where('wiki_id', $wiki->id)
            ->paginate(15);
        return view('wiki.comments', compact('comments'));
    }
    public function create(Request $request, Wiki $wiki) {
        $request->validate([
            'comment' => 'required|string|max:500'
        ]);
        Comment::create([
            'wiki_id' => $wiki->id,
            'user_id' => Auth::id(),
            'comment' => $request->input('comment')
        ]);
        return back();
    }
    public function edit(Request $request, Comment $comment) {
        $request->validate([
            'comment' => 'required|string|max:500'
        ]);
        $comment->update([
            'comment' => $request->input('comment')
        ]);
        return back();
    }

    public function vote(Request $request, Comment $comment)
    {
        $validator = Validator::make($request->all(), [
            'vote' => 'required|in:up,down'
        ]);
        if($validator->fails()) {
            return response()->json([
                'status' => false
            ]);
        }
        $vote = Reaction::where([
            'wiki_id' => $comment->wiki->id,
            'user_id' => Auth::id(),
            'comment_id' => $comment->id
        ]);
        if($request->input('vote') == 'up' && $vote->doesntExist()) {
            $vote = Reaction::create([
                'wiki_id' => $comment->wiki->id,
                'user_id' => Auth::id(),
                'comment_id' => $comment->id
            ]);
            $comment->increment('vote');
        } elseif($request->input('vote') == 'down' && $vote->exists()) {
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
