<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCustomerLocationRequest extends FormRequest
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
            'state_id' => ['required','exists:states,id'],
            'name' => ['string', 'required'],
            'phone' => ['numeric', 'required' ],
            'address' => ['string', 'required'],
            'ubication' => ['string', 'required'],
        ];
    }
}
