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
            'overview' => 'required|string|between:64,10240',
            'requirements' => 'present|string|max:5120',
            'snippets' => 'present|string|nullable|max:1024',
            'examples' => 'present|string|max:5120'
        ];
    }
}
