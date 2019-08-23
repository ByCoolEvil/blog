<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Tools\Wechat;
use DB;

class LiuYanController extends Controller
{
    public $wechat;
    public function __construct(Wechat $wechat)
    {
        $this->wechat = $wechat;
    }
    // 登录
    public function wechat_login()
    {
        $redirect_uri = env('APP_URL').'/liuyan/wechat_code';// 接收code[微信客户端帮助用户自动跳转]
        $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.env('WECHAT_APPID').'&redirect_uri='.urlencode($redirect_uri).'&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';
        header('Location:'.$url);
    }
    // 接收code
    public function wechat_code(Request $request)
    {
        $req = $request->all();
        $url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.env('WECHAT_APPID').'&secret='.env('WECHAT_APPSECRET').'&code='.$req['code'].'&grant_type=authorization_code';
        $re = file_get_contents($url);
        $result = json_decode($re,1);
        // dd($result);
        // 登录网站
        $user_wechat = DB::connection('mysql_myshop')->table('user_wechat')->where(['openid'=>$result['openid']])->first();
        // 用户基本信息
        $wechat_info = $this->wechat->wechat_user_info($result['openid']);
        if(!empty($user_wechat)){
            // 已注册，登录
            $request->session()->put('uid',$user_wechat->uid);
        }else{
            // 未注册，注册，登录
            // 开启事务
            DB::connection('mysql_myshop')->beginTransaction();
            $uid = DB::connection('mysql_myshop')->table('user')->insertGetId([
                'name' => $wechat_info['nickname'],
                'password' => '',
                'req_time' => time()
            ]);
            $wechat_insert = DB::connection('mysql_myshop')->table('user_wechat')->insert([
                'uid' => $uid,
                'openid' => $user_wechat['uid']
            ]);
            // 登录
            $request->session()->put('uid',$user_wechat->uid);
        }
    }
    // 网页微信登录
    public function login(Request $request)
    {
        return view('/liuyan/login');
    }
    // 执行微信登录
    public function do_login(Request $request)
    {
        $req = $request->all();
        $request->session()->put('admin','name');
        $request->session()->put('uid',1);
        return redirect('liuyan/index');
    }
    // 列表
    public function index(Request $request)
    {
        $se = $request->session()->all();
        // admin是账号
        if(!empty($se['admin'])){
            //已经登录
            echo "已经登录!";
        }
        $info = DB::connection('mysql_myshop')->table('user_wechat')->get();
        foreach($info as $v){
            $user_info = $this->wechat->wechat_user_info($v->openid);
            $v->nick_name = $user_info['nickname'];
        }
        return view('liuyan/index',['info'=>$info]);
    }
    // 留言
    public function send(Request $request)
    {
        $req = $request->all();
        //发送模板消息
        return view('liuyan/send',['uid'=>$req['uid']]);
    }
    // 执行留言
    public function do_send(Request $request)
    {
        $req = $request->all();
        $openid = DB::connection('mysql_myshop')->table('user_wechat')->where(['uid'=>$req['uid']])->value('openid');
        $url = 'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$this->wechat->get_access_token();
        $data = [
            "touser" => $openid,
            "template_id" => "kYGLFBdoWETajVQ-UpF6LN9nruvu8SH_gPr4-1YDw80",
            "url" => env('APP_URL').'/liuyan/index',
            "data" => [
                "first" =>  [
                   "value" => "留言消息",
                   "color" => ""
                ],
                "keyword1" => [
                   "value" => $this->wechat->wechat_user_info($openid)['nickname'],
                   "color" => ""
                ],
                "keyword2" =>  [
                   "value" => $req['send_info'],
                   "color" => ""
                ],
            ]
        ];
        $re = $this->wechat->post($url,json_encode($data));
        return $re;
    }
    // 删除
    public function do_del(Request $request)
    {
        $req = $request->all();
        dd($req);


    }



}