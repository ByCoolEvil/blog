<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        /**
         * MONITOR监控redis
         */
        $redis = new \Redis();
        $redis->connect('127.0.0.1','6379');
        $redis->incr('num');
        $num = $redis->get('num');
        echo "访问次数:".$num;

        $req = $request->all();
        $search = "";
        if(!empty($req['search'])){
            $search = $req['search'];
            $info = DB::table('student')->where('name','like','%'.$req['search'].'%')->paginate(3);
        }else{
            $info = DB::table('student')->paginate(3);
        }
        // laravel用查询构造器查询出来的数据类型是集合,需要转换成数组
        // $info = DB::table('student')->get();
        // toArray() 转换的数组
        // $info = DB::table('student')->get()->toArray();
        // paginate(3) 查询并分页,一页三条数据
        // $info = DB::table('student')->paginate(3);
        // 必须指定页面,如果要把数据传过去需要传过去一个参数,它是一个数组
        return view('studentList',['student'=>$info,'search'=>$search]);
    }

    public function add()
    {
        return view('studentAdd',[]);
    }

    public function do_add(Request $request)
    {
        $validatedData = $request->validate([
            //验证非空
            'name' => 'required',
            'sex' => 'required',
            'age' => 'required',
        ],[
            'name.required' => '姓名必填',
            'sex.required' => '性别必填',
            'age.required' => '年龄必填'
        ]);
        $req = $request->all();
        $result = DB::table('student')->insert([
            'name' => $req['name'],
            'sex' => $req['sex'],
            'age' => $req['age'],
            // 自动时间戳
            'add_time' => time(),
        ]);
        // dd($result);
        if($result){
            return redirect('/student/index');
        }else{
            echo 'fail';
        }

    }
    public function update(Request $request)
    {
        $req = $request->all();
        dd($req);
        // 拿到列表传过来的数据，first()获取表中一行数据
        $info = DB::table('student')->where(['id'=>$req['id']])->first();
        // student_info代替$info,用法:value="{{$student_info->某一个值}}"
        return view('/studentUpdate',['student_info'=>$info]);
    }

    public function do_update(Request $request)
    {
        $req = $request->all();
        $result = DB::table('student')->where(['id'=>$req['id']])->update([
            'name' => $req['name'],
            'sex' => $req['sex'],
            'age' => $req['age'],
        ]);
        if($result){
            return redirect('/student/index');
        }else{
            echo 'fail';
        }
    }

    public function delete(Request $request)
    {
        $req = $request->all();
        $result = DB::table('student')->where(['id'=>$req['id']])->delete();
        if($result){
            return redirect('/student/index');
        }else{
            echo 'fail';
        }
    }

}