<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PartyFormRequest extends FormRequest
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
        //$this->merge(['party_name'=>str_replace(' ', '',$this->input('party_name'))]);
        return [
           'party_name' => ['required','unique:parties'],
           'ballot_id' => ['required']
        ];
    }

    public function messages(){
        return [
            'party_name.required' => 'name_required',
            'party_name.unique' => 'name_unique',
            'ballot_id.required' => 'ballot_id_null'
        ];
    }
}
