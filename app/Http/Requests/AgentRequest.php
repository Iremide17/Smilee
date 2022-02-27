<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class AgentRequest extends FormRequest
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
            'name'                  =>  ['required', 'max:100'],
            'phone'                 =>  ['required', 'max:11'],
            'email'                 =>  ['required', 'unique:users,email'],
            'address'               =>  ['required'],
            'instagram'             =>  ['required'],
            'facebook'              =>  ['required'],
            'twitter'               =>  ['required'],
            'linkedin'              =>  ['required'],
            'area_covered'          =>  ['required'],
            'website'               =>  ['required'],
            'language'              =>  ['required'],
            'description'           =>  ['required'],
            'image'                 => ['sometimes', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
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

    public function areaCovered(): ?string
    {
        return $this->get('area_covered');
    }

    public function website(): ?string
    {
        return $this->get('website');
    }

    public function language(): ?string
    {
        return $this->get('language');
    }

    public function description(): ?string
    {
        return $this->get('description');
    }

    public function image(): ?string
    {
        return $this->image;
    }

}
