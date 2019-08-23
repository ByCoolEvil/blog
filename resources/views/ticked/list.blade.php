<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>车票列表</title>
</head>
<body>
    <form action="{{url('ticked/list')}}" method="get">
        出发地：<input type="text" name="set" value="{{$set}}">
        目的地：<input type="text" name="arr" value="{{$arr}}">
        <input type="submit" name="" value="搜索">
    </form>
    <table border="1">
        <tr>
            <td>ID</td>
            <td>车次</td>
            <td>出发地</td>
            <td>到达地</td>
            <td>硬座</td>
            <td>软座</td>
            <td>价钱</td>
            <td>张数</td>
            <td>出发时间</td>
            <td>操作</td>
        </tr>
        @foreach($list as $item)
        <tr>
            <td>{{ $item['id'] }}</td>
            <td>{{ $item['chec'] }}</td>
            <td>{{ $item['set'] }}</td>
            <td>{{ $item['arr'] }}</td>
            <td>{{ $item['yingzuo'] }}</td>
            <td>{{ $item['ruanzuo'] }}</td>
            <td>{{ $item['price'] }}</td>
            <td>{{ $item['zha'] }}</td>
            
            <td>{{ date('Y-m-d H:i:s',$item['add_time']) }}</td>
            <td>
                <a href="{{url('/ticked/update')}}?id={{$item['id']}}">修改</a>
                <a href="{{url('/ticked/delete')}}?id={{$item['id']}}">|删除</a>
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>