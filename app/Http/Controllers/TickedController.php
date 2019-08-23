<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class TickedController extends Controller
{
    public function add()
    {
        return view('/ticked/add');
    }

    public function do_add(Request $request)
    {
        $req = $request->all();
        // dd($req);
        $result = DB::table('ticked')->insert([
            'chec' => $req['chec'],
            'set' => $req['set'],
            'arr' => $req['arr'],
            'yingzuo' => $req['yingzuo'],
            'ruanzuo' => $req['ruanzuo'],
            'price' => $req['price'],
            'zha' => $req['zha'],
            'add_time' => time(),
        ]);
        // $result = DB::table('ticked')->insert($req);
        if($result){
            return redirect('/ticked/list');
        }else{
            echo 'fail';
        }
    }

    public function list(Request $request)
    {
        $req = $request->all();
        if(empty($req['arr'])){
            $req['arr'] = '';
        }
        if(empty($req['set'])){
            $req['set'] = '';
        }
        $redis = new \Redis();
        $redis->connect('127.0.0.1','6379');
        if(!$redis->get('ticked_info')){
            // 判断搜索条件是否存在
            if(!empty($req['set']) || !empty($req['arr'])){
                //记录搜索次数
                // echo "记录搜索次数";
                $redis->incr('num');
                $list = DB::connection('mysql_myshop')->table('ticked')
                ->where('set','like',"%{$req['set']}%")
                ->where('arr','like',"%{$req['arr']}%")
                ->get();
            }else{
                // 没有搜索条件返回全部数据
                $list = DB::connection('mysql_myshop')->table('ticked')->get();
            }
            // redis获取访问次数
            $num = $redis->get('num');
            // 判断访问次数
            if($num > 5){
                $redis_info = json_encode($list);
                $redis->set('ticked_info',$redis_info,3 * 60);
            }
            $list = json_decode(json_encode($list),true);
            // print_r($list);
        }else{
            $list = json_decode($redis->get('ticked_info'),true);
        }
        echo "访问次数:".$redis->get('num');
        //echo "<pre>";
        print_r($list);
        
        // dd($info);
        return view('/ticked/list',['set'=>$req['set'],'arr'=>$req['arr'],'list'=>$list]);
    }

    public function delete(Request $request)
    {
        $req = $request->all();
        $result = DB::table('ticked')->where(['id'=>$req['id']])->delete();
        if($result){
            return redirect('/ticked/list');
        }else{
            echo 'fail';
        }
    }

    public function update(Request $request)
    {
        $req = $request->all();
        $info = DB::table('ticked')->where(['id'=>$req['id']])->first();

        return view('ticked/update',['ticked'=>$info]);
    }

    public function do_update(Request $request)
    {
        $req = $request->all();
        $result = DB::table('ticked')->where(['id'=>$req['id']])->update([
            'chec' => $req['chec'],
            'set' => $req['set'],
            'arr' => $req['arr'],
            'yingzuo' => $req['yingzuo'],
            'ruanzuo' => $req['ruanzuo'],
            'price' => $req['price'],
            'zha' => $req['zha'],
        ]);
        if($result){
            return redirect('/ticked/list');
        }else{
            echo 'fail';
        }
    }
}