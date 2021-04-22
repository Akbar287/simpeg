<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDecreesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('decrees', function (Blueprint $table) {
            $table->id('decree_id');
            $table->string('title', 128);
            $table->string('sk_number', 128);
            $table->date('sk_date_start');
            $table->date('sk_date_finish')->nullable();
            $table->string('sk_file')->nullable();
            $table->foreignId('signature')->nullable();
            $table->text('information')->nullable();
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
        Schema::dropIfExists('decrees');
    }
}
