<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('educations', function (Blueprint $table) {
            $table->id('education_id');
            $table->string('principal', 32);
            $table->string('grade', 8);
            $table->tinyInteger('grade');
            $table->string('school_name', 64);
            $table->string('location', 64);
            $table->string('major', 64);
            $table->string('diploma_number', 64);
            $table->string('diploma_date', 64);
            $table->string('diploma_file', 128);
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
        Schema::dropIfExists('educations');
    }
}
