<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class zhouController extends Controller
{
    public function add_zhou(){
    	return view('zhou/add_zhou');
    }

    public function do_add_zhou(Request $request)
    {
        $data=$request->all();
        $path = $request->file('zhou_img')->store('zhou');
        $zhou_img=asset('storage'.'/'.$path);
        // dd($zhou_img);
        $data['zhou_img']=$zhou_img;
        $data['time']=time();
        unset($data['_token']);
        $res=DB::table('zhou')->insert($data);
        if ($res){
            return redirect('index_zhou');
        }
    }

    public function index_zhou(Request $request){
    	$redis = new \Redis();
    	$redis->connect('127.0.0.1','6379');

    	$redis->incr('num');
    	$num=$redis->get('num');
    	echo $num."<br />";

        $info=DB::table('zhou')->get();
    	return view('zhou/index_zhou',['info'=>$info]);
    }

    public function del_zhou(Request $request){
    	$id = $request->all();
    	$data = DB::table('zhou')->where(['id'=>$id])->delete();
    	if($data){
    		return redirect('/index_zhou');
    	}
    }

    public function update_zhou(Request $request){
    	$req=$request->all();
    	$stu = DB::table('zhou')->where(['id'=>$req['id']])->first();
    	return view('zhou/update_zhou',['stu'=>$stu]);
    }

    public function do_update_zhou(Request $request){
    	$req = $request->all();
        // dd($req);
        if(isset($req['zhou_img'])){
            $path=$request->file('zhou_img')->store('zhou');
            $zhou_img=asset('storage'.'/'.$path);
            $req['zhou_img']=$zhou_img;
        }
        $dada['time']=time();
        unset($req['_token']);
        $res=DB::table('zhou')->where('id',$req['id'])->update($dada);

        if(!empty($result)){
          return redirect('/index_zhou');
        }
    }

}