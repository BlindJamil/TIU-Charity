<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            // Add status column if it doesn't exist
            if (!Schema::hasColumn('donations', 'status')) {
                $table->string('status')->default('pending')->after('payment_method');
            }
            
            // Add receipt_expires_at if it doesn't exist
            if (!Schema::hasColumn('donations', 'receipt_expires_at')) {
                $table->timestamp('receipt_expires_at')->nullable()->after('status');
            }
            
            // Add completed_at if it doesn't exist
            if (!Schema::hasColumn('donations', 'completed_at')) {
                $table->timestamp('completed_at')->nullable()->after('receipt_expires_at');
            }
            
            // Add admin_notes if it doesn't exist
            if (!Schema::hasColumn('donations', 'admin_notes')) {
                $table->text('admin_notes')->nullable()->after('completed_at');
            }
        });
        
        // Add receipt_expiry_days to causes table if it doesn't exist
        Schema::table('causes', function (Blueprint $table) {
            if (!Schema::hasColumn('causes', 'receipt_expiry_days')) {
                $table->integer('receipt_expiry_days')->default(7)->after('image');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            // Only drop columns if they exist
            if (Schema::hasColumn('donations', 'status')) {
                $table->dropColumn('status');
            }
            if (Schema::hasColumn('donations', 'receipt_expires_at')) {
                $table->dropColumn('receipt_expires_at');
            }
            if (Schema::hasColumn('donations', 'completed_at')) {
                $table->dropColumn('completed_at');
            }
            if (Schema::hasColumn('donations', 'admin_notes')) {
                $table->dropColumn('admin_notes');
            }
        });
        
        Schema::table('causes', function (Blueprint $table) {
            if (Schema::hasColumn('causes', 'receipt_expiry_days')) {
                $table->dropColumn('receipt_expiry_days');
            }
        });
    }
};