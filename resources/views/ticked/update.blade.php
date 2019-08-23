<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>抢票</title>
</head>
<body>
<form action="{{url('/ticked/do_update')}}" method="post">
    @csrf
    <table border="1">
        <input type="hidden" name="id" value="{{$ticked->id}}">
        <tr>
            <td>车次</td>
            <td><input type="text" name="chec" value="{{$ticked->chec}}"></td>
        </tr>
        <tr>
            <td>出发地</td>
            <td><input type="text" name="set" value="{{$ticked->set}}"></td>
        </tr>
        <tr>
            <td>到达地</td>
            <td>
                <input type="text" name="arr" value="{{$ticked->arr}}">
            </td>
        </tr>
        <tr>
            <td>硬座</td>
            <td><input type="text" name="yingzuo" value="{{$ticked->yingzuo}}"></td>
        </tr>
        <tr>
            <td>软座</td>
            <td><input type="text" name="ruanzuo" value="{{$ticked->ruanzuo}}"></td>
        </tr>
        <tr>
            <td>价钱</td>
            <td>
                <input type="text" name="price" value="{{$ticked->price}}">
            </td>
        </tr>
        <tr>
            <td>张数</td>
            <td><input type="text" name="zha" value="{{$ticked->zha}}"></td>
        </tr>
        <tr>
            <td><input type="submit" value="修改车票"></td>
            <td></td>
        </tr>
    </table>
</form>
</body>
</html>