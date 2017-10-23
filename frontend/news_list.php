<?php
session_start();
require_once('../connection/database.php');
$limit = 10;
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
$start_from = ($page-1) * $limit;
$sth = $db->query("SELECT * FROM news ORDER BY publishedDate DESC LIMIT ".$start_from.",". $limit);
$all_news = $sth->fetchAll(PDO::FETCH_ASSOC);
$totalRows = count($all_news);

?>
<!doctype html>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>news - Sweet House</title>
	<?php require_once("template/files.php"); ?>
</head>
<body>
	<div id="page">
		<?php require_once("template/header.php"); ?>
		<div id="body">
			<div class="header">
				<div>
					<h1>news</h1>
				</div>
			</div>
			<div class="blog">
				<div class="featured">
					<ul>
						<?php foreach ($all_news as $row) { ?>
						<li>
							<img src="../images/new-chills.png" alt="">
							<div>
								<h1><?php echo $row['title']; ?></h1>
								<span><?php echo $row['publishedDate']; ?></span>
								<p><?php echo mb_substr($row['content'],0,50,"utf-8")."..."; ?></p>
								<a href="news.php?newsID=<?php echo $row['newsID'];?>" class="more">Read More</a>
							</div>
						</li>
					 <?php } ?>
					</ul>
					<div class="section">
						<div class="container">
							<div class="row">
								<div class="col-md-12 text-center">
									<?php  if($totalRows > 0){
											$sth = $db->query("SELECT * FROM news ORDER BY publishedDate DESC ");
											$data_count = count($sth ->fetchAll(PDO::FETCH_ASSOC));
											$total_pages = ceil($data_count / $limit);
										 ?>
									<ul class="pagination">
										<?php   if($page > 1){ ?>
											<li>
												<a href="list.php?page=<?php echo $page-1;?>">上一頁</a>
											</li>
											<?php }else{ ?>
												<li>
													<a href="#">上一頁</a>
												</li>
												<?php } ?>
										<?php for ($i=1; $i<=$total_pages; $i++) { ?>

										<li>
											<a href="list.php?page=<?php echo $i;?>"><?php echo $i;?></a>
										</li>
										<?php } ?>
										<?php if($page < $total_pages){ ?>
										<li>
											<a href="list.php?page=<?php echo $page+1;?>">下一頁</a>
										</li>
										<?php }else{ ?>
											<li>
												<a href="#">下一頁</a>
											</li>
											<?php } ?>
									</ul>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="sidebar">
					<h1>Recent Posts</h1>
					<img src="../images/on-diet.png" alt="">
					<h2>ON THE DIET</h2>
					<span>By Admin on November 28, 2023</span>
					<p>You can replace all this text with your own text. You can remove any link to our website from this website template.</p>
					<a href="news.php" class="more">Read More</a>
				</div>
			</div>
		</div>
		<?php require_once("template/footer.php"); ?>
	</div>
</body>
</html>
