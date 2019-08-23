<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{url('menu/do_add_menu')}}" method="post">
        @csrf
        菜单类型：<select name="menu_type" >
            <option value="1">一级菜单</option>
            <option value="2">二级菜单</option>
        </select><br/>
        菜单名称：<input type="text" name="menu_name"><br/>
        二级菜单名称：<input type="text" name="second_menu_name"><br/>
        菜单标识（标识或url）：<input type="text" name="menu_tag"><br/>
        事件类型：<select name="event_type" >
            <option value="click">click</option>
            <option value="view">view</option>
            <option value="scancode_push">scancode_push</option>
            <option value="scancode_waitmsg">scancode_waitmsg</option>
            <option value="pic_sysphoto">pic_sysphoto</option>
            <option value="pic_photo_or_album">pic_photo_or_album</option>
            <option value="pic_weixin">pic_weixin</option>
            <option value="location_select">location_select</option>
            <option value="media_id">media_id</option>
        </select><br/>
        <input type="submit" value="提交">
    </form>
</body>
</html>