<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_rules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('perfil_id');
            $table->unsignedBigInteger('permission_id');
            $table->timestamps();

            $table->foreign('perfil_id')->references('id')->on('p_perfils');
            $table->foreign('permission_id')->references('id')->on('p_permission');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('p_rules');
    }
}
