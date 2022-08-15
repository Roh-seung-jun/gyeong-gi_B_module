@extends('header')




@section('contents')
    <section id="list">
        <div class="container">
            <div class="d-flex justify-content-between align-items-end">
                <h1 class="sub"><b>Garden</b> List</h1>
                <input type="radio" name="radio" class="d-none" id="tag_1">
                <input type="radio" name="radio" class="d-none" id="tag_2">
                <input type="radio" name="radio" class="d-none" id="tag_3">
                <img src="./img/05.png" alt="">
                <div class="btn-group h-50 mb-3">
                    <label for="tag_1" class="btn-outline-success btn tag_1">예약</label>
                    <label for="tag_2" class="btn-outline-success btn tag_2">리뷰</label>
                    <label for="tag_3" class="btn-outline-success btn tag_3">별점</label>
                </div>
            </div>
            <div class="d-flex justify-content-start flex-wrap mt-3">
                @foreach($data as $item)
                <a href="{{route('garden',$item['id'])}}" class="box mt-5">
                    <img src="./garden/{{$item['name']}}1.jpg" alt="">
                    <h3 class="font-weight-bold mt-3">{{$item['name']}}</h3>
                    <p>Tel) {{$item['phone']}}</p>
                    <p>주소 :{{$item['address']}}</p>
                </a>
                @endforeach
            </div>
        </div>
    </section>
@endsection
