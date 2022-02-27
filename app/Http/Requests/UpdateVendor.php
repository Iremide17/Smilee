<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UpdateVendor extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'                  => ['required'],
            'phone'                 => ['required'],
            'email'                 => ['required'],
            'address'                 => ['nullable'],
            'instagram'             => ['nullable'],
            'facebook'              => ['nullable'],
            'twitter'              => ['nullable'],
            'linkedin'             => ['nullable'],
            'image'                 => ['sometimes', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'banner'                => ['sometimes', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'description'           => ['required'],
            'categories'            => ['array', 'nullable'],
            'categories.*'          => ['exists:categories,id'],        
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

    public function phone(): string
    {
        return $this->get('phone');
    }

    public function email(): string
    {
        return $this->get('email');
    }

    public function address(): ?string
    {
        return $this->get('address');
    }

    public function instagram(): ?string
    {
        return $this->get('instagram');
    }

    public function facebook(): ?string
    {
        return $this->get('facebook');
    }

    public function twitter(): ?string
    {
        return $this->get('twitter');
    }

    public function linkedin(): ?string
    {
        return $this->get('linkedin');
    }

    public function image(): ?string
    {
        return $this->image;
    }

    public function banner(): ?string
    {
        return $this->banner;
    }

    public function description(): string
    {
        return $this->get('description');
    }

    public function categories(): array
    {
        return $this->get('categories', []);
    }

}
