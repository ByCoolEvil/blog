<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>添加调研</title>
</head>
<body>
    <form action="{{url('research/do_res')}}">
        调研项目：<input type="text" name="type_id">
        <input type="submit" value="添加调研">
    </form>
</body>
</html>