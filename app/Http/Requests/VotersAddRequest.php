<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VotersAddRequest extends FormRequest
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
            'name' => 'required',
            'email'=> ['required','unique:users'],
            'contact' => ['required','unique:users'],
            'password' => 'required',
            'ballot_id' => 'required',
        ];
    }

    public function messages(){
        return [
            'name.required' => 'name_required',
            'email.required' => 'email_required',
            'email.unique' => 'Email has already been taken!',
            'contact.required'=> 'contact_required',
            'contact.unique' => 'Contact has already been Taken!',
            'password.required' => 'password_required',
            'ballot_id.required' => 'ballot_id_required'
        ];
    }
}
