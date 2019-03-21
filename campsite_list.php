<?php 
//require __DIR__.'/__cred.php';
require __DIR__.'/__connect.php';
 $page_name='campsite_list';

 $per_page=10;
 $page=isset($_GET['page']) ? intval($_GET['page']) : 1;

//計算總筆數
 $t_sql="SELECT COUNT(1) FROM `campsite_list`";
 $t_stmt=$pdo->query($t_sql);
 $total_rows=$t_stmt->fetch(PDO::FETCH_NUM)[0];
//計算總頁數
 $total_pages=ceil($total_rows/$per_page);
 $sql=sprintf("SELECT * FROM `campsite_list`ORDER BY `camp_id`DESC LIMIT %s,%s",($page-1)*$per_page,$per_page);

if($page<1) $page=1;
if($page>$total_pages) $page=$total_pages;

 $stmt= $pdo-> query("$sql");//ORDER BY `sid`DESC LIMIT 0,10
 $rows= $stmt->fetchall(PDO::FETCH_ASSOC); // 所有資料一次拿出來
?>
<?php include __DIR__.'/__html_header.php'; ?>
<?php include __DIR__.'/__html_navbar01.php'; ?>
<style>
 section{
     overflow:auto;
 }
 .inset_bottom{
     position:absolute;
     right:10px;
 }
</style>
<main class="col-10 bg-white">
<aside class="bg-warning">
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./camp_list.php">營地列表</a></li>
            <li class="breadcrumb-item active" aria-current="page">營地清單</li>
         </ol>
        </nav>
</aside>

 <section>
    <nav aria-label="...">
    <ul class="pagination pagination-sm">
    <li class="page-item <?= $page<=1 ?'disabled':'' ?>">
      <a class="page-link" href="?page=<?= $page-1 ?>">&lt;</a>
      <!-- 前一頁 -->
      </li>
    <?php for($i=1 ; $i<=$total_pages ; $i++):?>
      <li class="page-item <?= $page==$i?'active':'' ?>">
      <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
      </li>
    <?php endfor ?>
    <li class="page-item <?= $page>=$total_pages ?'disabled':'' ?>">
      <a class="page-link" href="?page=<?= $page+1 ?>">&gt;</a>
      <!-- 後一頁 -->
      </li>
      <li class="inset_bottom">
      <a class="btn btn-primary" href="campsite_insert.php" role="button">新增資料</a>
      </li>
    </ul>
    
  </nav>
 
<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>#</th>
      <th>營區名稱</th>
      <th>城市</th>
      <th>地區</th>
      <th>地址</th>
      <th>經緯度</th>
      <th>聯絡電話</th>
      <th>傳真</th>
      <th>電子郵件</th>
      <th>聯絡人</th>
      <th>開放時間</th>
      <th>適合對象</th>
      <th><i class="fas fa-edit"></i></th>
      <th><i class="fas fa-trash-alt"></i></th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($rows as $row): ?>
    <tr style="white-space:nowrap">
  
      <td><?= $row['camp_id']?></td>
      <td><?= $row['camp_name']?></td> 
      <td><?= $row['city']?></td>
      <td><?= $row['dist']?></td>
      <td><?= $row['camp_address']?></td>
      <td><?= $row['camp_location']?></td>
      <td><?= $row['camp_tel']?></td>
      <td><?= $row['camp_fax']?></td>
      <td><?= $row['camp_email']?></td>
      <td><?= $row['camp_ownerName']?></td>
      <td><?= $row['camp_openTime']?></td>
      <td><?= $row['camp_target']?></td>
      <td><a href="campsite_edit.php?camp_id=<?= $row['camp_id'] ?>"><i class="fas fa-edit"></i></a></td>
      <td><a href="javascript: delete_it(<?= $row['camp_id'] ?>)">
          <i class="fas fa-trash-alt"></i>
      </a>
      </td>
    </tr>
<?php endforeach ?>
  </tbody>
</table>
</div>


 </section>
 </main>




<script>
  function delete_it(camp_id){
    if(confirm(`確定要刪除編號為 ${camp_id} 的資料嗎?`) ){
      location.href = 'campsite_delete.php? camp_id=' + camp_id;
    }
  }

</script>
<?php include __DIR__.'/__html_footer.php'; ?>