<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InsertSudoAdminRole extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::table(
            'user_roles'
        )->insert(
            ['user_id' => 1, 'role' => \App\Models\UserRole::ROLE_ADMIN]
        );
        ;
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Illuminate\Support\Facades\DB::table(
            'user_roles'
        )
        ->delete('1');
    }
}
