<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserModel {

    public static function get_user($id) {
        $user = DB::table('users')
            ->where('user_id', '=', $id)
            ->first();

        return $user;
    }

    public static function save($data) {
        $new_item = DB::table('users')->insert($data);
        return $new_item;
    }

    public static function updatePoint($point, $userId){
        //dd($request);
        $point = DB::table('users')
                    ->where('user_id', $userId)
                    ->update([
                        'point'     => $point
                    ]);
        return $point;
    }
}


?>