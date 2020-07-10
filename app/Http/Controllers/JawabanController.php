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
        //dd($pertanyaan);
        return view('index', compact('question', 'answers', 'id')); //view to detail question
    }

    public function store(Request $request, $id){
        
        $data = $request->all();
        unset($data["_token"]);
        $question_id = array("question_id" => $id);
        $data = array_merge($data, $pertanyaan_id);
        //dd($data);
        $ans = JawabanModel::save($data);
        $link = "/jawaban/" . $id;
        return Redirect::to($link); //redirect to detail question
        
    }

    public function updateVote(Request $request, $id) {
        $data = $request->all();
        $dt = array("updated_at" => Carbon::now('Asia/Jakarta')->toDateTimeString());
        $data = array_merge($data, $dt);

        $answer = JawabanModel::findById($id);
        $userId = $answer["user_id"];
        $user = UserModel::get_user($userId);
        $poin = $user["point"];

        if (VoteModel::answerVote($id)){ //if there is no vote
            if(($data['downvote'] == 1) && ($poin <= 15)){
                return "Anda tidak dapat melakukan downvote karna poin anda dibawah 15";
            } 
            else {
                $vote = VoteModel::saveAnswerVote($request);
                $addpoin = $poin + 10;
                $delpoin = $poin - 1;
                if($data['upvote'] == 1) {
                    $updt = UserModel::updatePoint($addpoin, $userId);
                }
                else if ($data['downvote'] == 1) {
                    $updt = UserModel::updatePoint($delpoin, $userId);
                }
                $totalUpvote = array("upvote_total" => VoteModel::upvoteAnswerTotal($id));
                $totalDownvote = array("downvote_total" => VoteModel::downvoteAnswerTotal($id));
                $data = array_merge($data, $totalUpvote, $totalDownvote);
                $updt = JawabanModel::updateVote($data, $id);
                $link = "/pertanyaan/" . $id;
                return Redirect::to($link); //redirect to detail question
            }
        }
        else {
            return "Anda sudah memberikan vote";
        }

    }
}
