<?php
/* @var $transactions \App\Models\Transaction */
?>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Личный кабинет') }}
        </h2>
    </x-slot>

    <h2>
        <strong>
            Последние транзакции:
        </strong>
    </h2>

    <p>

        @isset($transactions)
            @foreach($transactions as $transaction)
                {{ $transaction->name }}
            @endforeach
        @endisset



        @if($transactions->isEmpty())
            <p> Нет последних транзакций </p>
        @endif

    </p>

</x-app-layout>
