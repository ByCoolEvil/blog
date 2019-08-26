<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// 支付宝
Route::get('return_url', 'PayController@return_url'); // 同步
Route::post('notify_url', 'PayController@notify_url'); // 异步

// 学生信息
Route::get('/student/index', 'StudentController@index');//列表
Route::get('/student/add', 'StudentController@add');//添加
Route::post('/student/do_add', 'StudentController@do_add');//执行添加
Route::get('/student/update', 'StudentController@update');//修改
Route::post('/student/do_update', 'StudentController@do_update');//执行修改
Route::get('/student/delete', 'StudentController@delete');//删除

// 后台管理
Route::get('/admin/index', 'admin\AdminController@index');//后台页面
// 前台页面
Route::get('/index/index', 'index\IndexController@index');//购物车控制器
Route::get('/index/cart', 'index\IndexController@cart');//购物车结算
Route::get('/index/cartadd', 'index\IndexController@cartadd');//添加购物车
// 登录
Route::get('/index/login', 'index\LoginController@login');//登录
Route::post('/index/do_login', 'index\LoginController@do_login');//执行登录
// 注册
Route::get('/index/register', 'index\RegisterController@register');//注册页面
Route::post('/index/do_register', 'index\RegisterController@do_register');//执行注册

// 商品库存
Route::get('/add_zhou','ZhouController@add_zhou');//添加商品
Route::post('/do_add_zhou','ZhouController@do_add_zhou');//执行添加
Route::get('/index_zhou','ZhouController@index_zhou');//列表
Route::get('/del_zhou','ZhouController@del_zhou');//删除
Route::get('/update_zhou','ZhouController@update_zhou');//修改
Route::post('/do_update_zhou','ZhouController@do_update_zhou');//执行修改
Route::get('/sou_zhou','ZhouController@sou_zhou');//搜索

//商品管理
Route::get('/commodity/add','CommodityController@add');//添加商品
Route::post('/commodity/do_add','CommodityController@do_add');//执行添加
Route::get('/commodity/list','CommodityController@list');//列表
Route::get('/commodity/update','CommodityController@update');//修改
Route::post('/commodity/do_update','CommodityController@do_update');//执行修改
Route::get('/commodity/delete','CommodityController@delete');//删除

//文件上传
Route::get('/goods/add','GoodsController@add');//添加页面
Route::post('/goods/do_add','GoodsController@do_add');//执行添加

//购物车
Route::get('/index/proinfo','Index\IndexController@proinfo');//商品列表
Route::get('/index/cartadd','Index\IndexController@cartadd');//添加购物车
Route::get('/index/cart','Index\IndexController@cart');//购物车列表
Route::get('/index/cartDel','Index\IndexController@cartDel'); //删除购物车单条数据
Route::get('/index/changeBuyNmber','Index\IndexController@changeBuyNmber'); //更改购买数量
Route::get('/index/getSubTotal','Index\IndexController@getSubTotal'); //获取小计
Route::get('/index/newprice','Index\IndexController@newprice'); //购买件数得到的价格
Route::get('/index/checkout/{cart_id}','Index\IndexController@checkout'); //支付页面
Route::get('/index/pay','Index\AliPayController@pay'); //支付成功页面

//后台抢票系统
Route::get('/ticked/add','TickedController@add');//抢票添加
Route::post('/ticked/do_add','TickedController@do_add');//执行抢票添加
Route::get('/ticked/list','TickedController@list');//抢票列表
Route::get('/ticked/delete','TickedController@delete');//抢票删除
Route::get('/ticked/update','TickedController@update');//抢票修改
Route::post('/ticked/do_update','TickedController@do_update');//执行抢票修改

//后台考试系统
Route::get('/topic/topic','TopicController@topic');//管理员添加
Route::get('/topic/do_topic','TopicController@do_topic');//管理员执行添加
Route::get('/topic/add','TopicController@add');//题库类型
Route::post('/topic/do_add','TopicController@do_add');//题库类型
Route::get('/topic/list','TopicController@list');//题库列表
Route::get('/topic/papers','TopicController@papers');//试卷添加
Route::post('/topic/do_papers','TopicController@do_papers');//生成试卷
Route::post('/topic/do_add_papers','TopicController@do_add_papers');//执行试卷添加
Route::get('/topic/test_list','TopicController@test_list');//试卷链接
Route::get('/topic/test_detail','TopicController@test_detail');//试卷

//后台调研系统
Route::get('/research/research','ResearchController@research');//登录
Route::get('/research/do_research','ResearchController@do_research');//执行登录
Route::get('/research/res','ResearchController@res');//添加调研
Route::any('/research/do_res','ResearchController@do_res');//添加问题
Route::post('/research/add_do_res','ResearchController@add_do_res');//添加问题执行
Route::get('/research/list','ResearchController@list');//调研列表
Route::get('/research/delete','ResearchController@delete');//调研删除
Route::get('/research/detail','ResearchController@detail');//访问链接
Route::get('/research/test_detail','ResearchController@test_detail');//调研链接

//足球竞猜系统
Route::get('/football/add','FootballController@add');//添加竞猜球队
Route::post('/football/doadd','FootballController@doadd');//执行添加竞猜球队
Route::any('/football/index','FootballController@index');//竞猜列表
Route::get('/football/guess','FootballController@guess');//竞猜页面
Route::post('/football/doguess','FootballController@doguess');//执行竞猜页面
Route::get('/football/goguess','FootballController@goguess');//竞猜结果
Route::post('/football/result','FootballController@result');//执行竞猜结果
Route::get('/football/results','FootballController@results');//查看竞猜结果

