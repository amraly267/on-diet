<?php

namespace App\Rules\Dashboard;

use Illuminate\Contracts\Validation\Rule;

class ValidateDomain implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (stripos($value, 'localhost') !== false) {
            return true;
        }

        return (bool) preg_match('/^(?:[a-z0-9](?:[a-z0-9-æøå]{0,61}[a-z0-9])?\.)+[a-z0-9][a-z0-9-]{0,61}[a-z0-9]$/isu', $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans(config('dashboard.trans_file').'invalid_host');
    }
}
