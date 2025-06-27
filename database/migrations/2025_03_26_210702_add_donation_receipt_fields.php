<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            if (!Schema::hasColumn('donations', 'status')) {
                $table->string('status')->default('pending');
            }
            
            if (!Schema::hasColumn('donations', 'receipt_expires_at')) {
                $table->timestamp('receipt_expires_at')->nullable();
            }
            
            if (!Schema::hasColumn('donations', 'completed_at')) {
                $table->timestamp('completed_at')->nullable();
            }
            
            if (!Schema::hasColumn('donations', 'admin_notes')) {
                $table->text('admin_notes')->nullable();
            }
        });
        
        Schema::table('causes', function (Blueprint $table) {
            if (!Schema::hasColumn('causes', 'receipt_expiry_days')) {
                $table->integer('receipt_expiry_days')->default(7);
            }
        });
    }

    public function down(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            $columns = ['status', 'receipt_expires_at', 'completed_at', 'admin_notes'];
            foreach ($columns as $column) {
                if (Schema::hasColumn('donations', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
        
        Schema::table('causes', function (Blueprint $table) {
            if (Schema::hasColumn('causes', 'receipt_expiry_days')) {
                $table->dropColumn('receipt_expiry_days');
            }
        });
    }
};