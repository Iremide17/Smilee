<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class BankRequest extends FormRequest
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
            'name'                              => ['required', 'max:100'],
            'description'                       => ['required'],
            'content'                           => ['required'],
            'semesters'                         => ['array', 'nullable'],
            'semesters.*'                       => ['exists:semesters,id'],
            'levels'                            => ['array', 'nullable'],
            'levels.*'                          => ['exists:levels,id'],
        ];
    }

    public function author(): User
    {
        return $this->user();
    }

    public function name(): string
    {
        return $this->get('name');
    }

    public function description(): string
    {
        return $this->get('description');
    }

    public function content(): string
    {
        return $this->content;
    }

    public function semesters(): array
    {
        return $this->get('semesters', []);
    }

    public function levels(): array
    {
        return $this->get('levels', []);
    }
}
