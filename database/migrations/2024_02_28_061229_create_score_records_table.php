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
        Schema::create('score_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('student_registrations');
            $table->string('test_name');
            $table->string('scored_marks');
            $table->string('total_marks');
            $table->string('rank');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('score_records');
    }
};
