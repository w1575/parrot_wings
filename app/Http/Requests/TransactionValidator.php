<?php

namespace App\Http\Requests;

use App\Rules\BalanceGreaterThanSum;
use App\Rules\NotSelf;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\Sanctum;

class TransactionValidator extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $user = $this->user();

        return [
            'recipient_id' => [
                'required',
                'integer',
                new NotSelf($user)
            ],
            'sum' => [
                'required',
                'integer',
                'min:1',
                new BalanceGreaterThanSum($user)
            ]
        ];
    }
}
