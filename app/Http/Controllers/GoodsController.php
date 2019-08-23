<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class GoodsController extends Controller
{
    public function add()
    {
        // 存储资源的绝对路径
        // dd(storage_path('app\public'));
        return view('goods/add');
    }

    public function do_add(Request $request)
    {
        // $req = $request->all();
        // $result = DB::table('goods')->insert([
        //     'goods_name' => $req['goods_name'],
        //     'goods_pic' => $req['goods_pic'],
        //     'goods_price' => $req['goods_price'],
        //     'add_time' => time()
        // ]);
        // if($result){
        //     // return redirect('');
        //     echo '上传成功';
        // }else{
        //     echo 'fail';
        // }

        // dd($_FILES);
        // 图片路径,在public——storage——goods下面
        // $path = $request->file('goods_pic')->store('goods');
        // echo asset('storage').'/'.$path;
        // dd($path);
        $files = $request->file('goods_pic');
        $path = '';
        if(empty($files)){
            // 未传图片
            echo 'fail';
        }else{
            // 已传图片
            $path = $files->store('goods');
        }
        dd($path);
        echo 'storage'.'/'.$path;  
    }
}