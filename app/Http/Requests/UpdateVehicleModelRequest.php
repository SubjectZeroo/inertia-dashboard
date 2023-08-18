<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVehicleModelRequest extends FormRequest
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
            'vehicle_brand_id' => ['required','exists:vehicle_brands,id'],
            'vehicle_type_id' => ['required','exists:vehicle_types,id'],
            'name' => ['string', 'max:255', 'required'],
        ];
    }
}
