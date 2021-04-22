<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFurloughsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('furloughs', function (Blueprint $table) {
            $table->id('furlough_id');
            $table->string('type_furlough', 32);
            $table->integer('long_furlough');
            $table->string('in_number', 32);
            $table->string('time_format', 8);
            $table->date('start_date');
            $table->date('finish_date');
            $table->tinyInteger('status');
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
        Schema::dropIfExists('furloughs');
    }
}
