<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('perfil_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('perfil_id')->references('id')->on('p_perfils');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('p_users');
    }
}
