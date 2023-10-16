<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class addCandidateToVotersRequest extends FormRequest
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
           'ballot_id' => 'required',
           'candidate_id' => 'required',
           'candidate_name' => 'required',
           'email'=> ['required','unique:users'],
           'password'=> 'required',
           'contact' => ['required','unique:users'],

        ];
    }
    public function messages(){
        return [
            'candidate_name.required' => 'name_required',
            'ballot_id.required' => '1 important! ID is Missing! Error!',
            'candidate_id.required' => '1 Important! ID is Missing! Error!',
            'email.required' => 'Email is required!',
            'email.unique' => 'Email has already been taken!',
            'password.required'=> 'Password Field is Required!',
            'contact.required' => 'Contact is Required!',
            'contact.unique' => 'Contact has already been taken!'
        ];
    }
}
