<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'total' => ['required', 'integer'],
            'payment' => ['required', 'string' , 'in:pod,paystack,loan'],
            'address' => ['required', 'string'],
            'city' => ['required', 'string'],
            'state' => ['required'],
            'phone' => ['required', 'string'],
        ];
    }

    public function vendorId(): array
    {
        return $this->get('vendor_id');
    }

    public function itemId(): array
    {
        return $this->get('item_id');
    }

    public function price(): array
    {
        return $this->get('price');
    }

    public function total(): int
    {
        return $this->get('total');
    }

    public function payment(): string
    {
        return $this->get('payment');
    }

    public function address(): string
    {
        return $this->get('address');
    }

    public function city(): string
    {
        return $this->get('city');
    }

    public function state(): int
    {
        return $this->get('state');
    }

    public function phone(): string
    {
        return $this->get('phone');
    }
}
