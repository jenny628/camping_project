<style>
    ul.navbar-nav>li.nav-item.active {
        background-color: lightblue;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
<div class="container">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item <?= $page_name=='index_'?'active':''?>">
        <a class="nav-link" href="./index_.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item <?= $page_name=='data_list'?'active':''?>">
        <a class="nav-link" href="./campsite_list.php">營地表單</a>
      </li>
      <li class="nav-item <?= $page_name=='data_list2'?'active':''?>">
        <a class="nav-link" href="./data_list2.php">表單2</a>
      </li>
      <li class="nav-item  <?= $page_name=='data_insert'?'active':''?>">
        <a class="nav-link" href="./data_insert.php">新增資料</a>
      </li>
      <li class="nav-item  <?= $page_name=='data_insert2'?'active':''?>">
        <a class="nav-link" href="./data_insert2.php">新增資料2</a>
      </li>
      <li>
       <a href="./logout.php"class="btn btn-primary">登出</a>
      </li>
    </ul>
  </div>
  </div>
</nav>
