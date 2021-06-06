<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;
use CodeZero\UniqueTranslation\UniqueTranslationRule;

class CityRequest extends FormRequest
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
        $cityId = request()->city ?? null;

        return [
            'name.*' => ['required', UniqueTranslationRule::for('cities', 'name')->where('country_id', request()->country_id)->ignore($cityId)],
            'country_id' => 'required|exists:countries,id',
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
