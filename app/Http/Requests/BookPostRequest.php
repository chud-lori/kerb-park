<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class BookPostRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'license_plate' => ['required'],
            'bay_code' => [
                'required',
                'exists:bays,bay_code',
                Rule::exists('bays')->where(function ($query) {
                    return $query->where('status', 'available');
                }),
            ],
            'time' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'bay_code.*' => 'bay is not available or exist',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => 0,
            'errors' => $validator->errors(),
        ], 422));
    }
}
