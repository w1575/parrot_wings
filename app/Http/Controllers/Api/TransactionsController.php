<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionValidator;
use App\Http\Resources\TransactionCollection;
use App\Models\Transaction;
use App\Services\TransactionService;
use Illuminate\Support\Facades\DB;


class TransactionsController extends Controller
{

    /**
     * @return TransactionCollection
     */
    public function index()
    {
        $transactions = Transaction::query()
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
