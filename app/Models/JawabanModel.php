<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;

class JawabanModel {

    public static function get_all($id) {
        $question = DB::table('questions')
            ->where('question_id', '=', $id)
            ->get();

        $answers = DB::table('answers')
            ->where('question_id', '=', $id)
            ->get();
        //dd($items3);

        return [$question, $answers];
    }

    public static function findById($id) {
        $data = DB::table('answers')
                    ->where('answers_id', $id)
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
}


?>