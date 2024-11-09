<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => Product::NAME_RULES,
            'description' => Product::DESCRIPTION_RULES,
            'price' => Product::PRICE_RULES,
            'image' => $this->product ?
                Product::IMAGE_RULES_UPDATE :
                Product::IMAGE_RULES_CREATE,
            'categories' => Product::CATEGORIES_RULES,
        ];
    }
}
