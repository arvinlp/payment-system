<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->comment('USD Doller');
            $table->string('code')->comment('$');
            $table->double('exchange',16,4)->comment('1$ = 0,99 euro');
            $table->smallInteger('location')->comment('1:right ,2:left ,3:right with space ,4:left with space');
            $table->tinyInteger('status')->unsigned()->nullable()->default(1);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('currency_id')->nullable();
            $table->foreign('currency_id')->references('id')->on('currencies')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('currencies');
    }
}
