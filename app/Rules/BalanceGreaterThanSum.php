<?php

namespace App\Rules;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class BalanceGreaterThanSum implements Rule
{
    /**
     * Модель пользователя, для которого будет произведена проверка
     * @var User
     */
    private $userModel;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(User $userModel)
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
        $balance = $this->userModel->balance();

        return $value <= $balance;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'На Вашем счете недостаточно средств.';
    }
}
