<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('./resources/css/bootstrap.css')}}">
    <style>
        .light{
            background-color: #7abaff;
        }
    </style>
</head>
<body>
<table class="table">
    <thead>
    <tr>
        <th>이름</th>
        <th>전화번호</th>
        <th>점수</th>
        <th>참여일</th>
        <th>진행률</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data['list'] as $list)
    <tr class="light">
        <td>{{$list['name']}}</td>
        <td>{{$list['phone']}}</td>
        <td>{{$list['score']}}</td>
        <td>{{$list['date']}}</td>
        <td>{{$list['cnt']}}</td>
    </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
