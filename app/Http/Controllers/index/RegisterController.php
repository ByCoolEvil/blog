<?php

namespace App\Http\Controllers\index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class RegisterController extends Controller
{
    public function register()
    {
        return view('register');
    }

    public function do_register(Request $request)
    {
        $req = $request->all();
        $result = DB::table('user')->insert([
            'name' => $req['name'],
            'email' => $req['email'],
            'password' => $req['password'],
            'add_time' => time(),
        ]);
        if($result){
            return redirect('/index/login');
        }else{
            echo 'fail';
        }
    }
}
