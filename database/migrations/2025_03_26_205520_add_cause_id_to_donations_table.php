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
            if (!Schema::hasColumn('donations', 'cause_id')) {
                $table->unsignedBigInteger('cause_id')->nullable();
                $table->foreign('cause_id')->references('id')->on('causes')->onDelete('set null');
            }
            
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
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            if (Schema::hasColumn('donations', 'cause_id')) {
                $table->dropForeign(['cause_id']);
                $table->dropColumn('cause_id');
            }
            
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
    }
};