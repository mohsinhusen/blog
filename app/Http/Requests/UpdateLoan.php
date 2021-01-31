<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLoan extends FormRequest
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
                'loan_date' => 'required',
                'loan_reason' => 'required | max:50',
                'loan_amt' => 'required  | numeric',
                'loan_profit' => 'required | numeric',
                'loan_duration' => 'required | numeric',                
                'loan_gar_2' => 'required',
                'loan_gar_1' => 'required'
        ];
    }
}
