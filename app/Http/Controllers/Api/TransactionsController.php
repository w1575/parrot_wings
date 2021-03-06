<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionValidator;
use App\Http\Resources\TransactionCollection;
use App\Models\Transaction;
use App\Services\TransactionService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Request;


class TransactionsController extends Controller
{

    /**
     * @return TransactionCollection
     */
    public function index(\Illuminate\Http\Request $request)
    {
        $user = $request->user();
        $transactions = Transaction::query()
            ->where('recipient_id', '=', $user->id)
            ->orWhere('sender_id', '=', $user->id)
            ->orderBy('id', 'DESC')
            ->simplePaginate()
        ;

        return TransactionCollection::make($transactions);
    }

    /**
     * @param TransactionValidator $request
     * @return string[]
     */
    public function create(TransactionValidator $request)
    {
        $request->validate($request->rules());

        $recipientId = $request->get('recipient_id');
        $amount = $request->get('amount');
        $user = $request->user();

        $transactionService = new TransactionService($user, $recipientId, $amount);
        $transactionService->create();

        return [
            'current_balance' => $user->balance()
        ];
    }
}
