<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CandidateUpdateRequest extends FormRequest
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
            'position_id' => 'required',
            'ballot_id' => 'required',
            'candidate_name'=> 'required',
            'candidate_id' => 'required',
        ];
    }

    public function messages()
    {
        return [

            'candidate_name.required'=> 'name_err',
            'position_id.required' => 'party_id_err',
            'ballot_id.required' => 'ballot_id_err',
            'candidate_id.required'=> 'can_id_err'



        ];
    }
}
