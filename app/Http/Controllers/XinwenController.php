<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use DB;

class XinwenController extends Controller
{
    public function user()
    {
        return view('xinwen/user');
    }

    public function do_user(Request $request)
    {
        $req = $request->all();
        $result = DB::table('xinuser')->where(['name'=>$req['name'],'password'=>$req['password']])->first();
        if($result){
            return redirect('xinwen/list');
        }else{
            dd('账号或密码错误');
        }
    }

    public function add()
    {
        return view('xinwen/add');
    }

    public function do_add(Request $request)
    {
        $files = $request->file('xin_pic');
        $path = '';
        if(empty($files)){
            echo '上传失败';
        }else{
            // 已传图片
            $path = $files->store('xinwen');
        }
        // dd($path);
        echo 'storage'.'/'.$path;
        
        
        $req = $request->all();
        // dd($req);
        $result = DB::table('xinwen')->insert([
            'name' => $req['name'],
            
            'xiang' => $req['xiang'],
            'zuo' => $req['zuo'],
            'add_time' => time()
        ]);
        // dd($result);
        if($result){
            return redirect('xinwen/list');
        }else{
            echo "fail";
        }
    }

    public function update(Request $request)
    {
        $path = $request->file('xin_pic')->store('xinwen');

        return $path;
    }

    public function list(Request $request)
    {
        $info = DB::table('xinwen')->paginate(3);
        return view('xinwen/list',['xinwen'=>$info]);
    }

    public function delete(Request $request)
    {
        $req = $request->all();
        // dd($req);
        $result = DB::table('xinwen')->where(['id'=>$req['id']])->delete();
        if($result){
            return redirect('xinwen/list');
        }else{
            echo "fail";
        }
    }

    public function xiang(Request $request)
    {
        $redis = new \Redis;
        $redis -> connect('127.0.0.1','6379');
        $redis -> incr('num');
        $num = $redis->get('num');
        echo "访问量:".$num;        

        $info = DB::table('xinwen')->get();
        return view('xinwen/xiang',['xinwen'=>$info]);
    }


}