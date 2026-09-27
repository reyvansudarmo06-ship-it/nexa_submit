<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('submission_version_ai_analyses', function (Blueprint $table) {
            $table->id();

            $table->foreignId('submission_version_id')
                ->constrained('submission_versions')
                ->cascadeOnDelete();

            $table->text('summary')->nullable();

            $table->text('instruction_match')->nullable();

            $table->text('strengths')->nullable();

            $table->text('weaknesses')->nullable();

            $table->text('suggestions')->nullable();

            $table->unsignedTinyInteger('score')->nullable();

            $table->text('completeness')->nullable();

            $table->text('quality')->nullable();

            $table->string('status')->default('completed');

            $table->timestamps();

            $table->unique('submission_version_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('submission_version_ai_analyses');
    }
};