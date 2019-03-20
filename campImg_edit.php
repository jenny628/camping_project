<?php
//require __DIR__.'/__cred.php';
require __DIR__.'/__connect.php';
 $page_name='campImg_edit';

 $campImg_id=isset($_GET['campImg_id']) ? intval($_GET['campImg_id']):0;
 $sql="SELECT * FROM `campsite_image` WHERE `campImg_id`=$campImg_id";
 
 $stmt=$pdo->query($sql);
 if($stmt->rowCount()==0){
     header('Location:campImg_list.php');
     exit;
 }
 $row=$stmt->fetch(PDO::FETCH_ASSOC);

?>
<?php include __DIR__.'/__html_header.php'; ?>
<?php include __DIR__.'/__html_navbar01.php'; ?>
<style>
.form-group small{
    color:red !important;
}
</style>
<main class="col-10 bg-white">
<aside class="bg-warning">
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./camp_list.php">營地列表</a></li>
            <li class="breadcrumb-item"><a href="./campImg_list.php">營地圖片清單</a></li>
            <li class="breadcrumb-item active" aria-current="page">修改圖片資料</li>
         </ol>
        </nav>
</aside>

     
      <div class="card" >
        <div class="card-body">
        <div id="info_bar" class="alert alert-success" role="alert" style="display:none"></div>
            <h5 class="card-title">修改資料</h5>
            <form name="form2" method="post" onsubmit="return checkForm()" >
            <input type="hidden" name="checkme" value="check123">
            <div class="form-group">
                <label for="camp_name">1.營區名稱</label>
                <input type="text" class="form-control" id="camp_name" name="camp_name" placeholder=""
                value="<?= $row['camp_name'] ?>">
                <small id="camp_nameHelp" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
                <label for="campImg_name">2.圖片名稱</label>
                <input type="text" class="form-control" id="campImg_name" name="campImg_name" placeholder=""
                value="<?= $row['campImg_name'] ?>">
                <small id="campImg_nameHelp" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
                <label for="campImg_file">3.資料夾</label>
                <input type="text" class="form-control" id="campImg_file" name="campImg_file" placeholder=""
                value="<?=  $row['campImg_file'] ?>">
                <small id="campImg_fileHelp" class="form-text text-muted"></small>
            </div>

            <button id="submit_btn" type="submit" class="btn btn-primary">Submit</button>
            </form>
                       
        </div>
        </div>



    </main>
    <script>
        const info_bar = document.querySelector('#info_bar');
        const submit_btn = document.querySelector('#submit_btn');

        const field_image = [
            'camp_name',
            'campImg_name',
            'campImg_file',
            'campImg_path'
        
        ];

        const ts = {};
        for(let v of field_image){
            ts[v] = document.form2[v];
        }
        console.log(ts);
        console.log('ts.camp_name:', ts.camp_name);


        const checkForm = ()=>{
            let isPassed = true;
            info_bar.style.display = 'none';

            const tsv = {};
            for(let v of field_image){
                tsv[v] = ts[v].value;
            }
            //console.log(tsv);

            if(isPassed) {
                let form2 = new FormData(document.form2);

                submit_btn.style.display = 'none';

                fetch('campImg_edit_api.php', {
                    method: 'POST',
                    body: form2
                })
                    .then(response=>response.json())
                    .then(obj=>{
                        console.log(obj);

                        info_bar.style.display = 'block';

                        if(obj.success){
                            info_bar.className = 'alert alert-success';
                            info_bar.innerHTML = '資料修改成功';
                        } else {
                            info_bar.className = 'alert alert-danger';
                            info_bar.innerHTML = obj.errorMsg;
                        }

                        submit_btn.style.display = 'block';
                    });



            }else{
                info_bar.innerHTML = '資料修改失敗'; ;
            }
            return false;
        };

    </script>
<?php include __DIR__.'/__html_footer.php'; ?>