$(async ()=>{
    window.json = (await fetch('../../json/garden.json').then(res => res.json())).gardens;
    window.down = false;
    window.x = 0;
    window.y = 0;
    console.log(window.json);
    let text = window.json.reduce((acc,cur)=>{
        acc += `<option value="${cur.name}" class="${cur.name}">${cur.name}</option>`
        return acc;
    },'');

    let map =  window.json.reduce((acc,cur)=>{
        let top = (cur.latitude - 34.7100) / (35.9255 - 34.7100) * 100;
        let left = (cur.longitude - 127.5718) / (129.2097 - 127.5718) * 100;
        acc += `<div class="position-absolute asd ${cur.name}" style="top:${top}%;left: ${left}%; width: 20px;height: 20px;background-color: #ccc;"></div>`;
        return acc;
    },'');

    //34.7100 ~ 최대 35.9255
    //최소 127.5718 ~ 최대 129.2097
    $('#select').append(text);
    $('.point').append(map);
    $(document)
        .on('change','#select',select)
        .on('click','.pano_btn',view)
        .on('click','.move',move)
        .on('click','._close',close)
        .on('keydown',function (e){
            window.y -= e.keyCode === 38 ? -2 : e.keyCode === 40 ?  2 :0;
            window.x += e.keyCode === 37 ? -2 : e.keyCode === 39 ?  2 :0;

            window.y = window.y > 90 ? 90 : window.y < -90 ? -90 : window.y;
            $('._box').css('transform',`translateZ(var(--center)) rotateX(${window.y}deg) rotateY(${window.x}deg)`);
        })
        .on('mousedown','.wrap',function (){
            window.down = true;
            $('.wrap').css('cursor','grabbing');
        })
        .on('mousemove','.wrap',function(e){
            if(!window.down) return;

            window.x -= e.originalEvent.movementX / (screen.width/ 180);
            window.y += e.originalEvent.movementY / (screen.height/ 180);
            window.y = window.y > 90 ? 90 : window.y < -90 ? -90 : window.y;

            $('._box').css('transform',`translateZ(var(--center)) rotateX(${window.y}deg) rotateY(${window.x}deg)`);
        })
        .on('mouseup','.wrap',function(){
            window.down = false;
            $('.wrap').css('cursor','grab');
        })
})

function close(){
    $('.wrap').css('opacity','0');
    setTimeout(()=>{
        $('.pano').addClass('d-none').removeClass('d-flex');
    },500)
}

function move(){
    $('img').fadeOut(2000);
    setTimeout(()=>{
        $('.one').hasClass('d-none') ? $('.one').removeClass('d-none') : $('.one').addClass('d-none');
        $('.two').hasClass('d-none') ? $('.two').removeClass('d-none') : $('.two').addClass('d-none');
        $('img').fadeIn(2000);
    },3000)
}

function view(){
    $('.pano').removeClass('d-none').addClass('d-flex');
    $('.wrap').css('opacity','1');

}


function select(){
    $(`.asd`).removeClass('active');
    $(`option`).removeClass('active');
    $(`.${this.value}`).addClass('active');
    let find = window.json.find(e=>e.name === this.value);

    $('.data').html(`<img src="./garden/${find.name}1.jpg" alt="" style="width: 200px;height: 200px;"> <h3>${find.name}</h3> <p>별점 : ${find.score}</p> <p>${find.phone}</p> <p>${find.address}</p> <div class="d-flex"> <button class="m-1 btn btn-outline-success">리뷰바로가기</button> <button class="m-1 btn btn-outline-success">예약바로가기</button> <button class="m-1 btn btn-outline-success pano_btn">파노라마</button> </div>`);
}
