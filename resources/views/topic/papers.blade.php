<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>考试卷</title>
</head>
<body>
    <form action="{{url('/topic/do_papers')}}" method="post">
        @csrf
        试卷名称：<input type="text" name="title">
        <input type="submit" value="生成试卷">
    </form>
</body>
</html>