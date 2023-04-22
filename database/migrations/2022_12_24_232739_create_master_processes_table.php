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
        Schema::create('master_processes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('main_process_id');
            $table->string('name');
            $table->timestamps();

            $table->foreign('main_process_id')->references('id')->on('main_processes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_processes');
    }
};
