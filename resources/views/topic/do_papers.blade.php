<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>生成试卷</title>
</head>
<body>
    <form action="{{url('/topic/do_add_papers')}}" method="post">
        @csrf
        <h1>{{$title}}</h1>
        <input type="hidden" value="{{$title}}" name="title">
        @foreach($info as $v)
            <input type="checkbox" name="problem[]" value="{{$v->id}}">
            {{$v->problem}}<br/>
        @endforeach
        <br/>
        <input type="submit" value="提交">
    </form>
</body>
</html>