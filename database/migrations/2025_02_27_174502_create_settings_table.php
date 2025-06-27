<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('settings', function (Blueprint $table) {
        $table->id();
        $table->boolean('enable_money_donations')->default(true);
        $table->boolean('enable_clothes_donations')->default(true);
        $table->boolean('enable_food_donations')->default(true);
        $table->timestamps();
    });

    // Insert default settings
    DB::table('settings')->insert([
        'enable_money_donations' => true,
        'enable_clothes_donations' => true,
        'enable_food_donations' => true,
        'created_at' => now(),
        'updated_at' => now(),
    ]);
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
