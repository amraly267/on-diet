<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Dashboard\ValidateDomain;

class SettingRequest extends FormRequest
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
            'project_name.*' => 'required',
            'contact_us_email' => 'nullable|email',
            'contact_us_mobile' => 'nullable|digits_between:9,12',
            'facebook_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'youtube_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'snapchat_url' => 'nullable|url',
            'whatsapp_number' => 'nullable|digits_between:9,12',
            'supported_countries' => 'required',
            'default_country_id' => 'required|exists:countries,id',
            'customer_role_id' => 'required|exists:roles,id',
            'supported_locales' => 'required',
            'default_locale' => 'required',
            'timezone_id' => 'required|exists:timezones,id',
            'logo' => 'nullable|mimes:jpeg,jpg,png|max:5120',
            'app_icon' => 'nullable|mimes:jpeg,jpg,png|max:5120',
            'favicon' => 'nullable|mimes:jpeg,jpg,png|max:5120',
            'white_logo' => 'nullable|mimes:jpeg,jpg,png|max:5120',
            'mail_from_address' => 'nullable|email',
            'mail_host' => ['nullable', new ValidateDomain],
            'mail_port' => 'nullable|numeric|between:0,65535',

        ];
    }

    public function messages()
    {
        return [
            'project_name.*.required' => trans(config('dashboard.trans_file').'name_is_required'),
        ];
    }

}
