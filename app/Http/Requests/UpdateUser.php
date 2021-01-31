<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUser extends FormRequest
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
        // print_r($this->id); die();
        return [
            'name' => 'required | min:10 | max:50',
            'address' => 'required | max:50',
            'membertype' => 'required | max:50',
            'mobile' => 'required  | regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'email' => 'required|unique:member,email,' . $this->id,
            'password' => 'nullable | min:6 | max:10',
            'purchase_share' => 'nullable | numeric'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Enter Full Member Name',
            'address.required' => 'Select Member Address',
            'membertype.required' => 'Select Member Type',
            'mobile.required' => 'Enter Valid Mobile Number',
            'email.required' => 'Enter Email for login',
            'password.required' => 'Enter Password for login',
            'pur_share.required' => 'Enter Purchase Share',
        ];
    }
}
