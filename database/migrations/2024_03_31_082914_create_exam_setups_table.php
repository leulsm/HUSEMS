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
        Schema::create('exam_setups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('exam_coordinator_id');
            $table->string('exam_title');
            $table->string('exam_type');
            // $table->date('date');
            $table->time('duration_time');
            $table->boolean('status')->default(false);;
            $table->integer('total_mark');
            $table->integer('pass_mark');
            $table->foreign('exam_coordinator_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_setups');
    }
};
