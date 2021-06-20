<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InsertSudoUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::table('users')->insert(
            [
                'id' => 1,
                'name' => 'Superuser Do',
                'email' => 'sudo@localhost.loc',
                'password' => \Illuminate\Support\Facades\Hash::make('password_0'),
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Illuminate\Support\Facades\DB::table('users')->delete(1);
    }
}
