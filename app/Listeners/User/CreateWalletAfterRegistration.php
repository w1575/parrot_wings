<?php


namespace App\Listeners\User;


use App\Models\User;
use App\Models\UserWallet;
use Database\Factories\UserWalletFactory;
use Illuminate\Auth\Events\Registered;

class CreateWalletAfterRegistration
{
    /**
     * Создание кошеклька пользователя после успешной регистрации
     * @param Registered $event
     */
    public function handle(Registered $event)
    {
        /* @var $user User*/
        $user = $event->user;
        $id = $user->id;


        $wallet = UserWallet::create(
            [
                'user_id' => $id,
                'balance' => 500
            ]
        );
        // думал изначально использовать транзакцию, однако т.к. повесил на ивент, то придется удалять пользователя
        // обычным способом, ибо не гоже пользователю быть без кашелька
        if (! $wallet instanceof UserWallet) {
            $user->delete();
        }
    }
}
