<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>新闻添加</title>
</head>
<body>
    <form action="{{url('xinwen/do_add')}}" method="post" enctype="multipart/form-data">
    @csrf
        <table border="1">
            <tr>
                <td>新闻标题</td>
                <td><input type="text" name="name"></td>
            </tr>
            <tr>
                <td>新闻图片</td>
                <td><input type="file" name="xin_pic"></td>
            </tr>
            <tr>
                <td>新闻作者</td>
                <td><input type="text" name="zuo"></td>
            </tr>
            <tr>
                <td>新闻详情</td>
                <td><input type="text" name="xiang"></td>
            </tr>
            <tr>
                <td><input type="submit" value="添加"></td>
                <td></td>
            </tr>
        </table>
    </form>
</body>
</html>