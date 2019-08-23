<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>商品添加</title>
</head>
<body>
    <!-- 非空提示 -->
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            {{ $error }}
        @endforeach
    @endif
    <form action="{{url('commodity/do_add')}}" method="post">
        <table border="1">
            @csrf
            <tr>
                <td>商品名称</td>
                <td><input type="text" name="name"></td>
            </tr>
            <tr>
                <td>商品图片</td>
                <td><input type="file" name="pic"></td>
            </tr>
            <tr>
                <td>商品库存</td>
                <td><input type="text" name="kc"></td>
            </tr>
            <tr>
                <td><input type="submit" value="添加"></td>
                <td></td>
            </tr>
        </table>
    </form>
</body>
</html>