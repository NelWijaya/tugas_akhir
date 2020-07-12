<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;

class JawabanModel {

    public static function get_all($id) {
        $question = DB::table('questions')
            ->where('question_id', '=', $id)
            ->get();
        $question2 = DB::table('questions')
            ->leftJoin('users', 'questions.user_id', '=', 'users.user_id')
            ->select('users.name', 'questions.*')
            ->where('question_id', '=', $id)
            ->get();

        $answers = DB::table('answers')
            ->where('question_id', '=', $id)
            ->get();
        $answers2 = DB::table('answers')
            ->leftJoin('users', 'answers.user_id', '=', 'users.user_id')
            ->select('users.name', 'answers.*')
            ->where('question_id', '=', $id)
            ->get();

        //dd($items3);

        return [$question2, $answers2];
    }

    public static function findById($id) {
        $data = DB::table('answers')
                    ->where('answer_id', $id)
                    ->first();
        return $data;
    }

    public static function save($data) {
        $new_item = DB::table('answers')->insert($data);
        return $new_item;
    }

    public static function updateVote($request, $id){
        //dd($request);
        $vote = DB::table('answers')
                    ->where('answer_id', $id)
                    ->update([
                        'upvote_total'     => $request['upvote_total'],
                        'downvote_total'   => $request['downvote_total']
                    ]);
        return $vote;
    }

    public static function updateRelevant($id){
        //dd($request);
        $relevan = DB::table('answers')
                    ->where('answer_id', $id)
                    ->update([
                        'relevan'     => 1
                    ]);
        return $relevan;
    }
}


?>