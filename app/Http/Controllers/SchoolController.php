<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class SchoolController extends Controller
{
    public function add()
    {
        return view('school/add');
    }

    public function do_add(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
        ],[
            'name.required' => '姓名必填',
        ]);
        $req = $request->all();
        $result = DB::table('school')->insert([
            'name' => $req['name'],
            'age' => $req['age'],
            'sex' => $req['sex'],
            'class' => $req['class'],
            'school' => $req['school'],
            'add_time' => time()
        ]);
        // dd($result);
        if($result){
            return redirect('school/list');
        }else{
            echo "fail";
        }
    }

    public function list(Request $request)
    {
        // $se = $request->session()->all();
        // echo "<pre>";print_r($se);
        // if(!empty($se['username'])){
        //    //已经登陆
        //    echo "已经登陆";
        // }
        $redis = new \Redis();
        $redis->connect('127.0.0.1','6379');
        $redis->incr('num');
        $num = $redis->get('num');
        echo "访问次数:".$num;
        
        $req = $request->all();
        $search = "";
        if(!empty($req['search'])){
            $search = $req['search'];
            $info = DB::table('school')->where('name','like','%'.$req['search'].'%')->paginate(3);
        }else{
            $info = DB::table('school')->paginate(3);
        }
        return view('school/list',['school'=>$info,'search'=>$search]);
    }

    public function delete(Request $request)
    {
        // $req = $request->all();
        // $se = $request->session()->all();
        // $liuyan_uid = DB::connection('mysql_myshop')->table('school')->where(['id'=>$req['id']])->select('uid','add_time')->first();
        // //删除一条数据
        // //判断当前用户和要删除数据用户id是否相等
        // if($se['uid'] != $liuyan_uid->uid){
        //     echo "没权限";
        // }
        // //相等判断创建时间
        // if(time() - $liuyan_uid->add_time > 1800){
        //     echo "没权限";
        // }
        // echo "ok";


        $req = $request->all();
        $result = DB::table('school')->where(['id'=>$req['id']])->delete();
        if($result){
            return redirect('school/list');
        }else{
            echo "fail";
        }
    }

    public function update(Request $request)
    {
        $req = $request->all();
        $info = DB::table('school')->where(['id'=>$req['id']])->first();
        return view('school/update',['school_info'=>$info]);
    }

    public function do_update(Request $request)
    {
        $req = $request->all();
        $result = DB::table('school')->where(['id'=>$req['id']])->update([
            'name' => $req['name'],
            'age' => $req['age'],
            'sex' => $req['sex'],
            'class' => $req['class'],
            'school' => $req['school'],
        ]);
        if($result){
            return redirect('school/list');
        }else{
            echo "fail";
        }

    }
}