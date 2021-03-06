<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserRole
 * @package App\Models
 * @mixin Builder
 */
class UserRole extends Model
{
    use HasFactory;

    public $timestamps = false;

    public const ROLE_ADMIN = 1;
    public const ROLE_MEMBER = 0;

    /**
     * @var string[]
     */
    public $fillable = [
        'user_id',
        'role'
    ];

    /**
     * @return bool
     */
    public function isAdmin()
    {
        return $this->role === static::ROLE_ADMIN;
    }

    /**
     * Связь с таблицей пользователей
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
