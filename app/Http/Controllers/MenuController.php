<?php
namespace App\Http\Controllers;
use App\Http\Tools\Wechat;
use Illuminate\Http\Request;
use DB;
class MenuController extends Controller
{
    public $wechat;
    public function __construct(Wechat $wechat)
    {
        $this->wechat = $wechat;
    }
    /**
     * 菜单添加
     */
    public function menu_add()
    {
        return view('menu/menu_add');
    }
    /**
     * 执行菜单添加
     */
    public function do_add_menu(Request $request)
    {
        $req = $request->all();
        // dd($req);
        // 加入之后变成二维数组
        $data = [];
        $result = DB::connection('mysql_myshop')->table('menu')->insert([
            'menu_type' => $req['menu_type'],
            'menu_name' => $req['menu_name'],
            'second_menu_name' => empty($req['second_menu_name'])?'':$req['second_menu_name'],
            'menu_tag' => $req['menu_tag'],
            'event_type' => $req['event_type']
        ]);
        // dd($result);
        if($req['menu_type'] == 1){ //一级菜单 
            // $first_menu_count = DB::connection('mysql_myshop')->table('menu')->where(['menu_type'=>1])->count();
        }
        $this->reload_menu();
    }
    /**
     * 刷新菜单
     */
    public function reload_menu()
    {
        $menu_info = DB::connection('mysql_myshop')->table('menu')->groupBy('menu_name')->select(['menu_name'])->orderBy('menu_name')->get()->toArray();
        foreach($menu_info as $v){
            $menu_list = DB::connection('mysql_myshop')->table('menu')->where(['menu_name'=>$v->menu_name])->get()->toArray();
            $sub_button = [];
            foreach($menu_list as $k=>$vo){
                if($vo->menu_type == 1){ //一级菜单
                    if($vo->event_type == 'view'){
                        $data['button'][] = [
                            'type' => $vo->event_type,
                            'name' => $vo->menu_name,
                            'url' => $vo->menu_tag
                        ];
                    }else{
                        $data['button'][] = [
                            'type' => $vo->event_type,
                            'name' => $vo->menu_name,
                            'key' => $vo->menu_tag
                        ];
                    }
                }
                if($vo->menu_type == 2){ //二级菜单
                    if($vo->event_type == 'view'){
                        $sub_button[] = [
                            'type' => $vo->event_type,
                            'name' => $vo->second_menu_name,
                            'url' => $vo->menu_tag
                        ];
                    }elseif($vo->event_type == 'media_id'){


                    }else{
                        $sub_button[] = [
                            'type' => $vo->event_type,
                            'name' => $vo->second_menu_name,
                            'key' => $vo->menu_tag
                        ];
                    }
                }
            }
            if(!empty($sub_button)){
                $data['button'][] = ['name'=>$v->menu_name,'sub_button' => $sub_button];
            }
        }
        echo "<pre>";
        print_r($data);
        $url = 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token='.$this->wechat->get_access_token();
        $re = $this->wechat->post($url,json_encode($data,JSON_UNESCAPED_UNICODE));
        echo json_encode($data,JSON_UNESCAPED_UNICODE).'<br/>';
        echo "<pre>";
        print_r(json_decode($re,1));
    }
    /**
     * 菜单列表
     */
    public function menu_list()
    {
        $menu_info = DB::connection('mysql_myshop')->table('menu')->groupBy('menu_name')->select(['menu_name'])->orderBy('menu_name')->get()->toArray();
        $info = [];
        foreach($menu_info as $k=>$v){
            $sub_menu = DB::connection('mysql_myshop')->table('menu')->where(['menu_name'=>$v->menu_name])->orderBy('menu_name')->get()->toArray();
            if(!empty($sub_menu[0]->second_menu_name)){
                $info[] = [
                    'menu_str' => '|',
                    'menu_name' => $v->menu_name,
                    'menu_type' => 2,
                    'second_menu_name' => '',
                    'menu_num' => 0,
                    'event_type' => '',
                    'menu_tag' => ''
                ];
                foreach($sub_menu as $vo){
                    $vo->menu_str = '|-';
                    $info[] = (array)$vo;
                }
            }else{
                $sub_menu[0]->menu_str = '|';
                $info[] = (array)$sub_menu[0];
            }
        }

        $url = 'https://api.weixin.qq.com/cgi-bin/menu/get?access_token='.$this->wechat->get_access_token();
        $re = file_get_contents($url);

        return view('menu/menu_list',['info'=>$info]);
    }
    /**
     * 自定义菜单查询接口
     */
    public function display_menu()
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/menu/get?access_token='.$this->wechat->get_access_token();
        $re = file_get_contents($url);
        echo "<pre>";
        print_r(json_decode($re,1));

    }
    /**
     * 删除菜单
     */
    public function del_menu()
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/menu/delete?access_token='.$this->wechat->get_access_token();
        $re = file_get_contents($url);
        dd(json_decode($re));
    }
}