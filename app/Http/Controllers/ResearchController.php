<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ResearchController extends Controller
{
    //登录
    public function research(Request $request)
    {
        return view('research/research');
    }
    //登录执行
    public function do_research(Request $request)
    {
        $req = $request->all();
        $result = DB::table('research_user')->where(['name'=>$req['name'],'password'=>$req['password']])->first();
        // dd($result);
        if($result){
            return redirect('/research/list');
        }else{
            dd('账号或密码错误');
        }
    }
    //添加调研
    public function res(Request $request)
    {
        return view('research/res');
    }
    //执行调研
    public function do_res(Request $request)
    {
        return view('research/do_res');
    }
    //执行调研
    public function add_do_res(Request $request)
    {
        $req = $request->all();
        // echo "<pre>";print_r($req);
        $result = DB::connection('mysql_myshop')->beginTransaction();
        // $result = true;
        if($req['type'] == 1){
            //单选
            $result1 = DB::connection("mysql_myshop")->table('research_problem')->insertGetId([
                'type_id' => $req['type'],
                'problem' => $req['single'],
                'add_time' => time()
            ]);

            $result2 = DB::connection("mysql_myshop")->table('research_answer')->insert([
                'question_id' => $result1,
                'desc' => $req['single_a'],
                'add_time' => time(),
            ]);

            $result3 = DB::connection("mysql_myshop")->table('research_answer')->insert([
                'question_id' => $result1,
                'desc' => $req['single_b'],
                'add_time' => time(),
            ]);

            $result4 = DB::connection("mysql_myshop")->table('research_answer')->insert([
                'question_id' => $result1,
                'desc' => $req['single_c'],
                'add_time' => time(),
            ]);

            $result5 = DB::connection("mysql_myshop")->table('research_answer')->insert([
                'question_id' => $result1,
                'desc' => $req['single_d'],
                'add_time' => time(),
            ]);
            $result = $result1 && $result2 && $result3 && $result4 && $result5;

        }else if($req['type'] == 2){
            //多选
            $result1 = DB::connection("mysql_myshop")->table('research_problem')->insertGetId([
                'type_id' => $req['type'],
                'problem' => $req['box'],
                'add_time' => time(),
            ]);

            $result2 = DB::connection("mysql_myshop")->table('research_answer')->insert([
                'question_id' => $result1,
                'desc' => $req['box_a'],
                'add_time' => time(),
            ]);

            $result3 = DB::connection("mysql_myshop")->table('research_answer')->insert([
                'question_id' => $result1,
                'desc' => $req['box_b'],
                'add_time' => time(),
            ]);

            $result4 = DB::connection("mysql_myshop")->table('research_answer')->insert([
                'question_id' => $result1,
                'desc' => $req['box_c'],
                'add_time' => time(),
            ]);

            $result5 = DB::connection("mysql_myshop")->table('research_answer')->insert([
                'question_id' => $result1,
                'desc' => $req['box_d'],
                'add_time' => time(),
            ]);
            $result = $result1 && $result2 && $result3 && $result4 && $result5;
        }else if($req['type'] == 3){
            $result = DB::connection("mysql_myshop")->table('research_problem')->insertGetId([
                'type_id' => $req['type'],
                'problem' => $req['problem'],
                'add_time' => time(),
            ]);
        }

        if($result){
            DB::connection('mysql_myshop')->commit();
            echo "成功";
        }else{
            DB::connection('mysql_myshop')->rollback();
            echo "失败";
        }
    }
    //调研列表
    public function list(Request $request)
    {
        $req = $request->all();
        $info = DB::table('research_problem')->paginate(5);
        return view('/research/list',['research_problem'=>$info]);
    }
    //调研删除
    public function delete(Request $request)
    {
        $req = $request->all();
        $result = DB::table('research_problem')->where(['id'=>$req['id']])->delete();
        if($result){
            return redirect('research/list');
        }else{
            echo "fail";
        }
    }
    //调研链接
    public function detail(Request $request)
    {
        $info = DB::connection('mysql_myshop')->table('research_test')->get()->toArray();
        return view('research/detail',['info'=>$info]);
    }
    //生成链接
    public function test_detail(Request $request)
    {
        $req = $request->all();
        $info = DB::connection('mysql_myshop')->table('research_test')->get()->toArray();
        return view('/research/test_detail',['info'=>$info]);
    }
}