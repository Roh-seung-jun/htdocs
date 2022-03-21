

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('./resources/css/bootstrap.css')}}">
</head>
<body>
<table class="table">
    <thead>
    <tr>
        <th>순번</th>
        <th>지역</th>
        <th>특산품</th>
        <th>이미지</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data['item'] as $idx => $item)
        <tr>
            <td>{{$idx+1}}</td>
            <td>{{$item->areas->area}}</td>
            <td class="">
                {{$item->item}}
            </td>
            <td><img src="{{asset($item->img)}}" alt=""></td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
