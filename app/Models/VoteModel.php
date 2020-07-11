<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class VoteModel {

    //QUESTION VOTE

    //check that the user has voted (get user id && question id) 
    public static function questionVote($id) {
        $userId = Auth::id();
        $data = DB::table('vote_questions')
                    ->where([
                        ['question_id', $id],
                        ['user_id', $userId]
                    ])->doesntExist();
        return $data;
        //SELECT count(pertanyaan_id) FROM `jawaban` WHERE `pertanyaan_id` = 9
    }

    //insert vote question
    public static function saveQuestionVote($data) {
        $new_vote = DB::table('vote_questions')->insert($data);
        return $new_vote;
    }

    //cancel vote question
    public static function deleteQuestionVote($id, $userId) {
        $del = DB::table('vote_questions')
                    ->where([
                        ['question_id', $id],
                        ['user_id', $userId]
                    ])
                    ->delete();
        return $del;
    }
    
    //total upvote
    public static function upvoteQuestionTotal($id) {
        $total = DB::table('vote_questions')
                    ->where([
                        ['question_id', $id],
                        ['upvote', 1]
                    ])
                    ->count();
        return $total;
    }

    //total downvote
    public static function downvoteQuestionTotal($id) {
        $total = DB::table('vote_questions')
                    ->where([
                        ['question_id', $id],
                        ['downvote', 1]
                    ])
                    ->count();
        return $total;
    }


    //ANSWER VOTE

    //check that the user has voted (get user id && question id) 
    public static function answerVote($id) {
        $userId = Auth::id();
        $data = DB::table('vote_answers')
                    ->where([
                        ['answer_id', $id],
                        ['user_id', $userId]
                    ])->get();
        return $data;
    }

    //insert vote question
    public static function saveAnswerVote($data) {
        $new_vote = DB::table('vote_answers')->insert($data);
        return $new_vote;
    }

    //cancel vote question
    public static function deleteAnswerVote($id, $userId) {
        $del = DB::table('vote_answers')
                    ->where([
                        ['answer_id', $id],
                        ['user_id', $userId]
                    ])
                    ->delete();
        return $del;
    }

    //total upvote
    public static function upvoteAnswerTotal($id) {
        $total = DB::table('vote_answers')
                    ->where([
                        ['question_id', $id],
                        ['upvote', 1]
                    ])
                    ->count();
        return $total;
    }

    //total downvote
    public static function downvoteAnswerTotal($id) {
        $total = DB::table('vote_questions')
                    ->where([
                        ['question_id', $id],
                        ['downvote', 1]
                    ])
                    ->count();
        return $total;
    }

    
}

?>