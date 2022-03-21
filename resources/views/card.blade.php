<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{asset('./resources/css/bootstrap.css')}}">
    <style>
        *{margin: 0;padding: 0;box-sizing: border-box;}

        .card{transform-style: preserve-3d;transition:all 1s;perspective: 100rem;margin: 30px;}

        .front{transform: rotateY(0deg);background-color: blue;width: 200px;height: 300px;backface-visibility: hidden;}
        .back{transform: rotateY(180deg);font-size:10rem;background-color: green;width: 200px;height: 300px;backface-visibility: hidden;}

        .change{transform: rotateY(180deg);}

        .end{transform: rotateY(180deg); border:4px solid red;}
    </style>
    <script src="{{asset('./resources/js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('./resources/js/modal.js')}}"></script>
    <script>
        let card = [
            1,2,3,4,5,6,7,8,9,10
        ];

        select = [];
        removeELe = null;
        clickAble = false;
        cnt = 0;

        const reload = (end = false) =>{
            card = [
                1,2,3,4,5,6,7,8,9,10
            ];


            select = [];
            removeELe = null;
            clickAble = false;
            cnt = 0;
            cardSelect = setting();
            const text = onText();
            $('.list').html(text);
            if(!end){
                setCard();
            }
        }

        $(()=>{

            @if(session()->has('msg'))
            alert( '{{ session()->get('msg')}}' );
            @endif
            cardSelect = setting();
            const text = onText();
            $('.list').html(text);

            $(document)
            .on('click','.start',function(){
                let time = 90;
                setTimeout(() => {
                    timeAttack= setInterval(()=>{
                        $('.m').html(time);
                        time--;
                        console.log('a');
                        if(time === 0) {
                            clearInterval(timeAttack);
                            alert('게임이 종료되었습니다.');
                            clickAble = false;
                            endgame();
                        }
                    },1000);
                },5000);

                setCard();
                $(this).css('display','none');
                $('.reload').css('display','block');
            })
                .on('click','#post_ph',function(){
                    const input = $('#post_phone').val();
                    $.ajax({
                        url : `/event/${input}/stamps`,
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data : {
                            phone : input
                        },
                        type:'post',
                        success:function(data){
                            alert(data);
                        }
                    })
                })
            .on('click','#submit',function(){
                let name = $('#name').val();
                if(name.length < 2 || name.length > 50)return alert('이름은 2자와 50자 이내입니다.')
                const regex = /^[ㄱ-ㅎ|가-힣|a-z|A-Z|]+$/;
                if(!regex.test(name))return alert('이름은 한글과 영문만 가능합니다.');
                // const regPhone = /^01([0|1|6|7|8|9])-?([0-9]{3,4})-?([0-9]{4})$/;
                // let phone = $('#phone').val();
                // if (!regPhone.test(phone)) {
                //     return alert('휴대전화 형태로만 입력 가능합니다.');
                // }

                $('#post').click();
                let stamp = `
                <div class="stamp text-center" style="background-color: #0f6674;border-radius: 50%;color: #fff;">
                <h1>출석 완료!</h1>
</div>`;

            })
            .on('keydown onpaste','#phone',function(){
                let text = $('#phone').val().split('-').join('');
                let val = '';
                for (let i = 0; i < text.length;i++){
                    if(text[i] === undefined)return;
                    if( i === 3 || i === 7 ){
                        val += '-';
                    }
                    val += text[i];
                }
                $('#phone').val(val);
            })
            .on('click','.chance',function(){
                setCard(3000);
            })
            .on('click','.reload',function(){
                reload();
            })
            .on('click','.card',function(){
                if(!clickAble)return;
                if(this === removeELe) return;
                this.classList.add('change');
                select.push($(this).attr('data-idx'));
                if(select[0] === select[1]){
                    removeELe.classList.add('end');
                    cnt++;
                    $('.cnt').html(cnt);
                    if(cnt === 8){
                        alert('게임이 종료되었습니다.');
                        endgame();
                    }
                    this.classList.add('end');
                }

                if(select.length === 1){
                    removeELe = this;
                    setTimeout(()=>{
                        if(select.length !== 2){
                            this.classList.remove('change');
                            select = [];
                        }
                    },3000);
                }

                if(select.length === 2 && select[0] !== select[1]){
                    clickAble = false;
                    setTimeout(()=>{
                        removeELe.classList.remove('change');
                        this.classList.remove('change');
                        $(`div[data-idx="${select[0]}"]`).removeClass('change');
                        removeELe = null;
                        clickAble = true;
                    },1000)
                }

                if(select.length === 2){
                    select = [];
                }

            })

        })

        const setCard = (endTime = 6000) => {
            const Cards = document.querySelectorAll(".card");
            clickAble = false;
            Cards.forEach((e,i)=>{
                setTimeout(()=>{
                    e.classList.add('change');
                },1000 + 100 * i);
            })

            Cards.forEach((e,i)=>{
                setTimeout(()=>{
                    e.classList.remove('change');
                    clickAble = true;
                },endTime + 100 * i);
            })
        }

        const setting = () => {
            let arr = [];
            for(var i = 0; i < 8;i++){
                let idx = Math.floor(Math.random() * card.length);
                arr.push(card[idx],card[idx]);
                card.splice(idx,1);
            }
            let save = []
            for (let i = 0; arr.length > 0; i++) {
                save = save.concat(
                    arr.splice(Math.floor(Math.random() * arr.length), 1)
                );
            }
            return save;
        }

        const onText = () => {
            let text = '';
            cardSelect.forEach((e)=>{
                text += `<div data-idx="${e}" class="position-relative card" style="width: 200px; height: 300px" data-id="e">
                            <div class="position-absolute front"> card front</div>
                            <div class="position-absolute back" > ${e}</div>
                        </div>`;
            });
            return text;
        }

        const endgame = () => {
            clearInterval(timeAttack);
            $('#cnt').val(cnt);
            $('.form').css('display','block');
        }
    </script>
</head>
<body class="">


<div class="list d-flex flex-wrap" style="width: 1100px;">
</div>
<div class="d-flex">
    <button class="btn btn-primary start">게임시작</button>
    <button class="btn btn-primary reload" style="display: none">다시시작</button>
    <button class="btn btn-primary chance">힌트보기</button>
</div>
<div class="time">
    <p>개수</p>
    <p class="cnt">0</p>
    <p class="m">00</p>
    <p>초</p>
</div>
<form action="{{route('event.check')}}" class="form" style="display: none" method="post">
@csrf
        이름
        <input type="text" name="name" class="form-control" id="name" value="승준">
        핸드폰
        <input type="text" name="phone" class="form-control" id="phone" value="010-3280-1651">
        찾은 개수
        <input type="number" readonly class="form-control" name="score" id="cnt" value="3">
    <button class="btn btn-primary" id="post" type="submit">등록</button>
</form>
<button class="btn btn-primary" id="submit">등록</button>
<input type="text" name="phone" class="form-control" placeholder="휴대번호를 입력하세요" id="post_phone">
<button class="btn btn-primary" id="post_ph">조회</button>
</body>
</html>
