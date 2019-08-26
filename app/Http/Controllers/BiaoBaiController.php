<?php

namespace App\Http\Controllers;

use App\Http\Tools\Wechat;
use Illuminate\Http\Request;
use EasyWeChat\Kernel\Messages\Text;
use DB;

class BiaoBaiController extends Controller
{
    public $wechat;
    public function __construct(Wechat $wechat)
    {
        $this->wechat = $wechat;
    }

    public function send(Request $request)
    {
        return view('BiaoBai.send',['openid'=>$request->all()['openid']]);
    }

    public function index(Request $request)
    {
        $uid = $request->session()->get('uid');
        echo $uid.'<br/>';
        $openid_list = $this->wechat->app->user->list($nextOpenId = null);

        return view('BiaoBai.index',['info'=>$openid_list['data']['openid']]);
    }



}
