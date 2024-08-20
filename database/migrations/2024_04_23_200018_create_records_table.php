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
        Schema::create('records', function (Blueprint $table) {
            $table->id();

            $table->string('number')->nullable();
            $table->string('ip')->nullable();
            $table->string('email')->nullable();
            $table->integer('score')->nullable();
            $table->string('type')->nullable();
            $table->string('carrier_name')->nullable();
            $table->string('risk_level')->nullable();
            $table->string('recommendation')->nullable();
            $table->string('status')->nullable();
            $table->string('country_iso')->nullable();
            $table->string('country_iso3')->nullable();
            $table->string('country_name')->nullable();
            $table->json('category')->nullable();
            $table->json('a2p')->nullable();
            $table->json('p2p')->nullable();
            $table->json('number_type')->nullable();
            $table->json('ip_insight')->nullable();
            $table->json('email_insight')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('records');
    }
};
