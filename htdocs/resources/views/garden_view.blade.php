@extends('header')

@section('script')
    @endsection
<style>
    :root{
        --width: 1924px;
        --height: 1140px;
        --center : calc(1924px / 4)
    }

    *{
        -webkit-user-drag: none;
        -webkit-user-select: none;}
    .wrap{
        transition: .4s;
        top: 0;
        z-index: 99;
        overflow: hidden;
        cursor: grab;
        perspective: calc(var(--center));
        background-color: #0b2e13;
    }

    ._box{
        opacity: 1;
        width: 0;
        height: 0;
        transform-style: preserve-3d;
        transform: translateZ(var(--center));
    }
    .since{
        width: var(--width);
        height: var(--height);
        position: absolute;
        margin-left: calc(var(--width)/ -2);
        margin-top: calc(var(--height)/ -2);
        backface-visibility: hidden;
        object-fit: cover;
    }

    .since.front{transform: translateZ(calc(var(--width) / -2 + 1px))}
    .since.back{transform: translateZ(calc(var(--width) / 2 - 1px)) rotateY(180deg)}
    .since.left{transform: translateX(calc(var(--width) / -2 + 1px)) rotateY(90deg)}
    .since.right{transform: translateX(calc(var(--width) / 2 - 1px)) rotateY(-90deg)}
</style>
<script src="{{asset('/jQuery/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('/js/script.js')}}"></script>
@section('contents')

    <div class="pano d-none position-fixed wrap w-100 justify-content-center align-items-center" style="height: 100vh">
        <div class="_box position-relative">
            <div class="one since front"><img class="w-100 h-100" src="/파노라마/location0/tile000.png" alt=""></div>
            <div class="one since back"><img class="w-100 h-100" src="/파노라마/location0/tile002.png" alt=""></div>
            <div class="one since left"><img class="w-100 h-100" src="/파노라마/location0/tile003.png" alt=""></div>
            <div class="one since right"><img class="w-100 h-100" src="/파노라마/location0/tile001.png" alt=""></div>

            <div class="two d-none since front"><img class="w-100 h-100" src="/파노라마/location1/tile000.png" alt=""></div>
            <div class="two d-none since back"><img class="w-100 h-100" src="/파노라마/location1/tile002.png" alt=""></div>
            <div class="two d-none since left"><img class="w-100 h-100" src="/파노라마/location1/tile003.png" alt=""></div>
            <div class="two d-none since right"><img class="w-100 h-100" src="/파노라마/location1/tile001.png" alt=""></div>

        </div>
        <button class="btn btn-success move" style="margin-top: 800px; z-index: 99;">이동하기</button>
        <button class="btn btn-success _close" style="margin-top: 800px; z-index: 99;">닫기</button>
    </div>
<section id="introduce">
    <div class="container">
        <h1 class="sub"><b>Garden</b> introduce</h1>
        <div class="d-flex justify-content-between align-items-end">
            <img src="/garden/{{$data['garden']['name']}}1.jpg" alt="" class="main_img">
            <div class="text text-left ml-5 w-25">
                <img src="/img/06.png" alt="">
                <h3>{{$data['garden']['name']}}</h3>
                <p>주소 : {{$data['garden']['address']}}</p>
                <p>연락처 : {{$data['garden']['phone']}}</p>
                <p>관리기관 : {{$data['garden']['management']}}</p>
                <p class="">정원소개 :{{$data['garden']['introduce']}}</p>
                <button class="btn btn-outline-success pano_btn">파노라마</button>
                <button class="btn btn-outline-success" onclick="location.href='{{route('calendar',$data['garden']['id'])}}'">예약바로가기</button>
            </div>
        </div>
    </div>
</section>

<section id="review">
    <div class="container">
        <div class="d-flex justify-content-between align-items-end">
            <h1 class="sub">Review</h1>
            <button class="btn btn-outline-success">작성</button>
        </div>
        <textarea name="contents" id="" cols="30" rows="5" placeholder="Write Review" class="form-control mt-3"></textarea>
        <div class="line"></div>
        <div class="review">
            <div class="box w-100 p-3 d-flex justify-content-between align-items-end mt-3">
                <div>
                    <p>물빛소리정원</p>
                    <h3>관리자님</h3>
                    <p>review contents (리뷰 내용)</p>
                    <p>방문날짜 : 2022-04-04</p>
                    <p>별점 : 3</p>
                </div>
                <div class="img_list d-flex">
                    <img src="./_img/1.jpg" alt="" class="m-1">
                    <img src="./_img/2.jpg" alt="" class="m-1">
                    <img src="./_img/3.jpg" alt="" class="m-1">
                    <img src="./_img/4.jpg" alt="" class="m-1">
                </div>
                <button class="btn btn-outline-success">자세히 보기</button>
            </div>

            <div class="box w-100 p-3 d-flex justify-content-between align-items-end mt-3">
                <div>
                    <p>물빛소리정원</p>
                    <h3>관리자님</h3>
                    <p>review contents (리뷰 내용)</p>
                    <p>방문날짜 : 2022-04-04</p>
                    <p>별점 : 3</p>
                </div>
                <div class="img_list d-flex">
                    <img src="./_img/1.jpg" alt="" class="m-1">
                    <img src="./_img/2.jpg" alt="" class="m-1">
                    <img src="./_img/3.jpg" alt="" class="m-1">
                    <img src="./_img/4.jpg" alt="" class="m-1">
                </div>
                <button class="btn btn-outline-success">자세히 보기</button>
            </div>
        </div>
    </div>

</section>
@endsection
