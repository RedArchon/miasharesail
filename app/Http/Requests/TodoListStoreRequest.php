<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class TodoListStoreRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::user()->hasPermissionTo('todo-list create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'items.*.title' => 'required|string',
            'items.*.description' => 'required|string',
        ];
    }
}
