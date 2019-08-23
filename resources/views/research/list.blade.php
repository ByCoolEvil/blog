<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>调研列表</title>
</head>
<body>
    <table border="1">
        @foreach($research_problem as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->problem }}</td>
            <td>
                <a href="{{url('/research/detail')}}">启用</a>
            </td>
            <td>
                <a href="{{url('/research/delete')}}?id={{$item->id}}">删除</a>
            </td>
        </tr>
        @endforeach
    </table>
    {{ $research_problem->links() }}
</body>
</html>