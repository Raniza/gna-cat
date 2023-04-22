<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('model_part_process', function (Blueprint $table) {
            $table->unsignedBigInteger('part_id');
            $table->unsignedBigInteger('process_id');
            $table->unsignedBigInteger('main_process_id');
            $table->unsignedBigInteger('model_id');

            $table->foreign('part_id')->references('id')->on('parts');
            $table->foreign('process_id')->references('id')->on('master_processes');
            $table->foreign('main_process_id')->references('id')->on('main_processes');
            $table->foreign('model_id')->references('id')->on('models');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('model_part_process');
    }
};
