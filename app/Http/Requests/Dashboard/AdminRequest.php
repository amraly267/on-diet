<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminRequest extends FormRequest
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
        $adminId = request()->admin ?? null;

        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:admins,email,'.$adminId.',id',
            'mobile' => ['required', Rule::unique('admins')->where(function($q){
                                                                $q->where([['mobile', request()->mobile], ['country_id', request()->country_id]]);
                                                            })->ignore($adminId)
                        ],
            'image' => 'nullable|mimes:jpeg,jpg,png|max:5120',
            'country_id' => 'required|exists:countries,id',
        ];

        if(\Route::currentRouteName() == 'admins.update')
        {
            $rules['password'] = 'nullable|min:6';
            $rules['confirm_password'] = 'required_if:password,!=,|same:password';
        }
        else
        {
            $rules['password'] = 'required|min:6';
            $rules['confirm_password'] = 'required|require_if:password|same:password';
        }

        return $rules;
    }
}
