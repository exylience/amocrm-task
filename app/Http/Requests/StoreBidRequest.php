<?php

namespace App\Http\Requests;

class StoreBidRequest extends ApiRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email'],
            'phone' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
        ];
    }
}
