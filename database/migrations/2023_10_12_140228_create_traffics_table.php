<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrafficsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('traffics', function (Blueprint $table) {
            $table->id();
            $table->json('key_word');
            $table->string('url_taget', 1000);
            $table->string('url_img', 1000);
            $table->unsignedBigInteger('traffic_of_date');
            $table->unsignedBigInteger('tota_buy_traffic');
            $table->unsignedBigInteger('time_onsite_id');
            $table->foreign('time_onsite_id')->references('id')->on('time_onsites');
            $table->unsignedBigInteger('package_price');
            $table->unsignedBigInteger('traffic_type_id');
            $table->foreign('traffic_type_id')->references('id')->on('traffic_types');
            $table->string('number_phone', 255);
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('url_contain_backlink', 1000);
            $table->unsignedBigInteger('coin_payment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('traffics');
    }
}
