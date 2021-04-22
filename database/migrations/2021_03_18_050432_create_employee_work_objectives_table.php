<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeWorkObjectivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_work_objectives', function (Blueprint $table) {
            $table->id('employee_work_objective_id');
            $table->foreignId('user_id');
            $table->string('assessor_officials', 32);
            $table->string('appraisal_official_superior', 32);
            $table->date('start_date');
            $table->date('finish_date');
            $table->tinyInteger('service_orientation_value');
            $table->tinyInteger('integrity_value');
            $table->tinyInteger('commitment_value');
            $table->tinyInteger('discipline_value');
            $table->tinyInteger('teamwork_value');
            $table->tinyInteger('leader_value');
            $table->string('rating_result', 16);
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
        Schema::dropIfExists('employee_work_objectives');
    }
}
