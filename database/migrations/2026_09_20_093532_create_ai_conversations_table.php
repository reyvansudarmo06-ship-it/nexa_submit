<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ai_conversations', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('assignment_id')
                ->nullable()
                ->constrained('assignments')
                ->nullOnDelete();

            $table->text('message');

            $table->text('response');

            $table->string('status')->default('completed');

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ai_conversations');
    }
};