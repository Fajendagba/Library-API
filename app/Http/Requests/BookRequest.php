<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // true since i'm using middleware for auth
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'isbn' => 'required|string|max:13|unique:books,isbn',
            'published_date' => 'required|date',
            'status' => 'required|in:available,checked_out',
        ];

        // Modify ISBN unique rule for updates
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            // $rules['isbn'] = 'required|string|max:13|unique:books,isbn,' . $this->book->id;
            $rules['title'] = 'sometimes|string|max:13|unique:books,title,' . $this->book->id;
            $rules['author'] = 'sometimes|string|max:13|unique:books,author,' . $this->book->id;
            $rules['isbn'] = 'sometimes|string|max:13|unique:books,isbn,' . $this->book->id;
            $rules['published_date'] = 'sometimes|string|max:13|unique:books,published_date,' . $this->book->id;
            $rules['status'] = 'sometimes|string|max:13|unique:books,status,' . $this->book->id;
        }

        return $rules;
    }
}
