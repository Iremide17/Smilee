<?php

namespace App\Http\Requests;

use App\Models\State;
use Illuminate\Foundation\Http\FormRequest;

class AddressStoreRequest extends FormRequest
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
            'address'                     => ['required'],
            'city'                        => ['required'],
            'phone'                       => ['required'],
            'state'                         => ['required']
        ];
    }

     public function state(): string
    {
        return $this->get('state');
    }

    public function address(): string
    {
        return $this->get('address');
    }

    public function city(): string
    {
        return $this->get('city');
    }

    public function phone(): string
    {
        return $this->get('phone');
    }
}
