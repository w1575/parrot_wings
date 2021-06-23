<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_roles', function (Blueprint $table) {
            $table
                ->foreignId('user_id')
                ->comment('Пользователь')
                ->constrained('users')
                ->cascadeOnDelete()
            ;
            $table
                ->tinyInteger('role')
                ->comment('Роль [0 - пользователь, 1 - админ]')
                ->default(0)
            ;
            $table->unique(
               'user_id',
                'idx-user-role'
            );
            // исхожу из того, что админ у нас может быть один,
            // и в целом нет функционала по назначению ролей

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_roles');
    }
}
