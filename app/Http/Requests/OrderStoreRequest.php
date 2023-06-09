<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderStoreRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'from_city_id' => 'required|exists:cities,id',
            'to_city_id' => 'required|exists:cities,id',
            'delivery_date' => 'required',
        ];
    }
}
