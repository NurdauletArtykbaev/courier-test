<?php

namespace App\Http\Requests\Admin\Order;

use Illuminate\Foundation\Http\FormRequest;

class OrderConcatRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'ids' => 'required|array'
        ];
    }
}
