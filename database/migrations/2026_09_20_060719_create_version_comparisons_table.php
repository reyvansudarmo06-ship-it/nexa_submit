<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('version_comparisons', function (Blueprint $table) {
            $table->id();

            $table->foreignId('submission_id')
                ->constrained('submissions')
                ->cascadeOnDelete();

            $table->foreignId('from_version_id')
                ->constrained('submission_versions')
                ->cascadeOnDelete();

            $table->foreignId('to_version_id')
                ->constrained('submission_versions')
                ->cascadeOnDelete();

            $table->unsignedTinyInteger('from_score')->nullable();

            $table->unsignedTinyInteger('to_score')->nullable();

            $table->integer('score_change')->nullable();

            $table->text('improvement_summary')->nullable();

            $table->text('improved_areas')->nullable();

            $table->text('remaining_issues')->nullable();

            $table->text('ai_recommendation')->nullable();

            $table->string('status')->default('completed');

            $table->timestamps();

            $table->unique([
                'from_version_id',
                'to_version_id'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('version_comparisons');
    }
};