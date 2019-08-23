<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Tools\Wechat;
use GuzzleHttp\Client;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class WechatController extends Controller
{
    public $request;
    public $wechat;
    public function __construct(Request $request,Wechat $wechat)
    {
        $this->request = $request;
        $this->wechat = $wechat;
    }

     /**
     * 微信消息推送
     */
    public function event()
    {
        //$this->checkSignature();
        $data = file_get_contents("php://input");
        //解析XML
        $xml = simplexml_load_string($data,'SimpleXMLElement', LIBXML_NOCDATA);        //将 xml字符串 转换成对象
        $xml = (array)$xml; //转化成数组
        //echo "<pre>";print_r($xml);
        \Log::Info(json_encode($xml));  //输出收到的信息
        $log_str = date('Y-m-d H:i:s') . "\n" . $data . "\n<<<<<<<";
        file_put_contents(storage_path('logs/wx_event.log'),$log_str,FILE_APPEND);
        if($xml['MsgType'] == 'event'){
            if($xml['Event'] == 'subscribe'){ //关注
                if(!empty($xml['EventKey'])){
                    //拉新操作
                    $agent_code = explode('_',$xml['EventKey'])[1];
                    $agent_info = DB::connection('mysql_cart')->table('user_agent')->where(['uid'=>$agent_code,'openid'=>$xml['FromUserName']])->first();
                    if(empty($agent_info)){
                        DB::connection('mysql_cart')->table('user_agent')->insert([
                            'uid'=>$agent_code,
                            'openid'=>$xml['FromUserName'],
                            'add_time'=>time()
                        ]);
                    }
                }
                $message = '你好!';
                $xml_str = '<xml><ToUserName><![CDATA['.$xml['FromUserName'].']]></ToUserName><FromUserName><![CDATA['.$xml['ToUserName'].']]></FromUserName><CreateTime>'.time().'</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA['.$message.']]></Content></xml>';
                echo $xml_str;
            }elseif($xml['Event'] == 'location_select'){
                $message = $xml['SendLocationInfo']->Label;
                \Log::Info($message);
                $xml_str = '<xml><ToUserName><![CDATA[otAUQ1UtX-nKATwQMq5euKLME2fg]]></ToUserName><FromUserName><![CDATA['.$xml['ToUserName'].']]></FromUserName><CreateTime>'.time().'</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA['.$message.']]></Content></xml>';
                echo $xml_str;
            }elseif($xml['Event'] == 'CLICK'){
                $message = '你好!';
                $xml_str = '<xml><ToUserName><![CDATA['.$xml['FromUserName'].']]></ToUserName><FromUserName><![CDATA['.$xml['ToUserName'].']]></FromUserName><CreateTime>'.time().'</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA['.$message.']]></Content></xml>';
                echo $xml_str;
            }
        }elseif($xml['MsgType'] == 'text'){
            $message = '你好!';
            $xml_str = '<xml><ToUserName><![CDATA['.$xml['FromUserName'].']]></ToUserName><FromUserName><![CDATA['.$xml['ToUserName'].']]></FromUserName><CreateTime>'.time().'</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA['.$message.']]></Content></xml>';
            echo $xml_str;
        }
        //echo $_GET['echostr'];  //第一次访问
    }
    /**
     * 粉丝详情
     */
    public function get_user_info(Request $request)
    {
        $openid = DB::connection('mysql_myshop')->table('wechat_openid')->where(['id'=>$this->request->all()['id']])->value('openid');;
        $user_info = $this->wechat->wechat_user_info($openid);
        dd($user_info);
// ----------------------------------------------------------------
        // 添加粉丝公众号
        // // 获取access_token
        // $access_token = $this->get_access_token();
        // // dd($access_token);
        // // 粉丝微信号
        // $openid = 'ofv_zwY5a70IhWLR9zqkzM7_Ih60';
        // // dd($openid);
        // // 获取粉丝详细信息
        // $wechat_user = file_get_contents("https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$access_token."&openid=".$openid."&lang=zh_CN");
        // // dd($wechat_user);
        // // 将粉丝信息转为数组
        // $user_info = json_decode($wechat_user,1);
        // // dd($user_info);
        // $info = DB::connection("mysql_myshop")->table('wechat_openid')->insert([
        //     'openid' => $user_info['openid'],
        //     'subscribe' => $user_info['subscribe'],
        //     'add_time' => time(),
        // ]);
        // if($info){
        //     dd('添加公众号粉丝成功');
        // }else{
        //     dd('添加公众号粉丝失败');
        // }
    }
    /**
     * 执行表单提交获取的粉丝
     */
    public function get_user_list()
    {
        $access_token = $this->get_access_token();
        // dd($access_token);
        // 拉取关注用户列表
        $wechat_user = file_get_contents("https://api.weixin.qq.com/cgi-bin/user/get?access_token={$access_token}&next_openid=");
        // dd($wechat_user);
        // 获取所有粉丝微信号
        $user_info = json_decode($wechat_user,1);
        // dd($user_info);
        //循环第一个粉丝号
        foreach($user_info['data']['openid'] as $v){
            // dd($v);
            // 添加入库
            $subscribe = DB::connection('mysql_myshop')->table('wechat_openid')->where(['openid'=>$v])->value('subscribe');
            // dd($subscribe);
            if(empty($subscribe)){
                //获取用户详情信息
                $user = $this->wechat_user_info($v);
                dd($user);

                // $access_token = $this->get_access_token();
                // $openid = $v;
                // $wechat_user = file_get_contents("https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$access_token."&openid=".$openid."&lang=zh_CN");
                // $user = json_decode($wechat_user,1);

                DB::connection('mysql_myshop')->table('wechat_openid')->insert([
                    'openid' => $v,
                    'add_time' => time(),
                    'subscribe' => $user['subscribe']
                ]);
            }else{
                //获取用户详情信息
                $access_token = $this->get_access_token();
                $openid = $v;
                $wechat_user = file_get_contents("https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$access_token."&openid=".$openid."&lang=zh_CN");
                $user = json_decode($wechat_user,1);
                if($subscribe != $user['subscribe']){
                    DB::connection('mysql_myshop')->table('wechat_openid')->where(['openid'=>$v])->update([
                        'subscribe' => $user['subscribe'],
                    ]);
                }
            }
        }
        echo "<script>history.go(-1)</script>";
    }

    /**
     * 调用的方法
     * 别的方法可以$this->wechat_user_info拿到里面的数据
     */
    public function wechat_user_info($openid)
    {
        $access_token = $this->wechat->get_access_token();
        // dd($access_token);
        $wechat_user = file_get_contents("https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$access_token."&openid=".$openid."&lang=zh_CN");
        $user_info = json_decode($wechat_user,1);
        return $user_info;
    }
    /**
     * 调用的方法
     * 获取access_token的方法，别的方法可以调用它
     */
    public function get_access_token()
    {
        // 获取access_token
        // $access_token = "";
        $redis = new \Redis();
        $redis->connect('127.0.0.1','6379');
        $access_token_key = 'wechat_access_token';
        if($redis->exists($access_token_key)){
            // 去缓存拿
            $access_token = $redis->get($access_token_key);
        }else{
            // 去微信接口拿
            $access_re = file_get_contents("https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".env('WECHAT_APPID')."&secret=".env('WECHAT_APPSECRET'));
            $access_result = json_decode($access_re,1);
            $access_token = $access_result['access_token'];
            $expire_time = $access_result['expires_in'];
            // 加入缓存
            $redis->set($access_token_key,$access_token,$expire_time);
        }
        return $access_token;
    }
    /**
     * 粉丝列表
     */
    public function user_list(Request $request)
    {
        $tag_id = !empty($request->all()['tag_id'])?$request->all()['tag_id']:'';
        // dd($tag_id);
        $openid_info = DB::connection('mysql_myshop')->table('wechat_openid')->get();
        // dd($openid_info);
        return view('wechat/user_list',['openid_info'=>$openid_info,'tag_id'=>$tag_id]);
    }
    /**
     * 登录执行之后执行code方法
     */
    public function login(){
        $redirect_uri = 'http://www.blog.com/wechat/code';
        $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.env('WECHAT_APPID').'&redirect_uri='.urlencode($redirect_uri).'&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect ';
        header('Location:'.$url);
    }
    /**
     * code执行注册登录
     * 通过code获得access_token
     * @param Request $request
     */
    public function code(Request $request){
        $req = $request->all();
        $code = $req['code'];
        //获取access_token
        $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=".env("WECHAT_APPID")."&secret=".env("WECHAT_APPSECRET")."&code=".$code."&grant_type=authorization_code";
        $re = file_get_contents($url);
        $result = json_decode($re,1);
        $access_token = $result['access_token'];
        $openid = $result['openid'];
        //获取用户基本信息
        $wechat_user_info = $this->wechat->wechat_user_info($openid);
        //去user_openid 表查 是否有数据 openid
        $user_openid = DB::connection('mysql_myshop')->table("user_wechat")->where(['openid'=>$openid])->first();
        if(!empty($user_openid)){
            //有数据 在网站有用户 user表有数据[ 登陆 ]
            $user_info = DB::connection('mysql_myshop')->table("user")->where(['id'=>$user_openid->uid])->first();
            $request->session()->put('username','name');
            //推送模板消息 [告诉用户你在我门的网站登录了]
            header('Location:template_list');
            // dd('登录成功');
        }else{
            //没有数据 注册信息  insert user  user_openid   生成新用户
            DB::connection("mysql_myshop")->beginTransaction();
            $user_result = DB::connection('mysql_myshop')->table('user')->insertGetId([
                'password' => '',
                'name' => $wechat_user_info['nickname'],
                'reg_time' => time()
            ]);
            $openid_result = DB::connection('mysql_myshop')->table('user_wechat')->insert([
                'uid'=>$user_result,
                'openid' => $openid,
            ]);
            DB::connection('mysql_myshop')->commit();
            //登陆操作
            $user_info = DB::connection('mysql_myshop')->table("user")->where(['id'=>$user_openid->uid])->first();
            $request->session()->put('username','name');
            //你在我们的网站登录了
            header('Location:template_list');
            // dd('注册并登录成功');
        }
    }

    /**
     * 模板列表
     */
    public function template_list()
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/template/get_all_private_template?access_token='.$this->wechat->get_access_token();
        $re = file_get_contents($url);
        dd(json_decode($re,1));
    }
    /**
     * 模板删除
     */
    public function del_template()
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/template/del_private_template?access_token='.$this->wechat->get_access_token();
        $data = [
            "template_id" => "CtKCPZJD94XeBznu94UK5MTXjotmbCerjFfMxgH2p-E"
        ];
        $re = $this->wechat->post($url,json_encode($data));
        // dd($re);
        if($re){
            dd('删除模块成功');
        }else{
            dd('删除模块失败');
        }
    }
    /**
     * 推送模板消息
     * 注意：访问此链接会给每个关注测试公众号发送模块
     */
    public function push_template()
    {
        $openid_info = DB::connection('mysql_myshop')->table("wechat_openid")->select('openid')->limit(10)->get()->toArray();
        foreach($openid_info as $v){
            $this->wechat->push_template($v->openid);
        }
    }
    
    /**
     * 我的素材
     * 上传图片，语音，视频，缩略图
     */
    public function upload_source()
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/material/batchget_material?access_token='.$this->wechat->get_access_token();
        // dd($url);
        $data = ['type'=>'image','offset'=>0,'count'=>20];
        // dd($data);
        $re = $this->wechat->post($url,json_encode($data));
        // dd($re);
        // echo '<pre>';
        // print_r(json_decode($re,1));
        return view('wechat/uploadSource');
    }
    /**
     * 音频资源
     */
    public function get_voice_source()
    {
        $media_id = 'UKml31rzRRlr8lYfWgAno9mGe-meph0BKmVtZugAHQTqZIxOhUoBvCnqfJMRMKTG';
        // dd($media_id);
        $url = 'https://api.weixin.qq.com/cgi-bin/media/get?access_token='.$this->wechat->get_access_token().'&media_id='.$media_id;
        // dd($url);
        //保存图片
        $client = new Client();
        $response = $client->get($url);
        //$h = $response->getHeaders();
        //echo '<pre>';print_r($h);echo '</pre>';die;
        //获取文件名
        $file_info = $response->getHeader('Content-disposition');
        $file_name = substr(rtrim($file_info[0],'"'),-20);
        //$wx_image_path = 'wx/images/'.$file_name;
        //保存图片
        $path = 'wechat/voice/'.$file_name;
        $re = Storage::put($path, $response->getBody());
        echo env('APP_URL').'/storage/'.$path;
        dd($re);
    }
    /**
     * 视频资源
     */
    public function get_video_source(){
        $media_id = 'f9-GxYnNAinpu3qY4oFadJaodRVvB6JybJOhdjdbh7Z0CR0bm8nO4uh8bqSaiS_d'; //视频
        $url = 'http://api.weixin.qq.com/cgi-bin/media/get?access_token='.$this->wechat->get_access_token().'&media_id='.$media_id;
        $client = new Client();
        $response = $client->get($url);
        $video_url = json_decode($response->getBody(),1)['video_url'];
        $file_name = explode('/',parse_url($video_url)['path'])[2];
        //设置超时参数
        $opts=array(
            "http"=>array(
                "method"=>"GET",
                "timeout"=>3  //单位秒
            ),
        );
        //创建数据流上下文
        $context = stream_context_create($opts);
        //$url请求的地址，例如：
        $read = file_get_contents($video_url,false, $context);
        $re = file_put_contents('./storage/wechat/video/'.$file_name,$read);
        var_dump($re);
        die();
    }
    /**
     * 图片
     */
    public function get_source()
    {
        $media_id = 'pREe_hxV86zjyFsmSlMNnewpYTFf5x6NuckIDkOTLgcF58FhejU-DNDucyme6x_n'; //图片
        $url = 'https://api.weixin.qq.com/cgi-bin/media/get?access_token='.$this->wechat->get_access_token().'&media_id='.$media_id;
        //echo $url;echo '</br>';
        //保存图片
        $client = new Client();
        $response = $client->get($url);
        //$h = $response->getHeaders();
        //echo '<pre>';print_r($h);echo '</pre>';die;
        //获取文件名
        $file_info = $response->getHeader('Content-disposition');
        $file_name = substr(rtrim($file_info[0],'"'),-20);
        //$wx_image_path = 'wx/images/'.$file_name;
        //保存图片
        $path = 'wechat/image/'.$file_name;
        $re = Storage::disk('local')->put($path, $response->getBody());
        echo env('APP_URL').'/storage/'.$path;
        dd($re);
        //return $file_name;
    }
    /**
     * 上传资源
     * 执行资源表单提交
     * @param Request $request
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function do_upload(Request $request)
    {
        $upload_type = $request['up_type'];
        $re = '';
        if($request->hasFile('image')){
            //图片类型
            $re = $this->wechat->upload_source($upload_type,'image');
        }elseif($request->hasFile('voice')){
            //音频类型
            //保存文件
            $re = $this->wechat->upload_source($upload_type,'voice');
        }elseif($request->hasFile('video')){
            //视频
            //保存文件
            $re = $this->wechat->upload_source($upload_type,'video','视频标题','视频描述');
        }elseif($request->hasFile('thumb')){
            //缩略图
            $path = $request->file('thumb')->store('wechat/thumb');
        }
        echo $re;
        dd();
    }

    /**
     * 添加标签
     */
    public function add_tag()
    {
        return view('wechat/add_tag');
    }
    /**
     * 执行添加标签
     */
    public function do_add_tag(Request $request)
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/tags/create?access_token='.$this->wechat->get_access_token();
        $data = [
            'tag' => ['name'=>$request->all()['name']]
        ];
        $re = $this->wechat->post($url,json_encode($data,JSON_UNESCAPED_UNICODE));
        dd(json_decode($re,1));
    }
    /**
     * 标签下的粉丝列表
     */
    public function tag_user(Request $request)
    {
        $re = $this->wechat->tag_user($request->all()['id']);
        dd($re);
    }
    /**
     * 标签列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tag_list(){
        $tag_info = $this->wechat->wechat_tag_list();
        return view('Wechat/tag_list',['info'=>$tag_info['tags']]);
    }
    /**
     * 批量给用户打标签
     */
    public function add_user_tag(Request $request)
    {
        $openid_info = DB::connection('mysql_myshop')->table('wechat_openid')->whereIn('id',$request->all()['id_list'])->select(['openid'])->get()->toArray();
        $openid_list = [];
        foreach($openid_info as $v){
            $openid_list[] = $v->openid;
        }
        $url = 'https://api.weixin.qq.com/cgi-bin/tags/members/batchtagging?access_token='.$this->wechat->get_access_token();
        $data = [
            'openid_list'=>$openid_list,
            'tagid'=>$request->all()['tagid'],
        ];
        $re = $this->wechat->post($url,json_encode($data));
        dd(json_decode($re,1));
    }
    /**
     * 删除标签
     * @param Request $request
     */
    public function del_tag(Request $request){
        $url = 'https://api.weixin.qq.com/cgi-bin/tags/delete?access_token='.$this->wechat->get_access_token();
        $data = [
            'tag' => ['id' => $request->all()['id']]
        ];
        $re = $this->wechat->post($url,json_encode($data));
        $result = json_decode($re,1);
        dd($result);
    }
    /**
     * 获取用户标签
     */
    public function get_user_tag(Request $request){
        $url = 'https://api.weixin.qq.com/cgi-bin/tags/getidlist?access_token='.$this->wechat->get_access_token();
        $data = ['openid'=>$request->all()['openid']];
        $re = $this->wechat->post($url,json_encode($data));
        $user_tag_info = json_decode($re,1);
        $tag_info = $this->wechat->wechat_tag_list();
        $tag_arr = $tag_info['tags'];
        foreach($tag_arr as $v){
            foreach($user_tag_info['tagid_list'] as $vo){
                if($vo == $v['id']){
                    echo $v['name']."<a href='".env('APP_URL').'/wechat/del_user_tag'.'?tag_id='.$v['id'].'&openid='.$request->all()['openid']."'>删除</a><br/>";
                }
            }
        }
    }
    /**
     * 为用户删除标签
     * @param Request $request
     */
    public function del_user_tag(Request $request)
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/tags/members/batchuntagging?access_token='.$this->wechat->get_access_token();
        if(!is_array($request->all()['openid'])){
            $openid_list = [
                $request->all()['openid']
            ];
        }else{
            $openid_list = $request->all()['openid'];
        }
        $data = [
            'openid_list' => $openid_list,
            'tagid' => $request->all()['tag_id']
        ];
        $re = $this->wechat->post($url,json_encode($data));
        dd(json_decode($re,1));
    }
    /**
     * 根据标签为用户推送消息
     */
    public function push_tag_message(Request $request)
    {
        $re = $this->wechat->tag_user($request->all()['tag_id']);
        return view('Wechat.pushTagMessage',['openid'=>json_encode($re['data']['openid']),'tag_id'=>$request->all()['tag_id']]);
    }
    /**
     * 执行根据标签为用户推送消息
     * @param Request $request
     */
    public function do_push_tag_message(Request $request)
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/message/mass/sendall?access_token='.$this->wechat->get_access_token();
        $push_type = $request->all()['push_type'];
        if($push_type == 1){
            //文本消息
            $data = [
                'filter' => ['is_to_all'=>false,'tag_id'=>$request->all()['tag_id']],
                'text' => ['content' => $request->all()['message']],
                'msgtype' => 'text'
            ];
        }elseif($push_type == 2){
            //素材消息 图
            $data = [
                'filter' => ['is_to_all'=>false,'tag_id'=>$request->all()['tag_id']],
                'image' => ['media_id' => $request->all()['media_id']],
                'msgtype' => 'image'
            ];
        }
        $re = $this->wechat->post($url,json_encode($data,JSON_UNESCAPED_UNICODE));
        dd(json_decode($re,1));
    }
    /**
     * 修改标签
     */
    public function update_tag(Request $request)
    {
        return view('Wechat.updateTag',['tag_id'=>$request->all()['tag_id'],'tag_name'=>$request->all()['tag_name']]);
    }
    /**
     * 执行修改标签
     * @param Request $request
     */
    public function do_update_tag(Request $request)
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/tags/update?access_token='.$this->wechat->get_access_token();
        $data = [
            'tag' => [
                'id' => $request->all()['tag_id'],
                'name' => $request->all()['name']
            ]
        ];
        $re = $this->wechat->post($url,json_encode($data,JSON_UNESCAPED_UNICODE));
        dd(json_decode($re,1));
    }
}