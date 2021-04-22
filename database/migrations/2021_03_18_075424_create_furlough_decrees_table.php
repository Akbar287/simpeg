<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFurloughDecreesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('furlough_decrees', function (Blueprint $table) {
            $table->foreignId('furlough_id');
            $table->foreignId('decree_id');
            $table->primary(['decree_id', 'furlough_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('furlough_decrees');
    }
}
