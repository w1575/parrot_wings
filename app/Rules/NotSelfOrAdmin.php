<?php

namespace App\Rules;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Contracts\Validation\Rule;

class NotSelfOrAdmin implements Rule
{
    /**
     * @var User
     */
    private $userModel;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($userModel)
    {
        $this->userModel = $userModel;
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
        return $this->userModel->id !== (int) $value;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Вы не можете переводить деньги самому себе.';
    }
}
