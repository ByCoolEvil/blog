<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>登录</title>
</head>
<body>
<center>
    <form action="{{url('liuyan/do_login')}}" method="post">
        @csrf
        <input type="text" name="name">
        <input type="password" name="password">
        <a href="{{url('/liuyan/wechat_login')}}">微信登录</a>
        <input type="submit" value="提交">
    </form>
</center>
<script type="text/javascript">
    $(function(){
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        })
    });
</script>
</body>
</html>