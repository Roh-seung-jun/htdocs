<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('./resources/css/bootstrap.css')}}">
    <style>
        .star {
            position: relative;
            font-size: 2rem;
            color: #ddd;
        }

        .star input {
            width: 100%;
            height: 100%;
            position: absolute;
            left: 0;
            opacity: 0;
            cursor: pointer;
        }

        .star span {
            width: 0;
            position: absolute;
            left: 0;
            color: red;
            overflow: hidden;
            pointer-events: none;
        }
    </style>
    <script src="{{asset('./resources/js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('./resources/js/modal.js')}}"></script>
    <script>
        $(() =>{
            $(document)
            .on('click','.plus',function(){
                const text = `
                    <input type="file" name="photo" class="form-control-file picture w-25" accept=".jpg">
                `;
                $(`.photo`).append(text);
            })
            .on('click','.submit',function(){
                const name = $('input[name="name"]').val();
                const item = $('input[name="item"]').val();
                const pro_item = $('input[name="pro_item"]').val();
                const date = $('input[name="date"]').val();
                const area = $('textarea[name="contents"]').val();
                const star = $('input[name="star"]').val();
                if(name < 2)return alert('이름은 2자 이상입니다.');
                if(name > 50)return alert('이름은 50자 이하입니다.');
                if(area < 100)return alert('내용은 100자 이상이여야 합니다.');

                return alert('구매후기가 등록되었습니다.');
            })
            .on('mousemove','.star',function(e){
                $(this).val(Math.floor(e.offsetX / 15));
                document.querySelector(`.star span`).style.width = `${this.value * 10}%`;
            })
        })

    </script>
</head>
<body>
<form action="">

이름
<input type="text" name="name" class="form-control" required>
구매품
<input type="text" name="item" class="form-control" required>
구매처
<input type="text" name="pro_item" class="form-control" required>
구매일
<input type="date" name="date" class="form-control" required>
내용
<textarea name="contents" id="area" cols="30" rows="10" class="form-control" required></textarea>
    <span class="star">
  ★★★★★
  <span>★★★★★</span>
  <input type="range" value="1" step="1" min="0" max="10" name="star" class="star">
</span>
<div class="photo">

사진
<input type="file" name="photo" class="form-control-file picture w-25" accept=".jpg">
</div>

<button class="btn btn-primary plus">사진 추가</button>
<button class="btn btn-primary submit">등록</button>
</form>
</body>
</html>
