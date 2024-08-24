<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductEditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'detail' => 'nullable|string',
            'producer_id' => 'required|exists:producers,id',
            'price' => 'required|numeric|min:0',
            'amount' => 'required|integer|min:0',
        ];
    }
}
