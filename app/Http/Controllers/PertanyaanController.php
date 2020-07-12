<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\PertanyaanModel;
use App\Models\JawabanModel;
use App\Models\VoteModel;
use App\Models\UserModel;
use Redirect;

class PertanyaanController extends Controller
{
    public function index() {
        $ansqty = [];
        $questions = PertanyaanModel::get_all();
        //dd($questions);
        foreach($questions as $key => $q){
            $idx = $q->question_id;
            $answers = JawabanModel::get_all($idx);
            $qty = count($answers[1]);
            //dd($qty);

            $ansqty = array_merge($ansqty, array($key => $qty));

        }

        //dd($questions);
        return view('pages.index', compact('questions', 'ansqty')); //view semua pertanyaan
    }

    public function create() {
        return view('form');    //form create pertanyaan
    }

    public function store(Request $request) {
        $data = $request->all();
        unset($data["_token"]);
        $uid = array("user_id" => Session('id'));
        $data = array_merge($data, $uid);
        //dd($data);
        $q = PertanyaanModel::save($data);
        return Redirect::to('/pertanyaan');

    }

    public function edit($id) {
        $question = PertanyaanModel::findById($id);
        //dd($pertanyaan);
        return view('formEdit', compact('question')); //view form edit
    }

    public function update(Request $request, $id) {
        $data = $request->all();
        //dd($data);
        $updt = PertanyaanModel::update($data, $id);
        $link = "/pertanyaan/" . $id;
        return Redirect::to($link); //redirect to detail question
    }

    public function updateVote(Request $request, $id) {
        $data = $request->all();
        $question = PertanyaanModel::findById($id);
        $uQid = $data["question_uid"]; // user id pemberi pertanyaan
        $uVid = $data["user_id"]; // user id pemberi vote
        $userQuestionPoint = UserModel::get_user($uQid); // mencari poin pemberi pertanyaan
        $userVotePoint = UserModel::get_user($uVid); // mencari poin pemberi vote
        $qPoin = $userQuestionPoint->point;  //poin pemberi pertanyaan
        $vPoin = $userVotePoint->point;  //poin pemberi vote

        if (VoteModel::questionVote($id, $uVid)){ //if there is no vote

            if(($data['downvote'] == 1) && ($vPoin <= 15)){
                return "Anda tidak dapat melakukan downvote karna poin anda dibawah 15";
            }
            else {
                unset($data["_token"]);
                unset($data["_method"]);
                unset($data["question_uid"]);
                //dd($data);
                $vote = VoteModel::saveQuestionVote($data);
                $addpoin = $qPoin + 10;
                $delpoin = $qPoin - 1;
                if($data['upvote'] == 1) {
                    $updt = UserModel::updatePoint($addpoin, $uQid);
                }
                else if ($data['downvote'] == 1) {
                    $updt = UserModel::updatePoint($delpoin, $uQid);
                }

                $totalUpvote = array("upvote_total" => VoteModel::upvoteQuestionTotal($id));
                $totalDownvote = array("downvote_total" => VoteModel::downvoteQuestionTotal($id));
                $data = array_merge($data, $totalUpvote, $totalDownvote);
                $updt = PertanyaanModel::updateVote($data, $id);
                $link = "/pertanyaan/" . $id;
                return Redirect::to($link); //redirect to detail question
            }
        }
        else {
            return "Anda sudah memberikan vote";
        }

    }

    public function delete($id) {
        $delete = PertanyaanModel::delete($id);
        return redirect('/pertanyaan');
    }
}
