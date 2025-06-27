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
            // Check if columns already exist before trying to add them
            if (!Schema::hasColumn('donations', 'user_id')) {
                $table->foreignId('user_id')->nullable()->after('id')->constrained()->onDelete('set null');
            }
            
            if (!Schema::hasColumn('donations', 'cause_id')) {
                $table->foreignId('cause_id')->nullable()->after('user_id')->constrained()->onDelete('set null');
            }
            
            if (!Schema::hasColumn('donations', 'transaction_id')) {
                $table->string('transaction_id')->nullable()->after('amount');
            }
            
            if (!Schema::hasColumn('donations', 'status')) {
                $table->string('status')->default('pending')->after('payment_method');
            }
            
            if (!Schema::hasColumn('donations', 'message')) {
                $table->text('message')->nullable()->after('status');
            }
            
            if (!Schema::hasColumn('donations', 'anonymous')) {
                $table->boolean('anonymous')->default(false)->after('message');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            // Only drop if columns exist
            try {
                if (Schema::hasColumn('donations', 'user_id')) {
                    $table->dropForeign(['user_id']);
                }
                
                if (Schema::hasColumn('donations', 'cause_id')) {
                    $table->dropForeign(['cause_id']);
                }
            } catch (\Exception $e) {
                // Foreign key might not exist, continue anyway
            }
            
            // Try to drop columns that might exist
            $columns = ['user_id', 'cause_id', 'transaction_id', 'status', 'message', 'anonymous'];
            foreach ($columns as $column) {
                if (Schema::hasColumn('donations', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};