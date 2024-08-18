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
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('merchant_id')->nullable();
            $table->string('amount')->nullable();
            $table->string('refid')->nullable();
            $table->string('track_id')->nullable();
            $table->string('allowed_card')->nullable();
            $table->string('authority')->nullable();
            $table->string('transaction')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('driver')->nullable();
            $table->string('currency')->nullable();
            $table->string('order_code')->nullable();
            $table->string('payer_mobile')->nullable();
            $table->string('payer_email')->nullable();
            $table->string('payer_description')->nullable();
            $table->string('gateway')->nullable();
            $table->string('callback_url')->nullable();
            $table->string('status')->nullable()->default(0);
            $table->string('status_gateway')->nullable();
            $table->string('response_bk')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('merchant_id')->references('id')->on('merchants')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
