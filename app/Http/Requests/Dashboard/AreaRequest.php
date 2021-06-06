<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;
use CodeZero\UniqueTranslation\UniqueTranslationRule;

class AreaRequest extends FormRequest
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
        $areaId = request()->area ?? null;

        return [
            'name.*' => ['required', UniqueTranslationRule::for('areas', 'name')->where('city_id', request()->city_id)->ignore($areaId)],
            'city_id' => 'required|exists:cities,id',
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
