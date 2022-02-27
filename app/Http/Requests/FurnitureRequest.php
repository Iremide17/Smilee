<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FurnitureRequest extends FormRequest
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
            'title'                       => ['required', 'max:100'],
            'price'                       => ['required'],
            'type'                        => ['required', 'in:old,new'],
            'categories'                        => ['array', 'nullable'],
            'categories.*'                      => ['exists:categories,id'],
            'description'                 => ['nullable'],
            'image'                       => ['sometimes', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'image2'                       => ['sometimes', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'image3'                       => ['sometimes', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],

        ];
    }

    public function title(): string
    {
        return $this->get('title');
    }

    public function price(): string
    {
        return $this->get('price');
    }

    public function type(): string
    {
        return $this->get('type');
    }

    public function categories(): array
    {
        return $this->get('categories', []);
    }

    public function description(): string
    {
        return $this->get('description');
    }

    public function first(): ?string
    {
        return $this->image;
    }

    public function second(): ?string
    {
        return $this->image2;
    }

    public function third(): ?string
    {
        return $this->image3;
    }
}
