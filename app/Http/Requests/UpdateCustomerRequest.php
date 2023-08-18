<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCustomerRequest extends FormRequest
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
            'name' => ['string', 'required'],
            'identification' => ['string', 'required', Rule::unique('customers', 'identification')->ignore($this->customer)],
            'email' => ['string', 'required',  Rule::unique('customers', 'email')->ignore($this->customer)],
            'customer_type_id' => ['required','exists:customer_types,id']
        ];
    }
}
