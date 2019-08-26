<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>表白列表</title>
</head>
<body>
<center>
    <table border="1">
        <tr>
            <td>编号</td>
            <td>openid</td>
            <td>操作</td>
        </tr>
        @foreach($info as $k=>$v)
            <tr>
                <td>{{$k}}</td>
                <td>{{$v}}</td>
                <td><a href="{{url('biaobai/send')}}?openid={{$v}}">表白</a></td>
            </tr>
        @endforeach

    </table>
</center>
</body>
</html>