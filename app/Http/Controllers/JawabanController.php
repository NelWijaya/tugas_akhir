<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\JawabanModel;
use App\Models\VoteModel;
use App\Models\UserModel;
use Redirect;


class JawabanController extends Controller
{
    public function index($id) {
        $data = JawabanModel::get_all($id);
        $question = $data[0];
        $answers = $data[1];
        $ansqty = count($answers);
        //dd($question);
        return view('pages.detail_question', compact('question', 'answers', 'id', 'ansqty')); //view to detail question
    }

    public function store(Request $request, $id){

        $data = $request->all();
        unset($data["_token"]);
        $question_id = array("question_id" => $id);
        $uid = array("user_id" => Session('id'));
        $data = array_merge($data, $question_id, $uid);
        //dd($idu);
        $ans = JawabanModel::save($data);
        $link = "/pertanyaan/" . $id;
        return Redirect::to($link); //redirect to detail question

    }

    public function updateRelevant($id){
        $answer = JawabanModel::findById($id);
        $relevant = JawabanModel::updateRelevant($id);
        $user = UserModel::get_user($answer->user_id);
        $point = $user->point + 15;
        $updatePoint = UserModel::updatePoint($point, $answer->user_id);
        $link = "/pertanyaan/" . $answer->question_id;
        return Redirect::to($link);
    }

    public function updateVote(Request $request, $id) {
        $data = $request->all();
        $answer = JawabanModel::findById($id);
        $uAid = $data["answer_uid"]; // user id pemberi jawaban
        $uVid = $data["user_id"]; // user id pemberi vote
        $userAnswerPoint = UserModel::get_user($uAid); // mencari poin pemberi jawaban
        $userVotePoint = UserModel::get_user($uVid); // mencari poin pemberi vote
        $aPoin = $userAnswerPoint->point;  //poin pemberi jawaban
        $vPoin = $userVotePoint->point;  //poin pemberi vote

        if (VoteModel::answerVote($id, $uVid)){ //if there is no vote

            if(($data['downvote'] == 1) && ($vPoin <= 15)){
                return "Anda tidak dapat melakukan downvote karna poin anda dibawah 15";
            }
            else {
                unset($data["_token"]);
                unset($data["_method"]);
                unset($data["answer_uid"]);
                //dd($data);
                $data2 = $data;
                $data2 = array_merge($data2, array("answer_id" => $id));
                unset($data2["question_id"]);
                //dd($data2);
                $vote = VoteModel::saveAnswerVote($data2);

                $addpoin = $aPoin + 10;
                $delpoin = $aPoin - 1;
                if($data['upvote'] == 1) {
                    $updt = UserModel::updatePoint($addpoin, $uAid);
                }
                else if ($data['downvote'] == 1) {
                    $updt = UserModel::updatePoint($delpoin, $uAid);
                }
                $totalUpvote = array("upvote_total" => VoteModel::upvoteAnswerTotal($id));
                $totalDownvote = array("downvote_total" => VoteModel::downvoteAnswerTotal($id));
                $data = array_merge($data, $totalUpvote, $totalDownvote);
                //dd($data);
                $updt = JawabanModel::updateVote($data, $id);
                $idq = $data["question_id"];
                $link = "/pertanyaan/" . $idq;
                return Redirect::to($link); //redirect to detail question
            }
        }
        else {
            return "Anda sudah memberikan vote";
        }

    }
}
