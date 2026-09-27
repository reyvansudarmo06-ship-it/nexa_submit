<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ai_analyses', function (Blueprint $table) {
            $table->unsignedTinyInteger('score')->nullable()->after('status');
            $table->text('completeness')->nullable()->after('score');
            $table->text('quality')->nullable()->after('completeness');
            $table->text('deadline_status')->nullable()->after('quality');
        });
    }

    public function down(): void
    {
        Schema::table('ai_analyses', function (Blueprint $table) {
            $table->dropColumn([
                'score',
                'completeness',
                'quality',
                'deadline_status',
            ]);
        });
    }
};