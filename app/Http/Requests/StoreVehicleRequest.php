<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreVehicleRequest extends FormRequest
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
            'customer_id' => ['required','exists:customers,id'],
            'vehicle_model_id' => ['required','exists:vehicle_models,id'],
            'vehicle_brand_id' => ['required','exists:vehicle_brands,id'],
            'unit' => ['string', 'required'],
            'serial' => ['string', 'required'],
            'price' => ['numeric', 'required'],
        ];
    }
}
