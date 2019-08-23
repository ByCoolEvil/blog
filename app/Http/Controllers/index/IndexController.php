<?php

namespace App\Http\Controllers\index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class indexController extends Controller
{
    //商品首页
    public function index(Request $request)
    {
        $pagesize=config('app.pageSize');
        $data = DB::table('goodsa')->paginate($pagesize);
        foreach ($data as $k => $v){
            $data[$k]->goods_mid_pic = ltrim($v->goods_mid_pic, '|');
            $data[$k]->goods_big_pic = ltrim($v->goods_big_pic, '|');
        }
        $session = $request->session()->put('name','id');
        // $session=$request->session()->get('user');
        
        return view('index',compact('data','session'));
    }
    
    //添加购物车
    public function cartadd(Request $request)
    {
        $session=request()->session()->get('name');
        // dd($session);
        if ($session==null){
            return redirect('/index/login');die;
        }
        $data=request()->input();
        // dd($data);die;
        $data['user_id']=$session;
         // dd($data);die;
        $where=[
            'goods_id'=>$data['goods_id'],
            'user_id'=>$data['user_id']
        ];
        // dd($where);
        $count=DB::table('cart')->where($where)->count();
        if ($count>0){
            echo "<script>window.location.href='/index/cart',alert('购物车里已经存在 ')</script>";
        }else{
            $res=DB::table('cart')->insert($data);
            // dd($res);
            if ($res){
                echo "<script>window.location.href='/index/cart',alert('添加购物车成功')</script>";
            }else{
                echo "<script>window.location.href='/index/index',alert('添加购物车失败')</script>";
            }
        }
    }

    //购物车列表
    public function cart(Request $request)
    {
      $data=DB::table('cart')
            ->join('goodsa','cart.goods_id','=','goodsa.goods_id')
            ->where('is_del',1)
            ->get();
            // dd($data);
        foreach ($data as $k => $v){

            $data[$k]->goods_mid_pic = ltrim($v->goods_mid_pic, '|');
            $data[$k]->goods_big_pic = ltrim($v->goods_big_pic, '|');
            $data[$k]->newprice=$v->goods_selfprice*$v->cart_shuliang;
        }
      // dd($data);
      return view('index/cart',['data'=>$data]);
    }

    //删除购物车单条数据
    public function cartDel(Request $request)
    {
        $id=request()->id;
        // dd($id);
        $where = [
            'cart_id'=> $id
        ];
        // 用in 是因为单删
        $info = [
            'is_del'=>2
        ];
        $res = DB::table('cart')->where($where)->update($info);
        // dd($res);
        if ($res){
            return ['font'=>'删除成功','code'=>6];die;
        }else{
            return ['font'=>'删除失败','code'=>5];die;
        }
    }

    //更改购买数量
    public function changeBuyNmber(Request $request)
    {
        $id=request()->cart_id;
        $num=request()->goods_num;
        $data=[
            'cart_shuliang'=>$num
        ];
        DB::table('cart')->where('cart_id',$id)->update($data);
    }

    //获取小计
    public function getSubTotal(Request $request)
    {
        $num=request()->goods_num;
        $price=request()->price;
        return $newprice=$num*$price;

    }

    //购买件数得到的价格
    public function newprice(Request $request)
    {
        $id=request()->id;
        $num=request()->kucun;
        $data=DB::table('goodsa')->where('goods_id',$id)->get();
        $price=$data[0]->goods_selfprice;
        $newprice=$num*$price;
        return $newprice;
    }

    //支付页面
    public function checkout(Request $request)
    {
        $session=request()->session()->get('name');
        if ($session==null) {
            return redirect('/index/login')->with('status', '请登录');
        }
        $id=request()->cart_id;
        $cart_id=explode(',',$id);
        $data=DB::table('cart')
            ->whereIn('cart_id',$cart_id)
            ->join('goodsa','cart.goods_id','=','goodsa.goods_id')
            ->get();
        $price=0;
        foreach ($data as $k => $v){
            $data[$k]->goods_big_pic = ltrim($v->goods_big_pic, '|');
            $data[$k]->zongjia=$data[$k]->goods_selfprice*$data[$k]->cart_shuliang;
            $price+=$data[$k]->zongjia;
        }
        $address=DB::table('address')
            ->where('user_id',$session)
            ->orderBy('is_default')
            ->get();
        return view('index/checkout',compact('data','address','price'));
    }


}