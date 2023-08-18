<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateItemRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'unit_id' => ['nullable','exists:units,id'],
            'item_category_id' => ['required','exists:item_categories,id'],
            'item_brand_id' => ['required','exists:item_brands,id'],
            'code' => ['string', 'required', Rule::unique('items', 'code')->ignore($this->item)],
            'name' => ['string', 'required'],
            'description' => ['string', 'required'],
            'price' => ['numeric', 'required'],
            'cost' => ['numeric', 'required'],
        ];
    }
}
