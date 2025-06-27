<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            // Drop the existing foreign key
            $table->dropForeign(['cause_id']);
            
            // Add it back with CASCADE DELETE
            $table->foreign('cause_id')
                  ->references('id')
                  ->on('causes')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            // Drop the cascading foreign key
            $table->dropForeign(['cause_id']);
            
            // Add back the original constraint
            $table->foreign('cause_id')
                  ->references('id')
                  ->on('causes')
                  ->onDelete('restrict');
        });
    }
};