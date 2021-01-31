<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateInstallment extends FormRequest
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
                'loan_id'=> 'required',            
                'inst_amt' => 'required',
                'inst_date' => 'required  | date',
                'inst_penalty' => 'required | numeric',
        ];
    }

    public function messages()
    {
        return [
            
            'inst_amt.required' => 'Enter Installment Amount',
            'inst_date.required' => 'Enter Installment Date!',
            'inst_penalty.required' => 'Enter Installment Penalty',
            

        ];
    }
    
}
