<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Country;
use CodeZero\UniqueTranslation\UniqueTranslationRule;

class CountryRequest extends FormRequest
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
        $countryId = request()->country ?? null;
        return [
            'name.*' => 'required|unique_translation:countries,name,'.$countryId,
            'name_code' => 'required|min:2|max:3|unique:countries,name_code,'.$countryId.',id',
            'phone_code' => 'required|digits:3|unique:countries,phone_code,'.$countryId.',id',
            'flag' => 'nullable|mimes:jpeg,jpg,png|max:5120',
        ];
    }

    public function messages()
    {
        return [
            'name.*.required' => trans(config('dashboard.trans_file').'name_is_required'),
            'name.*.unique_translation' => trans(config('dashboard.trans_file').'name_is_already_exist'),
        ];
    }
}