//班级名称
Route::get('/school/add','SchoolController@add');//班级添加
Route::post('/school/do_add','SchoolController@do_add');//执行添加
Route::get('/school/list','SchoolController@list');//班级列表
Route::get('/school/delete','SchoolController@delete');//班级删除
Route::get('/school/update','SchoolController@update');//班级修改
Route::post('/school/do_update','SchoolController@do_update');//执行修改

//新闻详情
Route::get('/xinwen/user','XinwenController@user');
Route::post('/xinwen/do_user','XinwenController@do_user');
Route::get('/xinwen/add','XinwenController@add');
Route::post('/xinwen/do_add','XinwenController@do_add');
Route::get('/xinwen/list','XinwenController@list');
Route::get('/xinwen/delete','XinwenController@delete');
Route::get('/xinwen/xiang','XinwenController@xiang');
// --------------------------------------------------------------------------------------------
Route::get('/jiekou/index','JiekouController@index');//接口
Route::any('/wechat/event','WechatController@event');//接收公众号事件
//公众号二维码
Route::get('/agent/user_list','AgentController@user_list');//微信添加标签
Route::get('/agent/create_qrcode','AgentController@create_qrcode');//生成专属二维码
Route::post('/agent/signature','AgentController@signature');  //分享签名
Route::get('/agent/agent_list','AgentController@agent_list');//用户列表
//用户标签相关
Route::get('/wechat/update_tag','WechatController@update_tag'); //修改标签
Route::post('/wechat/do_update_tag','WechatController@do_update_tag'); //执行修改标签
Route::get('/wechat/tag_list','WechatController@tag_list'); //标签列表
Route::get('/wechat/add_tag','WechatController@add_tag'); //添加标签
Route::get('/wechat/do_add_tag','WechatController@do_add_tag'); //执行添加标签
Route::post('/wechat/add_user_tag','WechatController@add_user_tag'); //为用户打标签
Route::get('/wechat/del_tag','WechatController@del_tag'); //删除标签
Route::get('/wechat/tag_user','WechatController@tag_user'); //标签下用户列表
Route::get('/wechat/get_user_tag','WechatController@get_user_tag'); //获取用户标签
Route::get('/wechat/del_user_tag','WechatController@del_user_tag'); //删除用户标签
Route::get('/wechat/push_tag_message','WechatController@push_tag_message'); //根据标签推送消息
Route::post('/wechat/do_push_tag_message','WechatController@do_push_tag_message'); //执行根据标签推送消息
//第一周作业
Route::get('/wechat/get_user_info','WechatController@get_user_info');//添加粉丝公众号
Route::get('/wechat/get_user_list','WechatController@get_user_list');//执行表单提交获取的粉丝
Route::get('/wechat/user_list','WechatController@user_list');//粉丝列表
//上传素材
Route::get('/wechat/upload_source','WechatController@upload_source');//我的素材
Route::get('/wechat/get_source','WechatController@get_source');//图片资源
Route::get('/wechat/get_video_source','WechatController@get_video_source');//视频资源
Route::get('/wechat/get_voice_source','WechatController@get_voice_source');//音频资源
Route::post('wechat/do_upload','WechatController@do_upload');//上传素材
//模板测试
Route::get('/wechat/template_list','WechatController@template_list');//模板列表
Route::get('/wechat/del_template','WechatController@del_template');//模板删除
Route::get('/wechat/push_template','WechatController@push_template');//推送消息
//登录注册
Route::get('/wechat/login','WechatController@login');//登录
Route::get('/wechat/code','WechatController@code');//执行注册登录
//菜单
Route::get('/menu/menu_add','MenuController@menu_add');//菜单列表
Route::get('/menu/menu_list','MenuController@menu_list');//菜单列表
Route::get('/menu/del_menu','MenuController@del_menu');//完全删除菜单
Route::post('/menu/do_add_menu','MenuController@do_add_menu');//增加菜单
Route::get('/menu/display_menu','MenuController@display_menu');//菜单查询接口
Route::get('/menu/reload_menu','MenuController@reload_menu');//刷新菜单接口
//留言+注册登录
Route::get('liuyan/wechat_login','LiuYanController@wechat_login');//微信登录
Route::get('liuyan/wechat_code','LiuYanController@wechat_code');//接收code
Route::get('liuyan/login','LiuYanController@login');//页面登录
Route::post('liuyan/do_login','LiuYanController@do_login');//执行页面登录
Route::get('liuyan/do_del','LiuYanController@do_del');//删除留言
//月考表白
Route::get('/biaobai/index','BiaoBaiController@index');
Route::get('/biaobai/send','BiaoBaiController@send');
Route::post('/biaobai/do_send','BiaoBaiController@do_send');

//调用中间件
Route::group(['middleware'=>['update']],function(){ 
    Route::get('/student/update', 'StudentController@update');
    Route::get('/update_zhou','ZhouController@update_zhou');
    
});
//调用中间件
Route::group(['middleware'=>['login']],function(){ 
    Route::get('/liuyan/index','LiuYanController@index');//留言板主页
    Route::get('/liuyan/send','LiuYanController@send');//留言
    Route::post('/liuyan/do_send','LiuYanController@do_send');//执行留言

});