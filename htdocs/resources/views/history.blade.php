@extends('header')
@section('script')
    <script>
        $(async ()=>{
            $(document)
                .on('mousemove','.star input',_change)
                .on('click','.btn_select',function(){
                    $(this).hasClass('active') ? $(this).removeClass('active') : $(this).addClass('active');
                })
            let text = (await fetch('/tag.txt').then(res=>res.text())).split(' ').join('').split(',');
            text = text.reduce((acc,cur)=>{
                acc += `<button class="btn btn-outline-success m-1 btn_select" type="button">${cur.replace('/r/n','')}</button>`
                return acc;
            },'');

            $('.tag_list').html(text);
        })

        function _change(){
            $(`.star span`)[0].style.width = `${this.value * 10}%`;
        }
    </script>
@endsection
@section('contents')

    <section id="list" class="sub_section">
        <div class="container">
            @if(auth()->user()->type !== 'garden')
            <h1 class="sub">My Calendar</h1>
            <table class="text-center table mt-5">
                <thead>
                <tr class="">
                    <th>정원명</th>
                    <th>날짜</th>
                    <th>인원</th>
                    <th>결제금액</th>
                    <th>예약취소</th>
                    <th>입장권</th>
                </tr>
                </thead>
                <tbody>
                @foreach(auth()->user()->calendar() as $item)
                <tr>
                    <td>{{$item->garden->name}}</td>
                    <td>{{$item['start_date']}} - {{$item['end_date']}}</td>
                    <td>{{$item['people']}}</td>
                    <td>{{$item['price']}}</td>
                    <td>
                        @if($item['state'] !== 'cancel')
                        @if(((new DateTime($item['start_date']))->diff(new DateTime(date('Y-m-d'))))->days > 7)
                            <button class="btn btn-outline-success" onclick="location.href='{{route('cancel',$item['id'])}}'">취소하기</button>
                            @else
                            <button class="btn btn-outline-success" onclick="return alert('방문 6일전부터는 취소가 불가능합니다.')">취소하기</button>
                        @endif
                        @else
                        취소 완료
                            @endif
                    </td>
                    <td> <button class="btn btn-outline-success">입장권 발급</button></td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="6" class="text-left"><h1 class="sub">My History</h1></td>
                </tr>
                <tr class="font-weight-bold">
                    <td>정원명</td>
                    <td>날짜</td>
                    <td>인원</td>
                    <td>결제금액</td>
                    <td>상태</td>
                    <td>후기작성</td>
                </tr>

                @foreach(auth()->user()->history() as $item)
                    @if(!$item->review)
                    <tr>
                        <td>{{$item->garden->name}}</td>
                        <td>{{$item['start_date']}} - {{$item['end_date']}}</td>
                        <td>{{$item['people']}}</td>
                        <td>{{$item['price']}}</td>
                        <td>
                            @if($item['state'] !== 'cancel')
                                방문
                            @else
                                취소
                            @endif
                        </td>
                        <td> <button class="btn btn-outline-success" data-target="#modal_{{$item['id']}}" data-toggle="modal" >후기 작성</button>
                            <div class="modal" id="modal_{{$item['id']}}">
                                <div class="modal-dialog">
                                    <form class="modal-content" enctype="multipart/form-data" method="post" action="{{route('review',['garden_id'=>$item->garden->name,'calendar_id'=>$item['id']])}}">
                                        @csrf
                                        <div class="modal-header">
                                            <h3 class="modal-title">후기 작성</h3>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <p>내용</p>
                                                <input type="text" class="form-control" name="contents">
                                            </div>
                                            <div class="form-group">
                                                <p>사진</p>
                                                <input type="file" multiple class="form-control-file" name="file[]">
                                            </div>
                                                <p>별점</p>
                                                <span class="star position-relative" style="font-size: 2rem;color: #ccc;">
                                                    ★★★★★
                                                    <span style="width: 0;left: 0;overflow: hidden;pointer-events: none;color: #2fad55" class="position-absolute">★★★★★</span>
                                                    <input name="score" type="range" min="0" max="10" step="1" value="1" style="width: 100%;height: 100%;left: 0;opacity: 0;cursor:pointer;" class="position-absolute">
                                                </span>
                                            <div class="tag_list d-flex flex-wrap">

                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-outline-success submit_{{$item['id']}}">작성하기</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
            @else
                <h1 class="sub">My Garden Calendar</h1>
                <table class="text-center table mt-5">
                    <thead>
                    <tr class="">
                        <th>날짜</th>
                        <th>인원</th>
                        <th>결제금액</th>
                        <th>취소</th>
                        <th>상태</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach(auth()->user()->admin->_list as $item)
                        <tr>
                            <td>{{$item['start_date']}} - {{$item['end_date']}}</td>
                            <td>{{$item['people']}}</td>
                            <td>{{$item['price']}}</td>
                            <td>
                                @if($item['state'] == 'cancel')
                                    <button class="btn btn-outline-success" onclick="return alert('이미 취소된 일정입니다.')">취소하기</button>
                                @elseif($item['end_date'] < date('Y-m-d'))
                                    <button class="btn btn-outline-success" onclick="return alert('이미 방문한 일정입니다.')">취소하기</button>
                                @else
                                    <button class="btn btn-outline-success" onclick="location.href='{{route('cancel',$item['id'])}}'">취소하기</button>
                                @endif
                            </td>
                            <td>
                                @if($item['state'] == 'cancel')
                                    취소
                                @elseif($item['end_date'] < date('Y-m-d'))
                                    방문
                                @else
                                    예약
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            <h1 class="sub">Setting Calendar</h1>
            <form class="form-group" method="post" action="{{route('setting')}}">
                @csrf
                <input type="date" class="form-control" name="date">
                <button class="btn btn-outline-success">수정</button>
            </form>
                <table class="table">
                    <thead>
                    <tr>
                    <th>일정</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach(auth()->user()->admin->disable as $item)
                    <tr>
                        <td>{{$item['date']}}</td>
                    </tr>
                    </tbody>
                    @endforeach
                </table>
            @endif
        </div>
    </section>
@endsection
