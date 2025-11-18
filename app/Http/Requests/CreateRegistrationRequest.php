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
            'first_name'       => 'required|string|max:50',
            'last_name'        => 'required|string|max:50',
            'speciality'       => 'required|string|max:100',
            'country'          => 'required|string|max:100',
            'city'             => 'required|max:50',
            'email'            => 'required|email|max:191',
            'countryCode'      => 'required|max:10',
            'mobile'           => 'required|max:20',
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
