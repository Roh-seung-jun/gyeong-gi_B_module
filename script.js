$(async ()=>{
    if(!localStorage.arr){
        localStorage.arr = [];
    }
    window.data = (await fetch('./data/reserve.json').then(res=>res.json())).data;

    let text = window.data.reduce((acc,cur)=>{
        acc += `<div class="box mt-3" style="width: 32%;margin-right: 1%;height: 450px;overflow: hidden" data-target="#type" data-toggle="modal" data-id="${cur.creator}" data-date="${cur.period}" data-img="${cur.Image}">
                <img src="./image/${cur.Image}" alt="" style="width: 100%;height: 300px;">
                <h3 class="font-weight-bold">${cur.parkName}</h3>
                <p class="m-0">${cur.category}</p>
                <p class="m-0">${cur.creator}</p>
                <p class="m-0">${cur.period}</p>
            </div>`
        return acc;
    },'')


    let good = window.data.reduce((acc,cur)=>{
        if(cur.category === '인기체험관' || cur.category === '추천체험관'){
        acc += `<div class="box mt-3" style="width: 32%;margin-right: 1%;height: 450px;overflow: hidden" data-target="#type" data-toggle="modal" data-id="${cur.creator}" data-date="${cur.period}" data-img="${cur.Image}">
                <img src="./image/${cur.Image}" alt="" style="width: 100%;height: 300px;">
                <h3 class="font-weight-bold">${cur.parkName}</h3>
                <p class="m-0">${cur.category}</p>
                <p class="m-0">${cur.creator}</p>
                <p class="m-0">${cur.period}</p>
            </div>`
        }
        return acc;
    },'')

    $('#sub_1 .list').html(text);
    $('#sub_1 .good_list').html(good);

    $(document)
        .on('click','#sub_1 .box',_select)
        .on('click','.hide',hide)
        .on('click','#type button',_type)
        .on('click','.next',_check)
        .on('click','.plus,.minus',_change)
        .on('input','#_view .input',_max)
        .on('click','#_view .end',_end)
        .on('click','.modal_img',_image)
})

function _image(){
    let image = this.src;
    $('#image .modal-body').html(
        `<img class="" src="./image/${window.img}" style="width: 400px;height: 400px;">`
    );
}


function _end(){
    let people = $('#_people').val();
    let small = $('#_small').val();
    let adult = $('#_adult').val();
    let date = $('#_date').val();
    let price = $('#_price').val();
    if(!people||!small||!adult||!date||!price)return alert('모든정보는 필수값입니다.');

    let obj = {
        people,
        small,
        adult,
        price,
        date,
        event: window.select,
    }
    if(window.type === 'phone'){
        obj['phone'] = $('#_phone').val();
        obj['pw'] = $('#_pw').val();
    }else{
        obj['birth'] = $('#_birth').val();
        obj['name'] = $('#_name').val();
        obj['number'] = $('#_number').val();
    }
    let arr = [];
    if(localStorage.arr){
        arr = JSON.parse(localStorage.arr);
    }
    arr.push(obj);
    localStorage.arr = JSON.stringify(arr);
    return alert('정상적으로 예약이 완료되었습니다.');
}


function _calc(){
    let people = parseInt($('#_people').val());
    let small = parseInt($('#_small').val());
    let adult = parseInt($('#_adult').val());

    let answer = adult * 1000 + small * 500 + people * 300;
    $('#_price').val(answer);
}

function _max(e = null){
    let that = this;
    if(e !== null){
        that = $(`#${e}`)[0];
    }
    if(parseInt($(that).val()) > 6){
        that.value = 6;
        return alert('최대 6명까지 가능합니다.');
    }
    _calc();
}

function _change(){
    let data = $(this).attr('data-id');
    let type = $(this).hasClass('plus') ? 1 : -1;
    $(`#${data}`).val(parseInt($(`#${data}`).val()) + type)
    _max(data);
}

function _check(){
    let check = true;
    $(`#${window.type} input`).each((idx,item)=>{
        if($(item).val() === '')check = false;
    })
    if(window.type === 'number'){
        if($('#_pw').val() !== $('#_pwcheck').val()){
            return alert('비밀번호를 확인해주세요');
        }
    }
    if(!check)return alert('모든 정보를 입력해주세요.');
    hide();
    $('#_view').modal('show');
    $('#_view .img_list').html(`
    <img class="modal_img" src="./image/${window.img}" style="width: 100px;height: 100px;" data-toggle="modal" data-target="#image">
    <img class="modal_img" src="./image/${window.img}" style="width: 100px;height: 100px;" data-toggle="modal" data-target="#image">
    <img class="modal_img" src="./image/${window.img}" style="width: 100px;height: 100px;" data-toggle="modal" data-target="#image">
`);
}

function _type(){
    window.type = $(this).attr('data-id');
}

function hide(){
    $('.modal').modal('hide');
}

function _select(){
    window.select = $(this).attr('data-id');
    window.date = $(this).attr('data-date');
    window.img = $(this).attr('data-img');
}

