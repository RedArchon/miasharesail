<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TodoListStoreRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string'
        ];
    }
}
