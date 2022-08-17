<?php

namespace App\Http\Requests;

use App\Models\Comment;
use Illuminate\{
    Foundation\Http\FormRequest,
    Support\Facades\Auth
};

class UpdateWikiCommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $uid = Auth::id();
        $comment = Comment::find($this->route('comment'));
        return Auth::check() && $comment && $uid == $comment->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'comment' => 'required|string|max:5120',
        ];
    }
}
