<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>商品修改</title>
</head>
<body>
    <form action="{{url('commodity/do_update')}}" method="post">
        <table border="1">
            @csrf
            <input type="hidden" name="id" value="{{$commodity_info->id}}">
            <tr>
                <td>商品名称</td>
                <td><input type="text" name="name" value="{{$commodity_info->name}}"></td>
            </tr>
            <tr>
                <td>商品库存</td>
                <td><input type="text" name="kc" value="{{$commodity_info->kc}}"></td>
            </tr>
            <tr>
                <td><input type="submit" value="修改"></td>
                <td></td>
            </tr>
        </table>
    </form>
</body>
</html>