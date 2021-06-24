<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class User
 * @mixin Builder
 * @package App\Models
 * @property $id int
 */
class User extends Authenticatable
{

    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'email_verified_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne|UserWallet
     */
    public function wallet():\Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(UserWallet::class, 'user_id', 'id');
    }

    /**
     * Возвращает баланс пользователя
     * @return int
     */
    public function balance():int
    {
        /* @var $wallet UserWallet */
        $wallet = $this->wallet;

        return $wallet === null
            ? 0
            : $wallet->balance;
    }

    /**
     * Возвращает модель роли
     * @return HasOne
     */
    public function role():HasOne
    {
        return $this->hasOne(UserRole::class, 'user_id');
    }

    /**
     * Проверяет явялется ли пользователь админом или нет
     * // конечно не особо правильно вешать такое на модель, но ладно, пока что тут оставлю
     * @return bool
     * @throws \Exception
     */
    public function isAdmin()
    {
        $role = $this->role ;
        if ($role === null) {
            throw new \Exception('Пользователь не может быть без роли!');
        }

        return $role->role === UserRole::ROLE_ADMIN;
    }
}
