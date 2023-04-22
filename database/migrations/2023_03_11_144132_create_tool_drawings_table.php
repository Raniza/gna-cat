<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tool_drawings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('master_tool_id');
            $table->string('drawing');
            $table->integer('rev_no');
            $table->string('note')->nullable();
            $table->string('uploader');
            $table->timestamps();

            $table->foreign('master_tool_id')->references('id')->on('master_tools')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tool_drawings');
    }
};
