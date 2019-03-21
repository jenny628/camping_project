<?php
require __DIR__.'/__connect.php';
 $page_name='campImg_insert';
?>
<?php include __DIR__.'/__html_header.php'; ?>
<?php include __DIR__.'/__html_navbar01.php'; ?>
<style>
.form-group small{
    color:red !important;
}
</style>
<main class="col-9 bg-white">
<aside class="bg-warning">
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./camp_list.php">營地列表</a></li>
            <li class="breadcrumb-item"><a href="./campImg_list.php">營地圖片清單</a></li>
            <li class="breadcrumb-item active" aria-current="page">新增圖片資料</li>
         </ol>
        </nav>
</aside>
      <div class="card" >
        <div class="card-body">
        <div id="info_bar" class="alert alert-success" role="alert" style="display:none"></div>
            <h5 class="card-title">新增資料
                <?php if (isset( $msg)):?>
                <div class="alert alert-<?= $msg['type'] ?>" role="alert">
                <?= $msg['info'] ?>
                </div>
                <?php endif ?>

            </h5>
            <form name="formpic" method="post" onsubmit="return checkForm()" >
            <input type="hidden" name="checkme" value="check123">
            <div class="form-group">
                <label for="camp_name">1.營區名稱</label>
                <input type="text" class="form-control" id="camp_name" name="camp_name" placeholder=""
                value="">
                <small id="camp_nameHelp" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
                <label for="campImg_name">2.圖片名稱</label>
                <input type="text" class="form-control" id="campImg_name" name="campImg_name" placeholder=""
                value="">
                <small id="campImg_nameHelp" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
                <label for="campImg_file">3.資料夾</label>
                <input type="text" class="form-control" id="campImg_file" name="campImg_file" placeholder=""
                value="">
                <small id="campImg_fileHelp" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
                  <label for="picture" >4.圖片</label><br>  
                      <img id="preview" src="" height="100px" width="" />
                      <br>
                      <input type="file" id="my_file" name="my_file" onchange="previewImage(this)" accept="image/*"/><br>             
            </div>
                       
            <button id="submit_btn" type="submit" class="btn btn-primary">Submit</button>
            </form>

    </form>
        </div>
        </div>
 
</main>
<script>
    const info_bar = document.querySelector('#info_bar');
    const submit_btn = document.querySelector('#submit_btn');

        const fields = [
            'camp_name',
            'campImg_name',
            'campImg_file',
            'campImg_path',
        ];

        // 拿到每個欄位的參照
        // const fs = {};
        // for(let v of fields){
        //     fs[v] = document.formpic[v];
        // }
        // console.log(fs);
        // console.log('fs.camp_name:', fs.camp_name);


        const checkForm = ()=>{
            let isPassed = true;
            info_bar.style.display = 'none';

            // // 拿到每個欄位的值
            // const fsv = {};
            // for(let v of fields){
            //     fsv[v] = fs[v].value;
            // }
            // console.log(fsv);


            //新增資料表
            if(isPassed) {
                let form = new FormData(document.formpic);
                submit_btn.style.display = 'none';

                fetch('campImg_insert02_api.php', {
                    method: 'POST',
                    body: form
                })
                    .then(response=>response.json())
                    .then(obj=>{
                        console.log(obj);

                        info_bar.style.display = 'block';

                        if(obj.success){
                            info_bar.className = 'alert alert-success';
                            info_bar.innerHTML = '資料新增成功';
                        } else {
                            info_bar.className = 'alert alert-danger';
                            info_bar.innerHTML = obj.errorMsg;
                        }
                        submit_btn.style.display = 'block';
                    });

            }
            return false;
        };
        function previewImage(input) {
        let preview = document.getElementById('preview');
        if (input.files && input.files[0]) {
        let reader = new FileReader();
        reader.onload = function (e) {
            preview.setAttribute('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
        } else {
        preview.setAttribute('src', '');
        }
    }

    </script>
<?php include __DIR__.'/__html_footer.php'; ?>