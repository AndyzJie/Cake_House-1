<?php
require_once('../../connection/database.php');
if(isset($_POST['MM_update']) && $_POST['MM_update'] == "UPDATE"){
  $sql= "UPDATE q_a_category SET category =:category,
            updatedDate = :updatedDate WHERE q_a_categoryID=:q_a_categoryID";
  $sth = $db ->prepare($sql);

  $sth ->bindParam(":category", $_POST['category'], PDO::PARAM_STR);
  $sth ->bindParam(":updatedDate", $_POST['updatedDate'], PDO::PARAM_STR);
  $sth ->bindParam(":q_a_categoryID", $_POST['q_a_categoryID'], PDO::PARAM_INT);
  $sth -> execute();

  header('Location: list.php');
}
$sth = $db->query("SELECT * FROM q_a_category WHERE q_a_categoryID=".$_GET['q_a_categoryID']);
$q_a_category = $sth->fetch(PDO::FETCH_ASSOC);
 ?>
<html><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../../assets/js/validator.min.js"></script>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="..\css\admin.css" rel="stylesheet" type="text/css">
  </head><body>
    <?php include_once("../template/nav.php") ?>
    <div class="section">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            <h1 class="text-left">常見問題分類管理</h1>
          </div>
        </div>
      </div>
    </div>
    <div class="section">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <ul class="breadcrumb">
              <li>
                <a href="#">主控台</a>
              </li>
              <li>
                <a href="#">常見問題分類管理</a>
              </li>
              <li class="active">新增一筆</li>
            </ul>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <hr>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <form class="form-horizontal" role="form" data-toggle="validator" action="edit.php" method="post">
              <div class="form-group">
                <div class="col-sm-2">
                  <label for="category" class="control-label">分類名稱</label>
                </div>
                <div class="col-sm-10">
                  <input type="text" class="form-control"  id="category" name="category" value="<?php echo $q_a_category['category']; ?>"  data-error="請輸入分類名稱"  required>
                  <div class="help-block with-errors"></div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-10 col-sm-offset-2 text-right">
                  <input type="hidden" class="form-control" id="q_a_categoryID" name="q_a_categoryID" value="<?php echo $q_a_category['q_a_categoryID'];?>">
                  <input type="hidden" name="MM_update" value="UPDATE">
                  <input type="hidden" name="updatedDate" value="<?php echo date('Y-m-d H:i:s'); ?>">
                  <button type="submit" class="btn btn-primary">送出</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <footer class="section section-primary">
      <div class="container">
        <div class="row">
          <div class="col-sm-6">
            <h1>Sweet House</h1>
            <p contenteditable="true">版權所有 © 2016 &nbsp; St Paul Kitchen All Right Reserved.</p>
          </div>
        </div>
      </div>
    </footer>

</body></html>
