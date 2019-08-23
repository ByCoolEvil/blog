<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>抢票</title>
</head>
<body>
<form action="{{url('/ticked/do_add')}}" method="post">
    @csrf
    <table border="1">
        <tr>
            <td>车次</td>
            <td><input type="text" name="chec"></td>
        </tr>
        <tr>
            <td>出发地</td>
            <td><input type="text" name="set"></td>
        </tr>
        <tr>
            <td>到达地</td>
            <td>
                <input type="text" name="arr">
            </td>
        </tr>
        <tr>
            <td>硬座</td>
            <td><input type="text" name="yingzuo"></td>
        </tr>
        <tr>
            <td>软座</td>
            <td><input type="text" name="ruanzuo"></td>
        </tr>
        <tr>
            <td>价钱</td>
            <td>
                <input type="text" name="price">
            </td>
        </tr>
        <tr>
            <td>张数</td>
            <td><input type="text" name="zha"></td>
        </tr>
        <tr>
            <td><input type="submit" value="添加车票"></td>
            <td></td>
        </tr>
    </table>
</form>
</body>
</html>