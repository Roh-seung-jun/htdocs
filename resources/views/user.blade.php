<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('./resources/css/bootstrap.css')}}">
    <script>
        @if(session()->has('msg'))
        alert( '{{ session()->get('msg')}}' );
        @endif
    </script>
</head>
<body>
<form action="{{route('user.login')}}" method="post">
    @csrf
    <input type="text" class="form-control" name="id">
    <input type="text" class="form-control" name="pass">
    <button class="btn btn-primary">로그인</button>
</form>
</body>
</html>
