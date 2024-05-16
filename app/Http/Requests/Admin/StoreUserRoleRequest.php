<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRoleRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=>'required',
            'email'=> 'required|email|unique:users',
            'password'=>'required',
            'cnf_pass'=>'required|same:password',
            'user_type'=>'required',
        ];
    }

    public function messages(){
        return [
            'name.required'=>'Name is required',
            'cnf_pass.required' =>'Confirm password is required',
            'cnf_pass.same' => 'Confirm password must match password',
            'user_type.required'=>'Pleas Select user type',
        ];
    }
}
