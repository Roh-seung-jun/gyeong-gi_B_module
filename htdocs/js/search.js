$(async () => {
    window.json = (await fetch('./json/garden.json').then(res => res.json())).gardens;
    window.garden = [];
    window.tag = [];

    console.log(window.json);
    let arr = window.json.reduce((acc, cur) => {
        acc.push(...cur.themes);
        acc = [...new Set(acc)];
        return acc;
    }, []);

    let garden_list = window.json.reduce((acc, cur) => {
        acc += `
            <div href="#" class="box mt-5 ${cur.themes.join(' ')}">
                <img src="./garden/${cur.name}1.jpg" alt="">
                <h3 class="font-weight-bold mt-3">${cur.name}</h3>
                <p>Tel) ${cur.phone}</p>
                <p>주소 ${cur.address}</p>
                <p>#${cur.themes.join(' #')}</p>
            </div>`
        return acc;
    }, '')

    let tag = arr.reduce((acc, cur) => {
        acc += `<button class="btn btn-outline-success m-1 tag" data-id="${cur}">#${cur}</button>`
        return acc;
    }, '');

    $('.tag_list').html(tag);
    $('.garden_list').html(garden_list)

    $(document)
        .on('click', '.tag', selectTag)
        .on('keyup', '#search', view)
})

function selectTag() {
    $(this).hasClass('active') ? $(this).removeClass('active') : $(this).addClass('active');

    window.tag = [];
    $('.tag.active').each((idx, item) => {
        window.tag.push($(item).attr('data-id'));
    });

    view();
}

function search() {
    let data = [];
    let val = $('#search').val();
    let valcho = cho(val);

    window.json.forEach((e) => {
        let garden = Object.assign({}, e);
        let garden_cho = cho(e.name);
        let str = [];
        let garden_name = garden.name.split('');

        for (let i in garden_cho) {
            let idx = garden_cho.indexOf(valcho, i);
            if (idx !== -1 && str.indexOf(idx) === -1) str.push(idx);
        }

        let check = false;

        str.forEach(idx => {
            let cho = valcho.split('');
            for (let i in val) {
                if (val[i].charCodeAt() - 44032 >= 0) cho[i] = garden_name[idx + i * 1];
            }

            if (cho.join('') === val) {
                check = true;
                for (let i = idx; i < idx + val.length; i++) {
                    garden_name[i] = `<span style="background-color: #2fad55; color: #fff;">${garden_name[i]}</span>`;
                }
            }
        })
        e.searchName = garden_name.join('');

        let t = [...garden.themes];
        let themes = true;

        window.tag.forEach(theme => {
            if (!e.themes.includes(theme)) themes = false;
            else t[e.themes.indexOf(theme)] = `<span style="background-color: #2fad55; color: #fff;">${t[e.themes.indexOf(theme)]}</span>`;
        });

        e.tag_list = t;

        if (val.length === 0 && window.tag.length > 0) check = false;
        if (val.length !== 0 && window.tag.length === 0) themes = false;

        if (check || themes) {
            data.push(e);
        }
    })
    return data;
}

function cho(str) {
    let answer = '';
    let cho = ['ㄱ', 'ㄲ', 'ㄴ', 'ㄷ', 'ㄸ', 'ㄹ', 'ㅁ', 'ㅂ', 'ㅃ', 'ㅅ', 'ㅆ', 'ㅇ', 'ㅈ', 'ㅉ', 'ㅊ', 'ㅋ', 'ㅌ', 'ㅍ', 'ㅎ'];
    for (let i in str) {
        let code = Math.floor((str[i].charCodeAt() - 44032) / 588);
        answer += code >= 0 ? cho[code] : str[i];
    }
    return answer;
}

function view() {
    console.log(window.tag);
    let data = search();
    let text = data.reduce((acc, cur) => {
        acc += `
            <div href="#" class="box mt-5">
                <img src="./garden/${cur.name}1.jpg" alt="">
                <h3 class="font-weight-bold mt-3">${cur.searchName}</h3>
                <p>Tel) ${cur.phone}</p>
                <p>주소 ${cur.address}</p>
                <p>#${cur.tag_list.join(' #')}</p>
            </div>`
        return acc;
    }, '')
    $('.garden_list').html(text);
}
