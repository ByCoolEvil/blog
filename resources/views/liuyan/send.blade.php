<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>留言</title>
</head>
<body>
<center>
    <form action="{{url('liuyan/do_send')}}" method="post">
        <input type="hidden" value="{{$uid}}" name="uid">
        @csrf
        消息：
        <textarea name="send_info" id="" cols="30" rows="10"></textarea>
        <input type="submit" value="提交">
    </form>
</center>
<script type="text/javascript">
    $(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
</script>
</body>
</html>