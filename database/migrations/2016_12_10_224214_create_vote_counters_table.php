<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoteCountersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vote_counters', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('candidate_id');
            $table->string('user_id');
            $table->string('election_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('vote_counters');
    }
}
