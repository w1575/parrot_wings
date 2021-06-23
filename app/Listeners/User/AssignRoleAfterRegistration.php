<?php


namespace App\Listeners\User;


use App\Models\User;
use App\Models\UserRole;
use Illuminate\Auth\Events\Registered;

class AssignRoleAfterRegistration
{
    /**
     * @param Registered $event
     */
    public function handle(Registered $event)
    {
        /* @var $user User*/
        $user = $event->user;

        try {
            $role = UserRole::create(
                [
                    'user_id' => $user->id,
                    'role' => UserRole::ROLE_MEMBER,
                ]
            );
        } catch (\Exception $e) {
            $user->delete();
        }

        if (! $role instanceof UserRole) {
            $user->delete();
            // в принципе этого должно быть достаточно, ведь, например,
            // я поставил cascade on delete
        }
    }
}
