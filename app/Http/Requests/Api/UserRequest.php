<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required',
            'first_name' => 'required',
            'company_name' => 'required',
            'address' => 'required',
            'city'   => 'required',
            'country' => 'required',
            'phone'   => 'required',
            'termes'  =>'required',
            'email' => 'required|email|unique:users,email,'.$this -> id,
            'password' => 'required|max:150|min:3' ,
        ];
    }


    public function messages()
    {
        return [
            'name.required'           => trans('error_messages.name_required'),
            'first_name.required'     => trans('error_messages.first_name_required'),
            'email.required'          => trans('error_messages.emil_requird'),
            'email.unique'            => trans('error_messages.email_unique'),
            'password.required'          => trans('error_messages.password_requred'),
            'company_name.required'          => trans('error_messages.company_requred'),
            'address.required'          => trans('error_messages.address_requred'),
            'city.required'           => trans('error_messages.city_required'),
            'country.required'          => trans('error_messages.country_required'),
            'phone.required'            => trans('error_messages.phone_required'),
            'termes.required'           => trans('error_messages.termes_required'),

            
            

        ];
    }}
