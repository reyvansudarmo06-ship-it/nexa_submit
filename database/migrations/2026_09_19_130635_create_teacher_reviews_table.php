<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('teacher_reviews', function (Blueprint $table) {
            $table->id();

            $table->foreignId('submission_id')
                ->constrained('submissions')
                ->cascadeOnDelete();

            $table->foreignId('teacher_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->unsignedTinyInteger('score')->nullable();

            $table->text('comment')->nullable();

            $table->string('status')->default('reviewed');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teacher_reviews');
    }
};