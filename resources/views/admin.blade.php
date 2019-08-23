<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>layout 后台大布局 - Layui</title>
  <link rel="stylesheet" href="/layui/css/layui.css">
</head>
<body class="layui-layout-body">
<div class="layui-layout layui-layout-admin">
  <div class="layui-header">
    <div class="layui-logo">layui 后台布局</div>
    <!-- 头部区域（可配合layui已有的水平导航） -->
    <ul class="layui-nav layui-layout-left">
      <li class="layui-nav-item"><a href="">控制台</a></li>
      <li class="layui-nav-item"><a href="">商品管理</a></li>
      <li class="layui-nav-item"><a href="">用户</a></li>
      <li class="layui-nav-item">
        <a href="javascript:;">其它系统</a>
        <dl class="layui-nav-child">
          <dd><a href="">邮件管理</a></dd>
          <dd><a href="">消息管理</a></dd>
          <dd><a href="">授权管理</a></dd>
        </dl>
      </li>
    </ul>
    <ul class="layui-nav layui-layout-right">
      <li class="layui-nav-item">
        <a href="javascript:;">
          <img src="http://t.cn/RCzsdCq" class="layui-nav-img">
          贤心
        </a>
        <dl class="layui-nav-child">
          <dd><a href="">基本资料</a></dd>
          <dd><a href="">安全设置</a></dd>
        </dl>
      </li>
      <li class="layui-nav-item"><a href="">退了</a></li>
    </ul>
  </div>
  
  <div class="layui-side layui-bg-black">
    <div class="layui-side-scroll">
      <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
      <ul class="layui-nav layui-nav-tree"  lay-filter="test">
        <li class="layui-nav-item layui-nav-itemed">
          <a class="" href="javascript:;">学生添加</a>
          <dl class="layui-nav-child">
            <dd><a href="{{url('student/add')}}">学生添加</a></dd>
            <dd><a href="{{url('student/index')}}">学生列表</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item">
          <a href="javascript:;">商品库存</a>
          <dl class="layui-nav-child">
            <dd><a href="{{url('add_zhou')}}">商品添加</a></dd>
            <dd><a href="{{url('index_zhou')}}">商品列表</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item">
          <a href="javascript:;">商品管理</a>
          <dl class="layui-nav-child">
            <dd><a href="{{url('commodity/add')}}">商品添加</a></dd>
            <dd><a href="{{url('commodity/list')}}">商品列表</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item">
          <a href="javascript:;">文件上传</a>
          <dl class="layui-nav-child">
            <dd><a href="{{url('/goods/add')}}">图片上传</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item">
          <a href="javascript:;">抢票系统</a>
          <dl class="layui-nav-child">
            <dd><a href="{{url('/ticked/add')}}">抢票添加</a></dd>
            <dd><a href="{{url('/ticked/list')}}">抢票列表</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item">
          <a href="javascript:;">考试系统</a>
          <dl class="layui-nav-child">
            <dd><a href="{{url('/topic/add')}}">题库添加</a></dd>
            <dd><a href="{{url('/topic/list')}}">题库列表</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item">
          <a href="javascript:;">调研系统</a>
          <dl class="layui-nav-child">
            <dd><a href="{{url('/football/add')}}">添加竞猜</a></dd>
            <dd><a href="{{url('/football/index')}}">竞猜列表</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item">
          <a href="javascript:;">足球竞猜</a>
          <dl class="layui-nav-child">
            <dd><a href="{{url('/football/add')}}">竞猜添加</a></dd>
            <dd><a href="{{url('/football/index')}}">竞猜列表</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item">
          <a href="javascript:;">1</a>
          <dl class="layui-nav-child">
            <dd><a href="{{url('')}}">2</a></dd>
            <dd><a href="{{url('')}}">3</a></dd>
          </dl>
        </li>
        <!-- <li class="layui-nav-item"><a href="">云市场</a></li> -->
        <!-- <li class="layui-nav-item"><a href="">发布商品</a></li> -->
      </ul>
    </div>
  </div>
  
  <div class="layui-body">
    <!-- 内容主体区域 -->
    <div style="padding: 15px;">内容主体区域</div>
  </div>
  
  <div class="layui-footer">
    <!-- 底部固定区域 -->
    
  </div>
</div>
<script src="/layui/layui.js"></script>
<script>
//JavaScript代码区域
layui.use('element', function(){
  var element = layui.element;
  
});
</script>
</body>
</html>