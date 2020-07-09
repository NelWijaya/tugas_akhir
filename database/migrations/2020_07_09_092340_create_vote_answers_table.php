<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateVoteAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vote_answers', function (Blueprint $table) {
            $table->increments('vote_answer_id');
            $table->boolean('upvote')->nullable()->default(0);
            $table->boolean('downvote')->nullable()->default(0);
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('answer_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('answer_id')->references('answer_id')->on('answers')->onDelete('cascade');
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
        Schema::dropIfExists('vote_answers');
    }
}
