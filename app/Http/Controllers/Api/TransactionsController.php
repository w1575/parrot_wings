<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionValidator;
use App\Models\Transaction;


class TransactionsController extends Controller
{

    public function index()
    {

    }

    /**
     * @param TransactionValidator $request
     * @return string[]
     */
    public function create(TransactionValidator $request)
    {
        $request->validate($request->rules());

        return ['its' => 'just works'];
    }
}
