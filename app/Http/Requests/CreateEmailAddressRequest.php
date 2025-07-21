<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateEmailAddressRequest extends FormRequest
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
            'email' => 'email|unique:emails'
        ];
    }

    protected function failedValidation(Validator $validator) {
        $errorsArray = [];
        foreach($validator->errors()->toArray() as $errorArray){
            foreach($errorArray as $string){
                $errorsArray[] = $string;
            }
        }

        $response['status'] = [
            'code'      => 201,
            'message'   => 'Validation failed',
            'errors'    => $errorsArray
        ];

        throw new HttpResponseException(response()->json($response, 422));
    }
}
