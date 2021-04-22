<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('nip')->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->text('profile_photo')->nullable();
            $table->string('religion', 16);
            $table->string('gender', 8);
            $table->char('blood_type', 2);
            $table->string('place_born', 32);
            $table->date('date_born');
            $table->string('marital_status', 16);
            $table->string('address');
            $table->string('telephone_number', 24);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
