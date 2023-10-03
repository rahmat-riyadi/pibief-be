<?php

namespace App\Http\Requests;

use App\Http\Controllers\ResponseController;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreVendorValidation extends FormRequest
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
            'name' => 'required',
            'email' => 'nullable',
            'phone' => 'required',
            'province' => 'required',
            'city' => 'required',
            'district' => 'required',
            'neighborhood' => 'required',
            'address' => 'required',
        ];
    }

    public function failedValidation(Validator $validator){
        throw new HttpResponseException(ResponseController::create(null, 'error', $validator->errors()->first(), 200));
    }
}
