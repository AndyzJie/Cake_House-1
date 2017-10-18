<?php
require_once('../../connection/database.php');
if(isset($_POST['MM_update']) && $_POST['MM_update'] == "UPDATE"){
  $sql= "UPDATE news SET publishedDate =:publishedDate,
            title = :title,
            content = :content,
            updatedDate = :updatedDate WHERE newsID=:newsID";
  $sth = $db ->prepare($sql);

  $sth ->bindParam(":publishedDate", $_POST['publishedDate'], PDO::PARAM_STR);
  $sth ->bindParam(":title", $_POST['title'], PDO::PARAM_STR);
  $sth ->bindParam(":content", $_POST['content'], PDO::PARAM_STR);
  $sth ->bindParam(":updatedDate", $_POST['updatedDate'], PDO::PARAM_STR);
  $sth ->bindParam(":newsID", $_POST['newsID'], PDO::PARAM_INT);
  $sth -> execute();

  header('Location: list.php');
}
$sth = $db->query("SELECT * FROM news WHERE newsID=".$_GET['newsID']);
$news = $sth->fetch(PDO::FETCH_ASSOC);
 ?>
<html><head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
  <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="../../assets/js/validator.min.js"></script>
  <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="../../assets/js/jquery-ui/jquery-ui.css" rel="stylesheet" type="text/css">
  <link href="../../tinymce/skins/lightgray/skin.min.css" rel="stylesheet" type="text/css">
  <link href="../css/admin.css" rel="stylesheet" type="text/css">
  <script type="text/javascript" src="../../assets/js/jquery-ui/jquery-ui.js"></script>
  <script type="text/javascript" src="../../tinymce/tinymce.min.js"></script>
  <script type="text/javascript">
    //js程式區塊
    $( function() {
  $( "#publishedDate" ).datepicker({
    dateFormat: "yy-mm-dd"
  });
} );
tinymce.init({
  selector: 'textarea',
  height: 500,
  menubar: false,
  plugins: [
    'advlist autolink lists link image charmap print preview anchor textcolor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table contextmenu paste code help'
  ],
  toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
  content_css: [
    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
    '//www.tinymce.com/css/codepen.min.css']
});
  </script>
  </head><body>
    <?php include_once("../template/nav.php") ?>
    <div class="section">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <ul class="breadcrumb">
              <li>
                <a href="#">主控台</a>
              </li>
              <li>
                <a href="#">最新消息管理</a>
              </li>
              <li class="active">編輯</li>
            </ul>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <a href="list.php" class="btn btn-default">回上一層</a>&nbsp;
            <hr>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <form class="form-horizontal" role="form" data-toggle="validator" method="post" action="edit.php">
              <div class="form-group">
                <div class="col-sm-2">
                  <label for="publishedDate" class="control-label">發佈日期</label>
                </div>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="publishedDate" name="publishedDate" value="<?php echo $news['publishedDate']; ?>"  required>
                  <div class="help-block with-errors"></div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-2">
                  <label for="title" class="control-label">標題</label>
                </div>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="title"  name="title"data-error="請輸入標題" value="<?php echo $news['title']; ?>" required>
                  <div class="help-block with-errors"></div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-2">
                  <label for="content" class="control-label">內容</label>
                </div>
                <div class="col-sm-10">
                  <textarea class="form-control" id="content" name="content" ><?php echo $news['content']; ?></textarea>
                  <div class="help-block"></div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-10 col-sm-offset-2 text-right">
                  <input type="hidden" class="form-control" id="newsID" name="newsID" value="<?php echo $news['newsID'];?>">
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
            <p contenteditable="true">版權所有 © 2016 &nbsp; Sweet House All Right Reserved.</p>
          </div>
        </div>
      </div>
    </footer>

</body></html>
