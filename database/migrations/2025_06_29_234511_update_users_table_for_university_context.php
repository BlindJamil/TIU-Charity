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
        Schema::table('users', function (Blueprint $table) {
            // Remove country field
            $table->dropColumn('country');
            
            // Add university-relevant fields
            $table->string('student_id')->nullable()->after('city');
            $table->string('department')->nullable()->after('student_id');
            $table->string('graduation_year')->nullable()->after('department');
            $table->text('address')->nullable()->after('graduation_year');
            $table->string('emergency_contact')->nullable()->after('address');
            $table->string('emergency_phone')->nullable()->after('emergency_contact');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Restore country field
            $table->string('country')->nullable()->after('city');
            
            // Remove university-relevant fields
            $table->dropColumn([
                'student_id',
                'department', 
                'graduation_year',
                'address',
                'emergency_contact',
                'emergency_phone'
            ]);
        });
    }
};
