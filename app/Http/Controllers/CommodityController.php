<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class CommodityController extends Controller
{
    public function add()
    {
        return view('commodity/add');
    }

    public function do_add(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'pic' => 'required',
            'kc' => 'required'
        ],[
            'name.required' => '商品名称必填',
            'pic.required' => '商品图片必填',
            'kc.required' => '商品库存必填'
        ]);
        $req = $request->all();
        // dd($req);
        $result = DB::table('commodity')->insert([
            'name' => $req['name'],
            'pic' => $req['pic'],
            'kc' => $req['kc'],
            'add_time' => time()
        ]);
        if($result){
            return redirect('/commodity/list');
        }else{
            echo 'fail';
        }
    }

    public function list(Request $request)
    {
        $req = $request->all();
        $search = "";
        if(!empty($req['search'])){
            $search = $req['search'];
            $info = DB::table('commodity')->where('name','like','%'.$req['search'].'%')->paginate(3);
        }else{
            $info = DB::table('commodity')->paginate(3);
        }
        
        return view('commodity/list',['commodity'=>$info,'search'=>$search]);
    }

    public function delete(Request $request)
    {
        $req = $request->all();
        $result = DB::table('commodity')->where(['id'=>$req['id']])->delete();
        if($result){
            return redirect('/commodity/list');
        }else{
            echo 'fail';
        }
    }

    public function update(Request $request)
    {
        $req = $request->all();
        $info = DB::table('commodity')->where(['id'=>$req['id']])->first();
        return view('/commodity/update',['commodity_info'=>$info]);
    }

    public function do_update(Request $request)
    {
        $req = $request->all();
        $result = DB::table('commodity')->where(['id'=>$req['id']])->update([
            'name' => $req['name'],
            'kc' => $req['kc'],
        ]);
        if($result){
            return redirect('/commodity/list');
        }else{
            echo 'fail';
        }
    }
}