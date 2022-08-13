<?php

namespace App\Http\Requests;

use App\Models\Wiki;
use Illuminate\Foundation\Http\FormRequest;

class UpdateWikiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $wiki = Wiki::find($this->route('wiki'));
        return $wiki && $this->user()->can('update', $wiki);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'overview' => 'required|string|between:64,5120',
            'requirements' => 'required|string|between:32,5120',
            'snippets' => 'required|string|max:5120',
            'examples' => 'required|string|max:10240',
            'links' => 'required|string|max:5120',
        ];
    }
}
