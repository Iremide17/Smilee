<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PropertyRequest extends FormRequest
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
            'name'                       => ['required', 'max:100'],
            'type'                        => ['required', 'in:sale,rent'],
            'room'                       => ['required'],
            'year_built'                 => ['required'],
            'price'                      => ['required'],
            'region'                       => ['required'],
            'address'                       => ['nullable'],
            'latitude'                       => ['nullable'],
            'longitude'                       => ['nullable'],
            'postal_code'                       => ['nullable'],
            'image'                       => ['sometimes', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'image_2'                       => ['sometimes', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'image_3'                       => ['sometimes', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'video'                       => ['sometimes', 'video', 'mimes:mp4,3gp', 'max:7048'],
            'description'                 => ['required'],
            'fence'              => ['nullable', 'boolean'],
            'tiled'              => ['nullable', 'boolean'],
            'well'              => ['nullable', 'boolean'],
            'tap'              => ['nullable', 'boolean'],
            'toilet'              => ['nullable', 'boolean'],
            'available'              => ['nullable', 'boolean'],
        ];
    }

    public function name(): string
    {
        return $this->get('name');
    }

    public function type(): string
    {
        return $this->get('type');
    }

    public function room(): int
    {
        return $this->get('room');
    }

    public function yearBuilt(): string
    {
        return $this->get('year_built');
    }

    public function price(): string
    {
        return $this->get('price');
    }

    public function region(): string
    {
        return $this->get('region');
    }

    public function address(): ?string
    {
        return $this->get('address');
    }

    public function latitude(): ?string
    {
        return $this->get('latitude');
    }

    public function longitude(): ?string
    {
        return $this->get('longitude');
    }

    public function postalCode(): ?string
    {
        return $this->get('postal_code');
    }

    public function image(): ?string
    {
        return $this->image;
    }

    public function image2(): ?string
    {
        return $this->image_2;
    }

    public function image3(): ?string
    {
        return $this->image_3;
    }

    public function video(): ?string
    {
        return $this->video;
    }

    public function description(): string
    {
        return $this->get('description');
    }

    public function fence(): bool
    {
        return $this->boolean('fence');
    }

    public function tiled(): bool
    {
        return $this->boolean('tiled');
    }

    public function well(): bool
    {
        return $this->boolean('well');
    }

    public function tap(): bool
    {
        return $this->boolean('tap');
    }

    public function toilet(): bool
    {
        return $this->boolean('toilet');
    }

    public function available(): bool
    {
        return $this->boolean('available');
    }
}
