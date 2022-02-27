<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class VendorRequest extends FormRequest
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
            'name'                  => ['required'],
            'phone'                 => ['required'],
            'email'                 => ['required', 'unique:vendors'],
            'address'               => ['nullable'],
            'instagram'             => ['nullable'],
            'facebook'              => ['nullable'],
            'latitude'              => ['nullable'],
            'longitude'             => ['nullable'],
            'postal_code'           => ['nullable'],
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

    public function address(): string
    {
        return $this->get('address');
    }

    public function instagram(): string
    {
        return $this->get('instagram');
    }

    public function facebook(): string
    {
        return $this->get('facebook');
    }

    // public function latitude(): string
    // {
    //     return $this->get('latitude');
    // }

    // public function longitude(): string
    // {
    //     return $this->get('longitude');
    // }

    // public function postalCode(): string
    // {
    //     return $this->get('postal_code');
    // }

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
