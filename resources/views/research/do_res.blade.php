<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>调研问题</title>
</head>
<body>
<form action="{{url('/research/add_do_res')}}" method="post">
    @csrf
        调研问题：<input type="text" name="problem"><br/>
        问题选项：
        <input type="radio" name="type" id="que_type1" value="1">单选框
        <input type="checkbox" name="type" id="que_type2" value="2">复选框<br/>
        <input type="submit" name="type" value="添加问题">

    <div id="single">
        <span>单选题</span><br>
        题目：<input type="text" name="single" value=""><br/>
        A:<input type="radio" name="single_answer" value="1">
        <input type="text" name="single_a" value=""><br/>
        B:<input type="radio" name="single_answer" value="2">
        <input type="text" name="single_b" value=""><br/>
        C:<input type="radio" name="single_answer" value="3">
        <input type="text" name="single_c" value=""><br/>
        D:<input type="radio" name="single_answer" value="4">
        <input type="text" name="single_d" value=""><br/>
    </div>

    <div id="box">
        <span>多选题</span><br/>
        题目：<input type="text" name="box" value=""><br/>
        A:<input type="checkbox" name="box_answer[]" value="1">
        <input type="text" name="box_a" value=""><br/>
        B:<input type="checkbox" name="box_answer[]" value="2">
        <input type="text" name="box_b" value=""><br/>
        C:<input type="checkbox" name="box_answer[]" value="3">
        <input type="text" name="box_c" value=""><br/>
        D:<input type="checkbox" name="box_answer[]" value="4">
        <input type="text" name="box_d" value=""><br/>
    </div>
    <input type="submit" name="sub" value="提交">
</form>
<script src="{{asset('/layui/jquery.min.js')}}"></script>
<script>
    $(function(){
        $('#single').hide();
        $('#box').hide();
        $('input[name=sub]').hide();
        $('#que_type1').change(function(){
            var type = $(this).val();
            $('#single').show();
            $('input[name=sub]').show();
        });

        $('#que_type2').change(function(){
            var type = $(this).val();
            $('#box').show();
            $('input[name=sub]').show();
        });
    });
</script>
</body>
</html>