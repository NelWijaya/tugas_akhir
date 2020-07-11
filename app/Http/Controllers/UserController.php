<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\UserModel;
use Redirect;

class UserController extends Controller
{
    public function index($id) {
        $data = JawabanModel::get_all($id);
        $question = $data[0];
        $answers = $data[1];
        //dd($pertanyaan);
        return view('index', compact('question', 'answers', 'id')); //view to detail question
    }

    public function store(Request $request){
        
        $data = $request->all();
        unset($data["_token"]);
        //dd($data);
        $ans = UserModel::save($data);
        return Redirect::to("/pertanyaan"); //redirect to detail homepage
        
    }
}

?>