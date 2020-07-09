<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateVoteQuestion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vote_questions', function (Blueprint $table) {
            $table->increments('vote_question_id');
            $table->boolean('upvote')->nullable()->default(0);
            $table->boolean('downvote')->nullable()->default(0);
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('question_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('question_id')->references('question_id')->on('questions')->onDelete('cascade');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vote_question');
    }
}
