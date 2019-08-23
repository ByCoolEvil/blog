<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>学生列表</title>
</head>
<body>
    <center>
        <h1>学生列表</h1>
        <form action="{{url('student/index')}}" method="get">
            姓名查询：<input type="text" name="search" value="{{$search}}">
            <input type="submit" name="" value="搜索">
        </form>
        <table border="1">
            <tr>
                <td>ID</td>
                <td>姓名</td>
                <td>性别</td>
                <td>年龄</td>
                <td>添加时间</td>
                <td>操作</td>
            </tr>
            @foreach($student as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->sex }}</td>
                <td>{{ $item->age }}</td>
                <td>{{ date('Y-m-d H:i:s',$item->add_time) }}</td>
                <td>
                    <a href="{{url('/student/update')}}?id={{$item->id}}">修改</a>
                    <a href="{{url('/student/delete')}}?id={{$item->id}}">|删除|</a>
                    <a href="{{url('/student/add')}}">添加</a>
                </td>
            </tr>
            @endforeach
        </table>
        {{ $student->appends(['search' => $search])->links() }}
    </center>
</body>
</html>