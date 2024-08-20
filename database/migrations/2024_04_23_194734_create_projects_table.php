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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();

            $table->string('name')->default('Generic name');
            $table->string('description')->nullable()->default("");
            $table->boolean('saved')->default(false);
            $table->integer('allow')->default(0);
            $table->integer('flag')->default(0);
            $table->integer('block')->default(0);
            $table->integer('very_low')->default(0);
            $table->integer('low')->default(0);
            $table->integer('medium_low')->default(0);
            $table->integer('medium')->default(0);
            $table->integer('high')->default(0);
            $table->integer('very_high')->default(0);
            $table->json('countries')->nullable()->default(null);
            $table->boolean('scored')->default(false);

            $table->integer('high_positive_rate')->default(50);
            $table->integer('very_high_positive_rate')->default(90);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
