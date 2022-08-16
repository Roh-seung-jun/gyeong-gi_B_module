$(async ()=> {
    if (!localStorage.arr) {
        localStorage.arr = [];
    }

    window.data = (await fetch('./data/reserve.json').then(res => res.json())).data;

    $(document)
        .on('click','.next',_check)
        .on('click','.hide',hide)
        .on('click','.save',save)

})

function save(){
    $('header,#visual,footer,.btn').css('display','none');
    window.print();
    $('header,#visual,footer,.btn').css('display','block');
}
function hide(){
    $('.modal').modal('hide');
}

function _check(){
    let arr = JSON.parse(localStorage.arr);
    let type = $(this).attr('data-id');

    let obj;
    if (type === 'phone'){
        let phone = $('#_phone').val();
        let pw = $('#_pw').val();
        obj = arr.reduce((acc,cur)=>{
            if(cur.phone === phone && pw === cur.pw){
                acc.push(cur);
            }
            return acc;
        },[]);
    }else{
        let number = $('#_number').val();
        let name = $('#_name').val();
        let birth = $('#_birth').val();
        obj = arr.reduce((acc,cur)=>{
            if(cur.birth === birth && name === cur.name && cur.number === number){
                acc.push(cur);
            }
            return acc;
        },[]);
    }
    hide();
    if( obj.length === 0) return alert('조회된 정보가 없습니다.');

    let text = obj.reduce((acc,cur)=>{
        acc += `<div class="box">
                <h3>${cur.event}</h3>
                <p>${cur.date}</p>
                <p>원주민 : ${cur.people}</p>
                <p>소인 : ${cur.small}</p>
                <p>성인 : ${cur.adult}</p>
                <p>금액 : ${cur.price}</p>
            </div>`;
        return acc;
    },'');
    $('#sub_1 .list').html(text);
}

// people,
//     small,
//     adult,
//     price,
//     date