<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>添加信息</title>
</head>
<body>
<center>
    <!-- 非空提交验证错误提示 -->
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            {{ $error }}
        @endforeach
    @endif
    <form action="{{url('student/do_add')}}" method="post">
        @csrf
        <table border="1">
        <tr>
            <td>姓名</td>
            <td><input type="text" name="name" id=""></td>
        </tr>
        <tr><td>年龄</td>
            <td>
                <select name="age" id="">
                    @for($i=15;$i<25;$i++)
                        <option value="{{$i}}">{{$i}}</option>
                    @endfor
                </select>
            </td>
        </tr>
        <tr>
            <td>性别</td>
            <td><input type="radio" name="sex" value="1" checked>男
            <input type="radio" name="sex" value="2">女</td>
        </tr>
        <tr>
            <td><input type="submit" name="" value="提交"></td>
        </tr>
    </form>
</center>
</body>
</html>