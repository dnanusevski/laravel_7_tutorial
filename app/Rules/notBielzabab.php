<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class notBielzabab implements Rule
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
        //
		return $value == "Bielzabab";
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Bielzabab is not allowed to join our server.';
    }
}
