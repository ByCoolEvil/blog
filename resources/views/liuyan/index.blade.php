<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>列表</title>
</head>
<body>
<center>
    <table border="1">
        <tr>
            <td>uid</td>
            <td>用户名称</td>
            <td>操作</td>
        </tr>
        @foreach($info as $v)
        <tr>
            <td>{{$v->uid}}</td>
            <td>{{$v->nick_name}}</td>
            <td>
                <a href="{{url('liuyan/send')}}?uid={{$v->uid}}">发送留言</a>
            </td>
        </tr>
        @endforeach
    </table>
</center>
<script type="text/javascript">
    $(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
</script>
</body>
</html>