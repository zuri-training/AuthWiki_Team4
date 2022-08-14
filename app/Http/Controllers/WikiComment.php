<?php

namespace App\Http\Controllers;

use App\Models\{
    Wiki,
    Comment,
    Reaction
};
use Illuminate\{
    Support\Facades\Auth,
    Support\Facades\DB,
    Http\Request,
    Support\Facades\Validator
};

class WikiComment extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified')->only('update');
    }
    public function _filter($text) {
        $tags = 'b|i|u|code|pre';
        return preg_replace(
            "/<({$tags}) [^>]*>/", "<$1>",
            strip_tags(
                $text,
                explode('|', $tags)
            )
        );
    }
    public function store(Request $request, Wiki $wiki) {
        $request->validate([
            'comment' => 'required|string|max:5120'
        ]);
        Comment::create([
            'wiki_id' => $wiki->id,
            'user_id' => Auth::id(),
            'comment' => $this->_filter($request->comment)
        ]);
        return back();
    }
    public function update(Request $request, Comment $comment) {
        $request->validate([
            'comment' => 'required|string|max:5120'
        ]);
        $comment->update([
            'comment' => $this->_filter($request->comment)
        ]);
        return back();
    }

    public function vote(Request $request, $id)
    {
        $comment = Comment::find($id);
        // $request->validate([
        //     'vote' => 'required|in:up,down'
        // ]);
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
            Reaction::create([
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
        // return back();
    }
}
