<?php


namespace App\Http\Controllers\Api;


use App\Http\Filters\UserFilter;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UsersController extends \App\Http\Controllers\Controller
{
    /**
     * @param UserFilter $filter
     * @return UserCollection
     */
    public function index(UserFilter $filter)
    {
         $filter
            ->getRequest()
            ->validate([
            'name' => 'min:3'
        ]);

        $currentUserId = $filter->getRequest()->user()->id ?? null;

        $users = User::filter($filter)
            ->userIsMember()
            ->where('id', '!=', $currentUserId)
            ->simplePaginate(5)
        ;

        return UserCollection::make($users);
    }

    /**
     * Просмотр информации по пользователю
     * @param Request $request
     */
    public function view(int $id)
    {

        $user = User::query()
            ->where('id', '=', $id)
            ->first()
        ;

        if (!$user instanceof  User) {
            return [];
        }

        return UserResource::make($user);

    }
}
