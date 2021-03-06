<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>修改班级信息</title>
</head>
<body>
    <form action="{{url('school/do_update')}}" method="post">
        @csrf
        <table border="1">
            <input type="hidden" name="id" value="{{$school_info->id}}">
            <tr>
                <td>姓名：</td>
                <td><input type="text" name="name" value="{{$school_info->name}}"></td>
            </tr>
            <tr>
                <td>年龄</td>
                <td>
                    <select name="age" value="{{$school_info->age}}">
                        @for($i=15;$i<26;$i++)
                        <option value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>
                </td>
            </tr>
            <tr>
                <td>性别</td>
                <td>
                    <input type="radio" name="sex" value="男" checked value="{{$school_info->sex}}">男
                    <input type="radio" name="sex" value="女" value="{{$school_info->sex}}">女
                </td>
            </tr>
            <tr>
                <td>班级名称</td>
                <td>
                    <select name="class" value="{{$school_info->class}}">
                        @for($i=1809;$i<1812;$i++)
                        <option value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>
                </td>
            </tr>
            <tr>
                <td>学校</td>
                <td>
                    <select name="school" value="{{$school_info->school}}">
                        <option value="乐柠教育">乐柠教育</option>
                        <option value="北大青鸟">北大青鸟</option>
                        <option value="北京理工">北京理工</option>
                        <option value="六星教育">六星教育</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><input type="submit" value="修改"></td>
                <td></td>
            </tr>
        </table>
    </form>
</body>
</html>