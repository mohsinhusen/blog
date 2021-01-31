<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\NewMemberModel;


class CreateUser extends FormRequest
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
            'name' => 'required | min:10 | max:50',
            'address' => 'required | max:50',
            'membertype' => 'required | max:50',
            'mobile' => 'required  | regex:/^([0-9\s\-\+\(\)]*)$/|min:10 | unique:member',
            'email' => 'required | unique:member',
            'password' => 'required | min:6 | max:10',
            'pur_share' => 'required | numeric | max:2',
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
