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
    </tr>
    </thead>
    <tbody>
    @foreach($data['item'] as $idx => $item)
        <tr>
            <td>{{$idx+1}}</td>
            <td>{{$item->areas->area}}</td>
            <td class="">
                <form action="{{route('item.update',$item->id)}}" method="POST" class="d-flex" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    {{csrf_field()}}
                    <input type="text" value="{{$item['item']}}" class="form-control" name="item">
                    <input type="file" accept=".jpg" name="img" class="form-control">
                    <button class="btn btn-primary" type="submit">변경</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>

