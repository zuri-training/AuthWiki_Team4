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
            'type' => 'required|string|in:wiki,blog,forum',
            'file' => 'required_if:type,wiki|numeric|exists:files,id',
            'category' => 'required|string|exists:categories,id',
            'title' => 'required|string|between:10,250',
            'overview' => 'required|string|between:64,10240',
            'requirements' => 'required|string|max:5120',
            'snippets' => 'nullable|string|nullable|max:1024',
            'examples' => 'nullable|string|max:5120'
        ];
    }
}
