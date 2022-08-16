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
    Support\Facades\Validator,
    Support\Facades\Auth,
    Support\Facades\DB
};

class WikiComment extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified')->only('update');
    }
    public function store(StoreWikiCommentRequest $request, Wiki $wiki) {
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
        return back();
    }
    public function update(UpdateWikiCommentRequest $request, Comment $comment) {
        $comment->update([
            'comment' => $request->comment
        ]);
        return back();
    }

    public function vote(Request $request, $id)
    {
        $comment = Comment::find($id);
        $validator = Validator::make($request->all(), [
            'vote' => 'required|string|in:up,down'
        ]);
        if($validator->fails() || !$comment) {
            return response()->json([
                'status' => false
            ]);
        }
        Reaction::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'wiki_id' => $comment->wiki->id,
                'comment_id' => $comment->id
            ],
            [
                'rating' => $request->vote == 'up' ? DB::raw('rating+1') : DB::raw('rating-1')
            ]
        );
        $vote = Reaction::where([
            'user_id' => Auth::id(),
            'wiki_id' => $comment->wiki->id,
            'comment_id' => $comment->id
        ])->first();
        $vote->update([
            'rating' => $vote->rating > 1 ? '1' : ($vote->rating < -1 ? '-1' : $vote->rating) 
        ]);
        return response()->json([
            'status' => true,
            'votes' => Helper::shortNum($comment->reaction()->where('wiki_id', $comment->wiki->id)->sum('rating'))
        ]);
    }
}
