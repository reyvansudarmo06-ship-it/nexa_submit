<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('submission_versions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('submission_id')
                ->constrained('submissions')
                ->cascadeOnDelete();

            $table->unsignedInteger('version_number');

            $table->string('file_name');

            $table->string('file_path');

            $table->text('note')->nullable();

            $table->string('status')->default('submitted');

            $table->timestamps();

            $table->unique([
                'submission_id',
                'version_number'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('submission_versions');
    }
};