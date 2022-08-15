<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('style.css')}}">
    <link rel="stylesheet" href="{{asset('fontawesome/css/all.css')}}">
    <script src="{{asset('/jQuery/jquery-3.6.0.min.js')}}"></script>
    <script>
        @if(session()->has('msg'))
            alert('{{session()->get('msg')}}');
        @endif

        @if($errors->any())
        alert('{{$errors->first()}}');
        @endif
    </script>
    @yield('script')
</head>
<body>
<section id="header" class="w-100">
    <div class="nav container d-flex align-items-center justify-content-between">
        <img src="{{asset('/img/logo.png')}}" alt="logo" title="logo" class="logo p-1">
        <ul class="d-flex align-items-center h-100 justify-content-between w-25 m-0">
            <li class="position-relative d-flex justify-content-center align-items-center">
                <a href="#">홈</a>
            </li>
            <li class="position-relative d-flex justify-content-center align-items-center">
                <a href="{{route('guide')}}">정원 안내</a>
                <ul class="position-absolute d-flex justify-content-center align-items-center flex-column">
                    <li>
                        <a href="">정원검색</a>
                    </li>
                    <li>
                        <a href="">전체정원목록</a>
                    </li>
                </ul>
            </li>
            <li class="position-relative d-flex justify-content-center align-items-center">
                <a href="#">정원 예약</a>
                <ul class="position-absolute d-flex justify-content-center align-items-center flex-column">
                    <li>
                        <a href="#">예약 확인</a>
                    </li>
                    <li>
                        <a href="#">예약 내역</a>
                    </li>
                </ul>
            </li>
            <li class="position-relative d-flex justify-content-center align-items-center">
                <a href="#">정원 소식지</a>
            </li>
        </ul>
        <div class="btn-group">
            @if(!auth()->user())
            <button class="btn btn-outline-success" onclick="location.href='{{route('login')}}'">로그인</button>
                @else
                <button class="btn btn-outline-success" onclick="location.href='{{route('logout')}}'">로그아웃</button>
            @endif
            <button class="btn btn-outline-success" onclick="location.href='{{route('sign')}}'">회원가입</button>
        </div>
    </div>
</section>
@yield('contents')

<footer>
    <div class="container d-flex justify-content-center align-items-center flex-column h-100">
        <img src="/img/footer.png" alt="" class="mb-4">
        <p>
            Help
            Call: (055) 126-0021
            Email: help@gyeongnam.garden
            Address: 경남 함양군 서성면 가르내길 202-1 (우 50002)
        </p>
        <p class="copyright">
            Copyright
            Copyright (c) 2021 ~ 2022 Gyeongnam Garden. All rights reserved.
        </p>
    </div>
</footer>
</body>
</html>
