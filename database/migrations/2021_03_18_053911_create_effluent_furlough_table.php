<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEffluentFurloughTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('effluent_furlough', function (Blueprint $table) {
            $table->foreignId('effluent_id');
            $table->foreignId('furlough_id');
            $table->primary(['effluent_id', 'furlough_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('effluent_furlough');
    }
}
