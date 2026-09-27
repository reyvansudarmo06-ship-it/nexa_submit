<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('submissions', function (Blueprint $table) {

            $table->foreignId('assignment_id')
                ->after('id')
                ->constrained('assignments')
                ->cascadeOnDelete();

            $table->foreignId('student_id')
                ->after('assignment_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->string('file_name')
                ->after('student_id');

            $table->string('file_path')
                ->after('file_name');

            $table->text('note')
                ->nullable()
                ->after('file_path');

            $table->string('status')
                ->default('submitted')
                ->after('note');

            $table->unique(['assignment_id', 'student_id']);
        });
    }

    public function down(): void
    {
        Schema::table('submissions', function (Blueprint $table) {

            $table->dropForeign(['assignment_id']);
            $table->dropForeign(['student_id']);

            $table->dropUnique([
                'submissions_assignment_id_student_id_unique'
            ]);

            $table->dropColumn([
                'assignment_id',
                'student_id',
                'file_name',
                'file_path',
                'note',
                'status',
            ]);
        });
    }
};