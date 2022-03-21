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
<a href="{{route('item.view')}}"><button class="btn btn-primary">특산물 야무지게 보기</button></a>
<a href="{{route('event.index')}}"><button class="btn btn-primary">이벤트</button></a>
<a href="{{route('review.index')}}"><button class="btn btn-primary">후기 야무지게 보기</button></a>
@if(auth()->user())
    <a href="{{route('user.logout')}}"><button class="btn btn-primary">로그아웃</button></a>
    <a href="{{route('event.control')}}"><button class="btn btn-primary">출석진행 야무지게 보기</button></a>
    <a href="{{route('item.index')}}"><button class="btn btn-primary">특산품 관리</button></a>
@else
    <a href="{{route('user.index')}}"><button class="btn btn-primary">로그인</button></a>
    @endif
</body>
</html>
