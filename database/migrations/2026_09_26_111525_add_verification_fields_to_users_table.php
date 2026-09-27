<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('verification_status', [
                'pending',
                'verified',
                'rejected',
            ])->default('pending')->after('role');

            $table->boolean('is_active')
                ->default(false)
                ->after('verification_status');

            $table->timestamp('verified_at')
                ->nullable()
                ->after('is_active');

            $table->foreignId('verified_by')
                ->nullable()
                ->after('verified_at')
                ->constrained('users')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['verified_by']);

            $table->dropColumn([
                'verification_status',
                'is_active',
                'verified_at',
                'verified_by',
            ]);
        });
    }
};