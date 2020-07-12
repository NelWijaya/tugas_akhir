<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;

class PertanyaanModel {

    public static function get_all() {
        $question = DB::table('questions')->get();
        $question2 = DB::table('questions')
            ->leftJoin('users', 'questions.user_id', '=', 'users.user_id')
            ->select('users.name', 'questions.*')
            ->get();
        //dd($question2);
        return $question2;
    }

    public static function save($data) {
        $new_question = DB::table('questions')->insert($data);
        return $new_question;
    }

    public static function findById($id) {
        $data = DB::table('questions')
                    ->where('question_id', $id)
                    ->first();
        return $data;
    }

    public static function update($request, $id){
        //dd($request);
        $update = DB::table('questions')
                    ->where('question_id', $id)
                    ->update([
                        'question_title'     => $request['question_title'],
                        'question_content'   => $request['question_content'],
                        'tag'               => $request['tag']
                    ]);
        return $update;
    }

    public static function updateVote($request, $id){
        //dd($request);
        $vote = DB::table('questions')
                    ->where('question_id', $id)
                    ->update([
                        'upvote_total'     => $request['upvote_total'],
                        'downvote_total'   => $request['downvote_total']
                    ]);
        return $vote;
    }

    public static function delete($id) {
        $del = DB::table('questions')
                    ->where('question_id', $id)
                    ->delete();
        return $del;
    }
}

?>