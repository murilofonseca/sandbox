<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_permissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('permission_name_id');
            $table->text('descricao');
            $table->string('action', 20)->nullable();
            $table->timestamps();
            
            $table->foreign('permission_name_id')->references('id')->on('p_permission_names');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('p_permissions');
    }
}
