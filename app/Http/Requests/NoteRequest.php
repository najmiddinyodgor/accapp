<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NoteRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'subCategory' => ['required', 'exists:sub_categories,id'],
            'amount' => ['required', 'min:0', 'numeric'],
            'comment' => ['max:255'],
            'date' => ['required', 'date']
        ];
    }
}