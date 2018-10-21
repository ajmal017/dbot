<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExchange extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exchanges', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('exchange')->nullable()->unique('exchange');
            $table->boolean('ccxt')->nullable()->default(0);
            $table->integer('use')->nullable()->default(0);
            $table->text('request')->nullable();
            $table->string('url')->nullable();
            $table->string('url_api')->nullable();
            $table->string('url_doc')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exchanges');
    }
}
