<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamiliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('families', function (Blueprint $table) {
            $table->id('family_id');
            $table->foreignId('user_id');
            $table->string('nik', 16);
            $table->string('name', 64);
            $table->string('place_born', 32);
            $table->date('date_born');
            $table->string('education', 16);
            $table->string('work', 32);
            $table->string('relationship', 32);
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
        Schema::dropIfExists('families');
    }
}
