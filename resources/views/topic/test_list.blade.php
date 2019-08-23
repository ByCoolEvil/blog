<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>试卷链接</title>
</head>
<body>
    @foreach($info as $v)
        链接：<a href="{{url('topic/test_detail')}}?id={{$v->id}}">访问链接</a><br/>
    @endforeach
</body>
</html>