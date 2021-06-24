<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table
                ->foreignId('sender_id')
                ->comment('Отправитель')
                ->constrained('users')
                ->cascadeOnDelete()
            ;
            $table
                ->foreignId('recipient_id')
                ->comment('Получатель')
                ->constrained('users')
                ->cascadeOnDelete()
            ;
            $table
                ->integer('sender_result_balance')
                ->comment('Остаток на балансе отправителя')
                ->nullable(false);
            $table
                ->integer('recipient_result_balance')
                ->comment('Остаток на балансе отправителя')
                ->nullable(false);
            $table
                ->integer('amount')
                ->comment('Сумма транзакции')
            ;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
