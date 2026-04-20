<?php

namespace App\Http\Requests\Seller;

use App\Enums\ProductMediaType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductMediaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_primary' => $this->boolean('is_primary'),
        ]);
    }

    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $product = $this->route('product');
        $fileRules = $this->isMethod('post') ? ['required'] : ['nullable'];

        return [
            'file' => [...$fileRules, 'file', 'max:10240'],
            'type' => ['required', Rule::enum(ProductMediaType::class)],
            'product_variation_id' => [
                'nullable',
                'integer',
                Rule::exists('product_variations', 'id')->where(fn ($query) => $query->where('product_id', $product?->id ?? 0)),
            ],
            'is_primary' => ['required', 'boolean'],
        ];
    }
}
