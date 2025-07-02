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
        Schema::create('achievements', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->longText('detailed_description');
            $table->string('category');
            $table->decimal('amount', 12, 2);
            $table->date('completion_date');
            $table->string('location');
            $table->string('main_image')->nullable();
            
            // Impact stats
            $table->string('impact_stat_1_value');
            $table->string('impact_stat_1_label');
            $table->string('impact_stat_2_value');
            $table->string('impact_stat_2_label');
            
            // JSON fields for complex data
            $table->json('detailed_stats')->nullable();
            $table->json('financial_breakdown')->nullable();
            $table->json('accomplishments')->nullable();
            $table->json('gallery_photos')->nullable();
            $table->json('testimonials')->nullable();
            $table->json('documents')->nullable();
            
            // Status and ordering
            $table->boolean('is_featured')->default(true);
            $table->integer('sort_order')->default(0);
            $table->enum('status', ['active', 'inactive'])->default('active');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('achievements');
    }
};