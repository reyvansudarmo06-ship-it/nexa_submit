<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ai_analyses', function (Blueprint $table) {
            $table->unsignedTinyInteger('instruction_score')
                ->default(0)
                ->after('score');

            $table->unsignedTinyInteger('completeness_score')
                ->default(0)
                ->after('instruction_score');

            $table->unsignedTinyInteger('quality_score')
                ->default(0)
                ->after('completeness_score');

            $table->unsignedTinyInteger('neatness_score')
                ->default(0)
                ->after('quality_score');

            $table->unsignedTinyInteger('deadline_score')
                ->default(0)
                ->after('neatness_score');
        });
    }

    public function down(): void
    {
        Schema::table('ai_analyses', function (Blueprint $table) {
            $table->dropColumn([
                'instruction_score',
                'completeness_score',
                'quality_score',
                'neatness_score',
                'deadline_score',
            ]);
        });
    }
};