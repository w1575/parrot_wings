<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class Transaction extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        /* @var $user User */
        $user = auth()->user();

        // это небольшой велосипед, плохое, на мой взягляд решение,
        // однако оставлю пока что так
        // нужно чтобы пользователь не видел баланс другого пользователя
        switch ($user->id) {
            case ($this->recipient_id):
                $balanceAttribute = 'recipient_result_balance';
                break;
            case ($this->sender_id):
                $balanceAttribute = 'sender_result_balance';
                break;
            default:
                // TODO: выкинуть чтоль ошибку?
            ;
        }
        return [
            'created_at' => $this->created_at,
            'sender_id' => $this->sender_id,
            'recipient_id' => $this->recipient_id,
            'amount' => $this->amount,
            'result_balance' => $this->{$balanceAttribute},
        ];
    }
}
