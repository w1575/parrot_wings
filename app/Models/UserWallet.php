<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property $balance int
 * @property $user_id int
 * @property $created_at string
 * @property $updated_at string
 * @mixin Builder
 * Class UserWallet
 * @package App\Models
 */
class UserWallet extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'balance',
        'user_id',
    ];
    /**
     * @var string
     */
    protected $primaryKey = 'user_id';

    /**
     * Связь с таблицей пользователей
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
