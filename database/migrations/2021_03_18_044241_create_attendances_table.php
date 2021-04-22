<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id('attendace_id');
            $table->foreignId('user_id');
            $table->date('date_work')->nullable();
            $table->time('start_work')->nullable();
            $table->time('finish_work')->nullable();
            $table->string('jenis_kerja', 8);
            $table->text('keterangan')->nullable();
            $table->bigInteger('stamp')->unsigned()->nullable();
            $table->text('image')->nullable();
            $table->text('location')->nullable();
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
        Schema::dropIfExists('attendances');
    }
}
