<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>文件上传</title>
</head>
<body>
    <form action="{{url('goods/do_add')}}" method="post" enctype="multipart/form-data">
        @csrf
        图片名称：<input type="text" name="goods_name"><br/>
        图片：<input type="file" name="goods_pic"><br/>
        商品价格：<input type="text" name="goods_price"><br/>
        <input type="submit" value="提交">
    </form>
</body>
</html>