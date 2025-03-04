<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'name' => 'required|string|max:255|unique:tags,name', 
        ];


        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $tagId = $this->route('tag'); 
            $rules['name'] = 'required|string|max:255|unique:tags,name,' . $tagId;
        }

        return $rules;
    }
}
