<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateLoan extends FormRequest
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
            'loan_type' => 'required',
            'loan_duration' => 'required',
            'loan_reason' => 'required',
            'loan_date' => 'required | date',
            'loan_holder' => 'required',
            'loan_amt' => 'required  | numeric',
            'loan_profit' => 'required | numeric',
            'loan_installment' => 'required | numeric',
            'loan_g_1' => 'required',
            'loan_g_2' => 'required',


        ];
    }
    public function messages()
    {
        return [
            'loan_type.required' => 'Select Type Of Loan',
            'loan_duration.required' => 'Select Loan Duration',
            'loan_reason.required' => 'Select Reason For Loan',
            'loan_date.required' => 'Enter Loan Date',
            'loan_holder.required' => 'Select Member From List',
            'loan_amt.required' => 'Enter Loan Amount',
            'loan_profit.required' => 'Enter Loan Profit',
            'loan_installment.required' => 'Enter Loan Installment',
            'loan_g_1.required' => 'Select Guarantor - 1 ',
            'loan_g_2.required' => 'Select Guarantor - 2',
        ];
    }
}
