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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-modal/2.2.6/js/bootstrap-modalmanager.min.js"></script>
    <script>
        $(window).scroll(function(){
            let scroll = $(window).scrollTop();
            if(scroll === $(document).height() - $(window).height()){
                page++;
                $.ajax({
                    url : '/review/plus',
                    data : {
                        page,
                        _token : '{{csrf_token()}}'
                    },
                    type : 'POST',
                    success : function(res){
                        res.data.forEach(e=>{
                            let text =`
                            <tr class="view_modal" data-idx="${e.id}" style="height: 100px">
                                <td>${e.id}</td>
                                <td>${e.name}</td>
                                <td>${e.product}</td>
                                <td>${e.shop}</td>
                                <td>${e['purchase-date']}</td>
                                <td>${e.contents.substr(0,50)}</td>
                                <td>${e.score}</td>
                            </tr>`;
                            $('tbody').append(text);

                        })
                    },
                })
            }
        })
        page = 1;
        function openModal(e){
            $('#staticBackdrop').show();
        }
        function closeModal(){
            $('#staticBackdrop').hide();
        }
        $(document)
        .on('mousemove','.star',function(e){
            $(this).val(Math.floor(e.offsetX / 15));
            document.querySelector(`.star span`).style.width = `${this.value * 10}%`;
        })
        .on('click','.view_modal',function(){
            const id = $(this).attr('data-idx');
        })
        .on('click','.add_photo',async function(){

            const text = `<input type="file" name="file" class="form-control file_input" accept=".jpg">`;
            $('.file_div').append(text);

        })
        .on('click','button.file',async function(e){
            const arr = document.querySelectorAll('.file_input');
            let files = [];
            for(let i = 0; i < arr.length; i++){
                const reader = await readFile(arr[i].files[0]);
                const img = await $(`<img src="${reader.result}">`)[0];
                const base = imgCanvas(img);
                files.push(base);
            }
            const name = $('.name_input').val();
            const product = $('.product_input').val();
            const shop = $('.shop_input').val();
            const purchase = $('.purchase-date_input').val();
            const score = $('.score_input').val();
            const contents = $('.contents_input').val();
            $.ajax({
                url : '{{route('review.store')}}',
                type : 'POST',
                data : {
                    file : files,
                    name,
                    product,
                    shop,
                    'purchase-date' :purchase,
                    score,
                    contents
                },
                datatype : 'json',
                headers : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function(res){
                    console.log(res);
                },
                error:function(request,status,error){
                    alert("code = "+ request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                },
            })
            location.reload();
        })

        const imgCanvas = (img) => {
            const canvas = $('<canvas>')[0];
            const ctx = canvas.getContext('2d');
            canvas.width = 450;
            canvas.height = 450;
            ctx.drawImage(img,0,0,450,450);
            ctx.font = '18px serif';
            ctx.textAlign = 'center';
            ctx.textBaseline = 'center';
            ctx.fillStyle = 'rgba(0,0,0,.5)';
            ctx.fillText('경상남도 특산품',225,225);
            return canvas.toDataURL();
        }

        const readFile = (file) => {
            return new Promise((res) => {
                const reader = new FileReader()
                reader.onload = () => {
                      res(reader);
                }
                reader.readAsDataURL(file);
            });
        }


    </script>
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
</head>
<body><!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop" onclick="openModal(this)">
    구매후기 작성
</button>
<!-- Modal -->
<div class="modal" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="POST" enctype="multipart/form-data">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <p>이름</p>
                    <input type="text" name="name" class="form-control name_input" required>
                </div>
                <div class="form-group">
                    <p>구매품</p>
                    <input type="text" name="product" class="form-control product_input" required>
                </div>
                <div class="form-group">
                    <p>별점</p>
                    <span class="star">
  ★★★★★
  <span>★★★★★</span>
  <input type="range" value="1" step="1" min="0" max="10" name="score" class="star score_input" required>
</span>
                </div>
                <div class="form-group">
                    <p>구매처</p>
                    <input type="text" name="shop" class="form-control shop_input" required>
                </div>

                <div class="form-group">
                    <p>구매일</p>
                    <input type="date" name="purchase-date" class="form-control purchase-date_input" required>
                </div>

                <div class="form-group">
                    <p>내용</p>
                    <textarea type="text" name="contents" class="form-control contents_input" required></textarea>
                </div>
                <div class="form-group file_div">
                    <input type="file" name="file" class="form-control file_input" accept=".jpg" id="file" required>
                </div>
                <div><button type="button" class="btn btn-primary add_photo">사진 추가하기</button></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeModal()">Close</button>
                <button type="button" class="btn btn-primary file">후기 등록</button>
            </div>
            </form>
        </div>
    </div>
</div>
<table class="table">
    <thead>
    <tr>
        <th>글 번호</th>
        <th>작성자</th>
        <th>구매품</th>
        <th>구매처</th>
        <th>구매일</th>
        <th>내용</th>
        <th>별점</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data['list'] as $idx => $list)
    <tr class="view_modal" data-idx="{{$list['id']}}" style="height: 100px">
        <td>{{$list['id']}}</td>
        <td>{{$list['name']}}</td>
        <td>{{$list['product']}}</td>
        <td>{{$list['shop']}}</td>
        <td>{{$list['purchase-date']}}</td>
        <td>{{substr($list['contents'],1,50)}}</td>
        <td>{{$list['score']}}</td>
    </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
