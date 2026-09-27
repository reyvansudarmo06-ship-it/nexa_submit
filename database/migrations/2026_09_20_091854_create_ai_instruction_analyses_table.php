<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ai_instruction_analyses', function (Blueprint $table) {

            $table->id();

            $table->foreignId('assignment_id')
                ->constrained('assignments')
                ->cascadeOnDelete();

            $table->text('summary')->nullable();

            $table->text('objective')->nullable();

            $table->text('requirements')->nullable();

            $table->text('checklist')->nullable();

            $table->text('important_notes')->nullable();

            $table->text('step_by_step')->nullable();

            $table->string('status')->default('completed');

            $table->timestamps();

            $table->unique('assignment_id');

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ai_instruction_analyses');
    }
};