<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>商品列表</title>
</head>
<body>
    <form action="{{url('commodity/list')}}" method="get">
        姓名查询：<input type="text" name="search" value="{{$search}}">
        <input type="submit" name="" value="搜索">
    </form>
        <table border="1">
            <tr>
                <td>ID</td>
                <td>商品名称</td>
                <td>商品图片</td>
                <td>商品库存</td>
                <td>添加时间</td>
                <td>操作</td>
            </tr>
            @foreach($commodity as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->pic }}</td>
                <td>{{ $item->kc }}</td>
                <td>{{ date('Y-m-d H:i:s',$item->add_time) }}</td>
                <td>
                    <a href="{{url('/commodity/update')}}?id={{$item->id}}">修改</a>
                    <a href="{{url('/commodity/delete')}}?id={{$item->id}}">|删除|</a>
                    <a href="{{url('/commodity/add')}}?id={{$item->id}}">添加</a>
                </td>
            </tr>
            @endforeach
        </table>
        {{ $commodity->appends(['search'=>$search])->links() }}
    </form>
</body>
</html>