<?php

namespace App\Http\Controllers;

use App\Models\{
    Wiki,
    Comment,
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
        $comments = Comment::where('wiki_id', $wiki->id)
            ->paginate(15, ['*'], 'comments');
        return view('wiki.comments', compact('comments'));
    }
    public function create(Request $request, Wiki $wiki) {
        $request->validate([
            'comment' => ['required', 'string', 'max:500']
        ]);
        Comment::create([
            'wiki_id' => $wiki->id,
            'user_id' => Auth::id(),
            'comment' => $request->input('comment')
        ]);
        return back()->with('success', 'Comment added');
    }
    public function edit(Request $request, Comment $comments) {
        $request->validate([
            'comment' => ['required', 'string', 'max:500']
        ]);
        $comments->update([
            'comment' => $request->input('comment')
        ]);
        return back()->with('success', 'Comment edited');
    }

    public function vote(Request $request, Comment $comments)
    {
        $validator = Validator::make($request->all(), [
            'vote' => ['required', 'in:up,down']
        ]);
        if($validator->fails()) {
            return response()->json([
                'status' => false
            ]);
        }
        $vote = Vote::where([
            'wiki_id' => $comments->wiki->id,
            'user_id' => Auth::id(),
            'comment_id' => $comments->id
        ]);
        if($request->input('vote') == 'up' && $vote->doesntExist()) {
            $vote = Vote::create([
                'wiki_id' => $comments->wiki->id,
                'user_id' => Auth::id(),
                'comment_id' => $comments->id
            ]);
            $comments->increment('vote');
        } elseif($request->input('vote') == 'down' && $vote->exists()) {
            $vote->delete();
            $comments->decrement('vote');
        }
        return response()->json([
            'status' => true,
            'votes' => $comments->vote
        ]);
        return back();
    }
}
