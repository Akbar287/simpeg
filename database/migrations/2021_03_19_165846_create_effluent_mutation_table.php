<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEffluentMutationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('effluent_mutation', function (Blueprint $table) {
            $table->foreignId('effluent_id');
            $table->foreignId('mutation_id');
            $table->primary(['effluent_id', 'mutation_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('effluent_mutation');
    }
}
