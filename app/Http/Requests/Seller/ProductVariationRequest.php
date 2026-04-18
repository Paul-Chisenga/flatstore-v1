<?php

namespace App\Http\Requests\Seller;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductVariationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['nullable', 'string', 'max:255'],
            'sku' => [
                'required',
                'string',
                'max:255',
                Rule::unique('product_variations', 'sku')->ignore($this->route('variation')),
            ],
            'price' => ['required', 'numeric', 'min:0'],
            'weight' => ['nullable', 'numeric', 'min:0'],
            'width' => ['nullable', 'numeric', 'min:0'],
            'height' => ['nullable', 'numeric', 'min:0'],
            'depth' => ['nullable', 'numeric', 'min:0'],
            'is_default' => ['nullable', 'boolean'],
            'attribute_value_ids' => ['nullable', 'array'],
            'attribute_value_ids.*' => ['integer', 'exists:product_attribute_values,id'],
        ];
    }
}
