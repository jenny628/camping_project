<?php
//require __DIR__.'/__cred.php';
 $page_name='index_';
?>
<?php include __DIR__.'/__html_header.php'; ?>
<?php include __DIR__.'/__html_navbar01.php'; ?>
<main class="col-10 bg-white">
<aside class="bg-warning">
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
         <li class="breadcrumb-item active" aria-current="page">營地列表</li>
         </ol>
        </nav>
</aside>
<div class="list-group">
  <a href="./campsite_list.php" class="list-group-item list-group-item-action">
    營地清單
  </a>
  <a href="./campImg_list.php" class="list-group-item list-group-item-action">圖片清單</a>
  <!-- <a href="#" class="list-group-item list-group-item-action">分類清單</a>
  <a href="#" class="list-group-item list-group-item-action">價格清單</a> -->
  
</div>
 
</main>


<?php include __DIR__.'/__html_footer.php'; ?>