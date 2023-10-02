<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePartyRequest extends FormRequest
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
            'party_id' => 'required',
            'party_name'=>['required'],

        ];
    }
    public function messages(){
        return [
            'party_id.required' => 'party_id_err',
            'party_name.required' => 'name_required',

        ];
    }


}
