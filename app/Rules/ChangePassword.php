<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\User;

class ChangePassword implements Rule
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
     * @param  mixed  $password
     * @return bool
     */
    public function passes($attribute, $password)
    {
        $dublicate = User::is_dublicate_password($password,Auth::user()->id);
        return !$dublicate;

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Новий пароль співпадає зі старим.';
    }
}
