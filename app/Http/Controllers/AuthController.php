<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index(){
        if(Session::has('id')){
            return view('master');
        } else{
            return view('master');
        }
    }
    public function login(Request $request){
        $email = $request->input('email');
        $password = $request->input('password');

        $auth = Auth::attempt(['email' => $email, 'password' => $password]);
        if($auth){
            $user = User::where('email', $email)->first();

            //MAKE SESSION
            session(['name' => $user->name]);
            session(['id' => $user->user_id]);
            return redirect('/');
        }
    }
    public function store(Request $request){
        $email = $request->input('email');
        $name = $request->input('name');
        $password = $request->input('password');

        $alreadyEmail = User::where('email', $email)->first();

        // dd($alreadyEmail);
        if(!$alreadyEmail){
            User::create([
                'email' => $email,
                'name' => $name,
                'point' => 0,
                'password' => bcrypt($password)
            ]);
            return "success";
        } else {
            return "email already registered";
        }
    }

    public function logout(Request $request)
	{
		Auth::logout();
		$request->session()->regenerate();
		$request->session()->flush();
		return redirect('/');
	}
}
