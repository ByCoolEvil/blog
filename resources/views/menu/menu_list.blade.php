<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>菜单列表</title>
</head>
<body>
    <table border="1">
        <tr>
            <td>菜单结构</td>
            <td>菜单编号</td>
            <td>菜单名称</td>
            <td>二级菜单名</td>
            <td>菜单等级</td>
            <td>事件类型</td>
            <td>菜单标识</td>
            <td>操作</td>
        </tr>
        @foreach($info as $v)
        <tr>
            <td>{{$v['menu_str']}}</td>
            <td>{{$v['menu_num']}}</td>
            <td>@if(empty($v['second_menu_name'])){{$v['menu_name']}}@endif</td>
            <td>{{$v['second_menu_name']}}</td>
            <td>{{$v['menu_type']}}</td>
            <td>{{$v['event_type']}}</td>
            <td>{{$v['menu_tag']}}</td>
            <td><a href="{{url('menu/del_menu')}}">删除</a></td>
        </tr>
        @endforeach
    </table>
</body>
</html>