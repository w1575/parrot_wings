<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

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
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
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
        if ($this->wallet() === null) {
            return 'Кошелек недоступен';
        }
        return rand(0, 255); // TODO: сделать реальный гетер
    }
}
