<?php

namespace App\Http\Controllers\index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class LoginController extends Controller
{
    public function login()
    {
        return view('login');
    }
    
    public function do_login(Request $request)
    {
        $req = $request->all();
        $result = DB::table('user')->where(['name'=>$req['name'],'password'=>$req['password'],'email'=>$req['email']])->first();
        if($result){
            return redirect('index/index');
        }else{
            dd('用户名,邮箱或密码错误');
        }
    }

}
