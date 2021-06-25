<?php

namespace App\Rules;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Contracts\Validation\Rule;

class RecipientExistAndIsMember implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
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
        return User::query()
            ->join('user_roles', 'users.id', '=', 'user_roles.user_id')
            ->where('id', '=', $value)
            ->where('user_roles.role', '=', UserRole::ROLE_MEMBER)
            ->limit(1)
            ->exists()
            ;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Получаетль не найден.';
    }
}
