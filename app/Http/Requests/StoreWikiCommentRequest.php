<?php

namespace App\Http\Requests;

use Illuminate\{
    Foundation\Http\FormRequest,
    Support\Facades\Auth
};

class StoreWikiCommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'comment' => 'required|string|max:5120'
        ];
    }
}
