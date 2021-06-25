<?php


namespace App\Http\Controllers\Api;


use App\Http\Filters\UserFilter;
use App\Http\Resources\UserCollection;
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


        $users = User::filter($filter)
            ->userIsMember()
            ->simplePaginate(5)
        ;

        return UserCollection::make($users);
    }
}
