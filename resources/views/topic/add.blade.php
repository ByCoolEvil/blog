<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>题库添加</title>
</head>
<body>
<center>
    选择题库:
    <form action="{{url('/topic/do_add')}}" method="post">
        @csrf
        <select name="type" id="question_type">
            <option value="">请选择</option>
            <option value="1">单选</option>
            <option value="2">复选</option>
            <option value="3">判断</option>
        </select>

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

        <div id="judge">
            <span>判断题</span><br/>
            题目：<input type="text" name="judge" value=""><br/>
            正确：<input type="radio" name="judge_answer" value="1"><br/>
            错误：<input type="radio" name="judge_answer" value="2"><br/>
        </div>
        <br/>
        <input type="submit" name="sub" value="提交">
    </form>
</center>
<script src="{{asset('/layui/jquery.min.js')}}"></script>
<script>
    $(function(){
        $('#single').hide();
        $('#box').hide();
        $('#judge').hide();
        $('input[name=sub]').hide();
        $("#question_type").change(function(){
            var type = $(this).val();
            if(type == 1){
                $('#box').hide();
                $('#judge').hide();
                $('#single').show();
            }else if(type == 2){
                $('#judge').hide();
                $('#single').hide();
                $('#box').show();
            }else if(type == 3){
                $('#single').hide();
                $('#box').hide();
                $('#judge').show();
            }
            $('input[name=sub]').show();
        });
    });
</script>
</body>
</html>
