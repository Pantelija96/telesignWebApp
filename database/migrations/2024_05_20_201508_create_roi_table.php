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
        Schema::create('roi', function (Blueprint $table) {
            $table->id();

            $table->dateTime('job_date')->default(date('Y-m-d H:i:s'));
            $table->dateTime('period_from')->nullable();
            $table->dateTime('period_to')->nullable();
            $table->integer('period_multiplier')->default(1);
            $table->float('roi')->default(0);
            $table->integer('fraud_transactions_avoided')->default(0);
            $table->float('average_value_of_transaction')->default(15);
            $table->float('fraud_avoided_by')->default(0);
            $table->integer('monthly_cost')->default(5000);
            $table->float('other_costs_all_numbers')->default(0);
            $table->float('other_costs_fraud_numbers')->default(0);
            $table->float('total_cost')->default(0);
            $table->float('cost_per_phone')->default(0.005);
            $table->float('total_per_phone')->default(0);
            $table->float('average_sms')->default(0.06);
            $table->float('total_sms')->default(0);
            $table->float('other_savings')->default(0);
            $table->float('total_savings')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roi');
    }
};
