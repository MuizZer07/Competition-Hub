<?php

/*
*
* Migration Class
* Creates competitions table in the database
*
*/

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompetitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competitions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('venue');
            $table->date('event_date');
            $table->date('reg_deadline');
            $table->mediumText('description');
            $table->integer('catagory_id')->unsigned();
            $table->integer('organizer_teams_id')->unsigned();
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
        Schema::dropIfExists('competitions');
    }
}
