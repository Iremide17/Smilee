<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class WriterRequest extends FormRequest
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
            'bio'                       => ['required'],
            'facebook'                       => ['nullable'],
            'twitter'                       => ['nullable'],
            'instagram'                       => ['nullable'],
            'linkedin'                       => ['nullable'],
        ];
    }

    public function author(): User
    {
        return $this->user();
    }
    
    public function bio(): string
    {
        return $this->get('bio');
    }

    public function facebook(): ?string
    {
        return $this->get('facebook');
    }

    public function twitter(): ?string
    {
        return $this->get('twitter');
    }

    public function instagram(): ?string
    {
        return $this->get('instagram');
    }

    public function linkedin(): ?string
    {
        return $this->get('linkedin');
    }
}
