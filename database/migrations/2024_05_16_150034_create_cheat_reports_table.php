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
        Schema::create('cheat_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('exam_setup_id');
            $table->unsignedBigInteger('invigilator_id');
            $table->unsignedBigInteger('student_id');
            // $table->string('exam_password');
            $table->string('description');
            $table->foreign('exam_setup_id')->references('id')->on('exam_setups')->onDelete('cascade');
            $table->foreign('invigilator_id')->references('id')->on('invigilators')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cheat_reports');
    }
};