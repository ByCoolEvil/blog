<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>学生修改</title>
</head>
<body>
<center>
<form action="{{url('student/do_update')}}" method="post">
        @csrf
        <table border="1">
        <input type="hidden" name="id" value="{{$student_info->id}}">
        <tr>
            <td>姓名</td>
            <td><input type="text" name="name" value="{{$student_info->name}}"></td>
        </tr>
        <tr><td>年龄</td>
            <td>
                <select name="age" value="{{$student_info->age}}">
                    @for($i=15;$i<25;$i++)
                        <option value="{{$i}}">{{$i}}</option>
                    @endfor
                </select>
            </td>
        </tr>
        <tr>
            <td>性别</td>
            <td><input type="radio" name="sex" value="1" checked value="{{$student_info->sex}}">男
            <input type="radio" name="sex" value="2" value="{{$student_info->sex}}">女</td>
        </tr>
        <tr>
            <td><input type="submit" name="" value="修改"></td>
        </tr>
</center>
</body>
</html>