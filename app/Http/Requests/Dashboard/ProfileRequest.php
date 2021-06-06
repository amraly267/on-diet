<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'email' => 'required|email|unique:admins,email,'.auth()->guard('admin')->user()->id.',id',
            'mobile' => 'required|unique:admins,mobile,'.auth()->guard('admin')->user()->id.',id',
            'image' => 'nullable|mimes:jpeg,jpg,png|max:5120',
            'password' => 'nullable|min:6',
            'confirm_password' => 'required_if:password,!=,|same:password',
        ];
    }
}
