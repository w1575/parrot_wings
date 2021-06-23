<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserWallets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_wallets', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\User::class,  'user_id')
                ->comment('Пользователь')
//                ->primary()
            ;
            $table->timestamps();
            $table->integer('balance')
                ->default(500)
                ->comment('Баланс')
                ->nullable(false)
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
        Schema::dropIfExists('user_wallets');
    }
}
