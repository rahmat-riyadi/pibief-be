<?php

namespace App\Http\Requests;

use App\Http\Controllers\ResponseController;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class ValidatePurchaseRequest extends FormRequest
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
            'vendor' => 'required',
            'order_number' => 'required',
            'order_date' => 'required',
            'due_date' => 'required',
            'branch' => 'required',
            'responsible_person' => 'required',
            'note' => 'nullable',
            'total_price' => 'required',
            'products' => 'required',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(ResponseController::create($validator->errors(), 'error', 'validation error', 401));
    }
}
