<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>班级列表</title>
</head>
<body>
    <form action="{{url('school/list')}}" method="get">
        姓名查询：<input type="text" name="search" value="{{$search}}">
        <input type="submit" value="搜索">
    </form>
    <table border="1">
        <tr>
            <td>ID</td>
            <td>姓名</td>
            <td>年龄</td>
            <td>性别</td>
            <td>班级</td>
            <td>学校</td>
            <td>添加时间</td>
            <td>操作</td>
        </tr>
    @foreach($school as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->age }}</td>
            <td>{{ $item->sex }}</td>
            <td>{{ $item->class }}</td>
            <td>{{ $item->school }}</td>
            <td>{{ date('Y-m-d H:i:s',$item->add_time) }}</td>
            <td>
                <a href="{{url('school/delete')}}?id={{$item->id}}">删除</a>
                <a href="{{url('school/update')}}?id={{$item->id}}">|修改</a>
            </td>
        </tr>
    @endforeach
    </table>
    {{ $school->appends(['search' => $search])->links() }}
</body>
</html>