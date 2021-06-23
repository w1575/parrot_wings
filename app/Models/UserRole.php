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

}
