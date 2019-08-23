<?php

namespace App\Http\Controllers;

use App\Http\Tools\Wechat;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;
use DB;

class AgentController extends Controller
{
    public $wechat;
    public function __construct(Wechat $wechat)
    {
        $this->wechat = $wechat;
    }
    /**
     * 用户列表
     */
    public function user_list()
    {
        $user_info = DB::connection('mysql_myshop')->table('user_code')->get();
        return view('Agent.userList',['user_info'=>$user_info]);
    }
    /**
     * 生成专属二维码
     */
    public function create_qrcode(Request $request)
    {
        //生成带参数的二维码
        $uid = $request->all()['uid']; //用户uid
        //用户uid就是专属推广码
        $url = 'https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token='.$this->wechat->get_access_token();
        $data = [
            'expire_seconds' => 24 * 3600 * 30,
            'action_name' => 'QR_STR_SCENE',
            'action_info' => [
                'scene' => [
                    'scene_str' => $uid
                ]
            ]
        ];
        // dd($data);
        $re = $this->wechat->post($url,json_encode($data));
        $qrcode_result = json_decode($re);
        //二维码存入larvel
        $qr_url = 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='.$qrcode_result->ticket;
        $client = new Client();
        $response = $client->get($qr_url);
        // dd($response);
        //获取文件名
        $h = $response->getHeaders();
        // dd($h);
        //echo '<pre>';
        //获得图片名后缀
        $ext = explode('/',$h['Content-Type'][0])[1];
        // dd($ext);
        $file_name = time().rand(1000,9999).'.'.$ext;
        //$wx_image_path = 'wx/images/'.$file_name;
        //保存图片
        $path = 'qrcode/'.$file_name;
        // dd($path);
        //添加
        $re = Storage::disk('local')->put($path, $response->getBody());
        // dd($re);
        $qrcode_url = env('APP_URL').'/storage/'.$path;
        //存入数据库
        DB::connection('mysql_myshop')->table('user_code')->where(['id'=>$uid])->update([
            'qrcode_url' => $qrcode_url,
            'agent_code' => $uid,
            'reg_time' => time()
        ]);
        //返回二维码链接
        return redirect('agent/user_list');
    }
    /**
     * 用户推广用户列表
     * @param Request $request
     */
    public function agent_list(Request $request)
    {
        $uid = $request->all()['uid']; //用户uid
        dd($uid);
        
        
    }
}