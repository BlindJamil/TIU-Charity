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
            // Check if status column doesn't exist before adding
            if (!Schema::hasColumn('donations', 'status')) {
                $table->string('status')->default('pending');
            }
            
            // Check if receipt_expires_at column doesn't exist before adding
            if (!Schema::hasColumn('donations', 'receipt_expires_at')) {
                $table->timestamp('receipt_expires_at')->nullable();
            }
            
            // Check if completed_at column doesn't exist before adding
            if (!Schema::hasColumn('donations', 'completed_at')) {
                $table->timestamp('completed_at')->nullable();
            }
            
            // Check if admin_notes column doesn't exist before adding
            if (!Schema::hasColumn('donations', 'admin_notes')) {
                $table->text('admin_notes')->nullable();
            }
        });
        
        Schema::table('causes', function (Blueprint $table) {
            // Check if receipt_expiry_days column doesn't exist before adding
            if (!Schema::hasColumn('causes', 'receipt_expiry_days')) {
                $table->integer('receipt_expiry_days')->default(7);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            $table->dropColumn([
                'status',
                'receipt_expires_at',
                'completed_at',
                'admin_notes'
            ]);
        });
        
        Schema::table('causes', function (Blueprint $table) {
            $table->dropColumn('receipt_expiry_days');
        });
    }
};