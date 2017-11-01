<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            text-align: center;
            padding: 50px;
        }
        table {
            margin: 0 auto;

        }
        td {
            border: 1px solid #999;
            padding: 10px 20px;
        }
        img {
            width: 200px;
            height: 200px;
        }
        a {
            line-height: 30px;
        }
    </style>
</head>
<body>
<table>
    <thead>
        <td>学号</td>
        <td>名字</td>
        <td>已有工时</td>
    </thead>
    <tbody>
    @forelse($notes as $value)
    <tr>
        <td>{{ $value->student_id }}</td>
        <td>{{ $value->name }}</td>
        <td>{{ $value->work_hour }}</td>
    </tr>
    @empty
        <tr>
            <td colspan="6">没有数据</td>
        </tr>
    @endforelse
    </tbody>
</table>
</body>
</html>