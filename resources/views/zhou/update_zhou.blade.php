<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>修改</title>
</head>
<body>
	<form action="{{ url('do_update_zhou') }}" method="post">
		<table border="1">
			@csrf
			<input type="hidden" name="id" value="{{$stu->id}}">
			<tr>
				<td>
					货物名称 : <input type="text" name="name" value="{{$stu->name}}"><br />
				</td>
			</tr>
			<tr>
				<td>
					原货物图片 : <img src="{{ $stu->zhou_img }}" alt="" width="100px">
				</td>
			</tr>
			<tr>
				<td>
					新货物图片 : <input type="file" name="zhou_img">
				</td>
			</tr>
			<tr>
				<td>
					库　　存 : <input type="text" name="ku" value="{{$stu->ku}}"><br />
				</td>
			</tr>
			<tr>
				<td>
					<input type="submit" value="提交">
				</td>
			</tr>
		</table>
	</form>
</body>
</html>