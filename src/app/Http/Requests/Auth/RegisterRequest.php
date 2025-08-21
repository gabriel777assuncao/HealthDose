<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required|min:8|max:255',
            'username' => 'required|min:3|max:255',
            'name' => 'required|min:3|max:255',
            'cellphone' => 'nullable',
        ];
    }
}
