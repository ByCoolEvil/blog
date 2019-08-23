<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>列表</title>
</head>
<body>
    <table border="1">
        <tr>
            <td>新闻ID</td>
            <td>新闻标题</td>
            <td>新闻图片</td>
            <td>新闻作者</td>
            <td>添加时间</td>
            <td>操作</td>
        </tr>
        @foreach($xinwen as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->name }}</td>
            <td><img src="{{asset($item->xin_pic)}}" id="img"></td>
            <td>{{ $item->zuo }}</td>
            <td>{{ date('Y-m-d H:i:s',$item->add_time) }}</td>
            <td>
                <a href="{{url('xinwen/delete')}}?id={{$item->id}}">删除</a>
                <a href="{{url('xinwen/xiang')}}?id={{$item->id}}">|详情页</a>
            </td>
        </tr>
        @endforeach
    </table>
    {{ $xinwen->links() }}
</body>
</html>