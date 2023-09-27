<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BallotRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'ballot_name'=>'required',
            'details'=>'required',
            'ballot_key'=>'required',
            'id'=>'required'
        ];
    }
    public function messages()
    {
    return [
        'ballot_name.required'=> 'ballot_name_err',
        'details.required'=>'ballot_details_err',
        'ballot_key.required'=>'ballot_key_err',
        'id.required'=>'ballot_id_err',


    ];
    }
}
