<?php

/*
*
* Migration Class
* Creates participation_histories table in the database
*
*/

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ParticipationTableCreate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participation_histories', function($table){
            $table->timestamps();
            
            $table->integer('participant_id')->unsigned();
            $table->integer('competition_id')->unsigned();

            $table->primary(['participant_id', 'competition_id']);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
