<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'          => ['required', 'max:100'],
            'email'         => ['required', 'unique:users,email'],
            'password'      => ['required', 'max:15'],
        ];
    }

    public function address(): string
    {
        return $this->get('name');
    }

    public function city(): string
    {
        return $this->get('name');
    }

    public function status(): string
    {
        return $this->get('name');
    }

    public function phone(): string
    {
        return $this->get('name');
    }
}
