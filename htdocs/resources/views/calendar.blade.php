@extends('header')


@section('script')
    <script>

        $(()=>{
            $(document)
            .on('click','.test',check)
            .on('change input','#start, #end,#people',reset)
        })

        function reset(){
            $('.submit').attr('type','button').addClass('disabled');
        }
        function check(){
            let start = $('#start').val();
            let end = $('#end').val();
            let people = $('#people').val();
            let id = '{{$data['garden']['id']}}';
            if(!start || !end | !people) return alert('날짜와 인원을 입력해주세요');
            $.ajax({
                url : '{{route('check')}}',
                method : 'post',
                data : {
                    _token : '{{csrf_token()}}',
                    start,
                    end,
                    id
                },
                success:function(e){
                    if(isNaN(parseInt(e)))return alert(e);
                    let price = parseInt(people) * parseInt(e) * 1000;
                    $('#price').val(price);
                    $('.submit').attr('type','submit').removeClass('disabled');
                }
            })
        }
    </script>
@endsection

@section('contents')
    <section id="list" class="sub_section">
        <form action="{{route('makeCalendar',['garden_id'=>$data['garden']['id']])}}" method="post" class="container">
            @csrf
            <p>시작일</p>
            <input type="date" class="form-control" name="start_date" id="start">
            <p>마감일</p>
            <input type="date" class="form-control" name="end_date" id="end">
            <p>인원 수</p>
            <input type="number" class="form-control" name="people" id="people">
            <button class="btn btn-outline-success test" type="button">신청여부 확인</button>
            <input type="text" disabled class="form-control" name="price" id="price">
            <button class="btn btn-outline-success submit" type="button">신청하기</button>
        </form>
    </section>
@endsection
