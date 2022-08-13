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
            'category_id' => 'required|string|exists:categories,id',
            'file_id' => 'sometimes|string|exists:files,id',
            'title' => 'required|string|between:10,250',
            'overview' => 'required|string|between:64,5120',
            'requirements' => 'required|string|between:32,5120',
            'snippets' => 'required|string|max:5120',
            'examples' => 'required|string|max:10240',
            'links' => 'required|string|max:5120',
        ];
    }
}
