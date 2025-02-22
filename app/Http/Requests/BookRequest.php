<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        return [
            'title'            => 'required|string|max:255',
            'publication_year' => 'required|integer|min:1000|max:' . date('Y'),
            'description'      => 'nullable|string',
            'author_id'        => 'required|exists:authors,id',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'            => 'The book title is required.',
            'title.max'                 => 'The book title cannot exceed 255 characters.',
            'publication_year.required' => 'The publication year is required.',
            'publication_year.integer'  => 'The publication year must be a number.',
            'publication_year.min'      => 'The publication year must be a valid year.',
            'publication_year.max'      => 'The publication year cannot be in the future.',
            'description.string'        => 'The description must be a valid string.',
            'author_id.required'        => 'An author must be selected.',
            'author_id.exists'          => 'The selected author does not exist.',
        ];
    }
}
