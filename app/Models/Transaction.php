<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Transaction
 * @package App\Models
 * @mixin Builder
 */
class Transaction extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'sender_id',
        'recipient_id',
        'sender_result_balance',
        'recipient_result_balance',
        'amount',
    ];

    /**
     * Пользователь, который получил деньги
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function recipient()
    {
        return $this->hasOne(User::class, 'id', 'recipient_id');
    }

    /**
     * Пользователь, отправил отправил деньги
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function sender()
    {
        return $this->hasOne(User::class, 'id', 'sender_id');
    }
}
