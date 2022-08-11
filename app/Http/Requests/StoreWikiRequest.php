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
            'stack' => 'required|string|in:javascript,python,django',
            'file_dir' => 'string|nullable',
            'title' => 'required|string|between:10,150',
            'description' => 'required|string|between:10,250',
            'content' => 'required|string|between:50,2000000000'
        ];
    }
}
