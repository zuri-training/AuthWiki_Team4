<?php

namespace App\Http\Requests;

use App\Models\Wiki;
use Illuminate\Foundation\Http\FormRequest;

class StoreWikiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', Wiki::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'user_id' => 'required|numeric|exists:users,id',
            'type' => 'required|string|in:wiki,blog,forum',
            'stack' => 'required|string|max:25',
            'file_dir' => 'string|nullable',
            'title' => 'required|string|min:10|max:150',
            'content' => 'required|string|max:2000000000'
        ];
    }
}
