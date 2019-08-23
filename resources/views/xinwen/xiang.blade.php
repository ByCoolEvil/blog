<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>新闻详情页</title>
</head>
<body>
    <h1>新闻详情页</h1>
    <table border="1">
        <tr>
            <td>新闻作者</td>
            <td>新闻详细内容</td>
        </tr>
        @foreach($xinwen as $item)
        <tr>
            <td>{{ $item->name }}</td>
            <td>{{ $item->xiang }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>