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
        .on('click','.add_photo',function(){
            const text = `<input type="file" name="file" class="form-control file_input" accept=".jpg">`;
            $('.file_div').append(text);
        })
        .on('change','#file',function(e){
            const img = readFile(e.target.files[0]);
            const canvas = showImg(img);
            console.log(canvas);
        })

        const imgCanvas = (img) => {
            const canvas = $('canvas')[0];
            const ctx = canvas.getContext('2d');
            canvas.width = img.width;
            canvas.height = img.height;
            ctx.drawImage(img,0,0,img.width,img.height);
            ctx.font = '48px serif';
            ctx.fillText('경상남도 특산품');
            return canvas.toDataURL();
        }

        const showImg = async () => {
            const {handle,reader} = await filePick();
            const img = new Image();
            img.onload = () => {
                imgCanvas(img);
            }
            img.src = reader.result;
        }

        const filePick = async () => {
            const [handle] = await window.showOpenFilePicker();
            const getFile = await handle.getFile();
            const reader = await readFile(getFile);

            return {handle,reader}
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
            <form action="{{route('review.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <p>이름</p>
                    <input type="text" name="name" class="form-control name_input">
                </div>
                <div class="form-group">
                    <p>구매품</p>
                    <input type="text" name="product" class="form-control">
                </div>
                <div class="form-group">
                    <p>별점</p>
                    <span class="star">
  ★★★★★
  <span>★★★★★</span>
  <input type="range" value="1" step="1" min="0" max="10" name="score" class="star">
</span>
                </div>
                <div class="form-group">
                    <p>구매처</p>
                    <input type="text" name="shop" class="form-control">
                </div>

                <div class="form-group">
                    <p>구매일</p>
                    <input type="date" name="purchase-date" class="form-control">
                </div>

                <div class="form-group">
                    <p>내용</p>
                    <textarea type="text" name="contents" class="form-control">
                    </textarea>
                </div>
                <div class="form-group file_div">
                    <input type="file" name="file" class="form-control file_input" accept=".jpg" id="file">
                </div>
                <div><button type="button" class="btn btn-primary add_photo">사진 추가하기</button></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeModal()">Close</button>
                <button type="submit" class="btn btn-primary file">후기 등록</button>
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
    <tr class="view_modal" data-idx="{{$idx}}">
        <td>{{$list['id']}}</td>
        <td>{{$list['name']}}</td>
        <td>{{$list['product']}}</td>
        <td>{{$list['shop']}}</td>
        <td>{{$list['purchase-date']}}</td>
        <td>{{$list['contents']}}</td>
        <td>{{$list['score']}}</td>
    </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
