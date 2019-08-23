<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>展示</title>
</head>
<body>
	<a href="{{url('/add_zhou')}}">添加</a>
	<form action="">
		商品名称：<input type="text" name="search" value="{{$query['name']??''}}">
		<input type="submit" name="" value="搜索">
	</form>
	<table border="1">
		<tr>
			<td>货物名称</td>
			<td>货物图片</td>
			<td>库存</td>
			<td>添加时间</td>
			<td>操作</td>
		</tr>
		@foreach($info as $v)
		<tr>
			<td>{{ $v->name }}</td>
			<td><img src="{{ $v->zhou_img }}" alt="" width="100px"></td>
			<td>{{ $v->ku }}</td>
			<td>{{ date('Y-m-d H:i:s',$v->time) }}</td>
			<td>
				<a href="{{url('/del_zhou')}}?id={{$v->id}}">删除</a>
				<a href="{{url('/update_zhou')}}?id={{$v->id}}">修改</a>
			</td>
		</tr>
        @endforeach
	</table>
</body>
</html>