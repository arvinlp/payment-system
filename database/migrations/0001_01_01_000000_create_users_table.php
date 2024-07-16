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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('nation_code')->nullable();
            $table->string('nickname')->nullable();
            $table->string('fname')->nullable();
            $table->string('lname')->nullable();
            $table->tinyInteger('sex')->unsigned()->nullable()->default(1);
            $table->timestamp('birthday',0)->useCurrent();
            $table->char('mobile',14)->unique();
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->text('img')->nullable();
            $table->text('note')->nullable();
            $table->timestamp('email_verified_at')->useCurrent();
            $table->timestamp('mobile_verified_at')->useCurrent();
            $table->tinyInteger('access_level')->unsigned()->nullable()->default(10);
            $table->tinyInteger('status')->unsigned()->nullable()->default(1);
            $table->timestamp('last_login')->useCurrent();
            $table->set('type', ['staff', 'vendor', 'client'])->default('client');
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        Schema::create('user_codes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->unique();
            $table->string('code');
            $table->string('hcode');
            $table->timestamp('send');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unique(['user_id','code'],'user_codes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('user_codes');
    }
};
