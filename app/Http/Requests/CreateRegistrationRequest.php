<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateRegistrationRequest extends FormRequest
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
            'title'            => 'required|in:Prof,Dr,Mr,Mrs,Miss',
            'first_name'       => 'required|max:255',
            'last_name'        => 'required|max:255',
            'speciality'       => 'required|max:255',
            'country'          => 'required|max:255',
            'city'             => 'required|max:255',
            'email'            => 'required|email|max:255',
            'countryCode'      => 'required|max:255',
            'mobile'           => 'required|max:255',
            'receive_updates'  => 'required|in:0,1',
            // 'onlyWorkshop'     => 'required|in:0,1',
            // 'workshop_id'      => 'sometimes|nullable|exists:workshops,id|required_if:onlyWorkshop,1',
            'virtualAccess'     => 'required|in:0,1',
        ];
    }

    public function messages()
    {
        return [
            'workshop_id.required_if' => 'The workshop field is required.',
        ];
    }
/*
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
*/
}
