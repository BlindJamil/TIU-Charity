<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add status column if it doesn't exist
        if (!Schema::hasColumn('donations', 'status')) {
            Schema::table('donations', function (Blueprint $table) {
                $table->string('status')->default('pending');
            });
        }
        
        // Add receipt_expires_at if it doesn't exist
        if (!Schema::hasColumn('donations', 'receipt_expires_at')) {
            Schema::table('donations', function (Blueprint $table) {
                $table->timestamp('receipt_expires_at')->nullable();
            });
        }
        
        // Add completed_at if it doesn't exist
        if (!Schema::hasColumn('donations', 'completed_at')) {
            Schema::table('donations', function (Blueprint $table) {
                $table->timestamp('completed_at')->nullable();
            });
        }
        
        // Add admin_notes if it doesn't exist
        if (!Schema::hasColumn('donations', 'admin_notes')) {
            Schema::table('donations', function (Blueprint $table) {
                $table->text('admin_notes')->nullable();
            });
        }
        
        // Add receipt_expiry_days to causes table if it doesn't exist
        if (!Schema::hasColumn('causes', 'receipt_expiry_days')) {
            Schema::table('causes', function (Blueprint $table) {
                $table->integer('receipt_expiry_days')->default(7);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Only drop columns if they exist
        if (Schema::hasColumn('donations', 'status')) {
            Schema::table('donations', function (Blueprint $table) {
                $table->dropColumn('status');
            });
        }
        
        if (Schema::hasColumn('donations', 'receipt_expires_at')) {
            Schema::table('donations', function (Blueprint $table) {
                $table->dropColumn('receipt_expires_at');
            });
        }
        
        if (Schema::hasColumn('donations', 'completed_at')) {
            Schema::table('donations', function (Blueprint $table) {
                $table->dropColumn('completed_at');
            });
        }
        
        if (Schema::hasColumn('donations', 'admin_notes')) {
            Schema::table('donations', function (Blueprint $table) {
                $table->dropColumn('admin_notes');
            });
        }
        
        if (Schema::hasColumn('causes', 'receipt_expiry_days')) {
            Schema::table('causes', function (Blueprint $table) {
                $table->dropColumn('receipt_expiry_days');
            });
        }
    }
};