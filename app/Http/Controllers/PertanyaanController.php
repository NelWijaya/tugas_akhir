<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\PertanyaanModel;
use App\Models\VoteModel;
use App\Models\UserModel;
use Redirect;

class PertanyaanController extends Controller
{
    public function index() {
        $questions = PertanyaanModel::get_all();
        //dd($questions);
        return view('pages.index', compact('questions')); //view semua pertanyaan
    }

    public function create() {
        return view('form');    //form create pertanyaan
    }

    public function store(Request $request) {
        $data = $request->all();
        unset($data["_token"]);
        $uid = array("user_id" => 3); //temporary user_id, nanti ganti ke auth::id
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
        $dt = array("updated_at" => Carbon::now('Asia/Jakarta')->toDateTimeString());
        $data = array_merge($data, $dt);
        $updt = PertanyaanModel::update($data, $id);
        $link = "/pertanyaan/" . $id;
        return Redirect::to($link); //redirect to detail question
    }

    public function updateVote(Request $request, $id) {
        $data = $request->all();
        $dt = array("updated_at" => Carbon::now('Asia/Jakarta')->toDateTimeString());
        $data = array_merge($data, $dt);

        $question = PertanyaanModel::findById($id);
        $userId = $question["user_id"];
        $user = UserModel::get_user($userId);
        $poin = $user["point"];

        if (VoteModel::questionVote($id)){ //if there is no vote

            if(($data['downvote'] == 1) && ($poin <= 15)){
                return "Anda tidak dapat melakukan downvote karna poin anda dibawah 15";
            } 
            else {
                $vote = VoteModel::saveQuestionVote($request);
                $addpoin = $poin + 10;
                $delpoin = $poin - 1;
                if($data['upvote'] == 1) {
                    $updt = UserModel::updatePoint($addpoin, $userId);
                }
                else if ($data['downvote'] == 1) {
                    $updt = UserModel::updatePoint($delpoin, $userId);
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
