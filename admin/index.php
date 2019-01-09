<?php
include 'includes/MyImages.php';
include_once "includes/db_includes.php";
session_start();

if(!isset($_SESSION['име'])) {
	echo "<script>window.open('login.php','_self')</script>";
} else {
	
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>admin panel</title>
<link rel="stylesheet" type="text/css" href="style_admincomplate.css">

<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea' });</script>

</head>

<body>

<div id="wrap">

<div id="head">
<a style="text-decoration:none" href="index.php">
<h1>Контролен панел</h1>
</a>
</div>


<div id="menu">
	<a href="index.php?добави_слайд">Слайдери</a>
	<a href="index.php?контакти">Контакти</a>
	<a href="index.php?добави_в_отбор">Състезатели/Треньори</a>
	<a href="index.php?добави_новина">Новини</a>
	<a href="index.php?добави_галерия">Галерия</a>
	<a href="index.php?добави_видео">Видео</a>
	<a href="index.php?график">График</a>
	<a href="logout.php">Изход</a>
</div>
	<div id="show" onclick="document.getElementById('menu').style.display='block',document.getElementById('show').style.display='none';">Меню</div>

<div id="article">

<?php
	if(isset($_GET['добави_слайд'])) {
		include("includes/insert_slide.php");
		}
		else if(isset($_GET['промени_слайд'])) {
			include("includes/edit_slide.php");
		}
		else if(isset($_GET['контакти'])) {
			include("includes/contacts.php");
		}		
		else if(isset($_GET['добави_в_отбор'])) {
			include("includes/insert_schedule.php");
		}
		else if(isset($_GET['промени_в_отбор'])) {
			include("includes/edit_schedule.php");
		}			
		else if(isset($_GET['добави_новина'])) {
			include("includes/insert_news.php");
		}
		else if(isset($_GET['промени_новина'])) {
			include("includes/edit_news.php");
		}	
		else if(isset($_GET['добави_галерия'])) {
			include("includes/insert_galery.php");
		}	
		else if(isset($_GET['промени_галерия'])) {
			include("includes/edit_galery.php");
		}		
		else if(isset($_GET['добави_снимки'])) {
			include("includes/insert_photos.php");
		}		
		else if(isset($_GET['добави_видео'])) {
			include("includes/insert_video.php");
		}	
		else if(isset($_GET['график'])) {
			include("includes/grafik.php");
		}
		else {
			$get_message = "SELECT * FROM messages";
			$run_message = $conn->query($get_message);
			
				while ($row_message=mysqli_fetch_array($get_message)) {
					$first_name = $row_message['first_name'];
					$last_name = $row_message['last_name'];
					$email = $row_message['email'];
					$the_massage = $row_message['the_message'];
					$the_date = $row_message['the_date'];

					echo"
						<div>$the_massage</div>
						<div>$the_date</div>
					";
				}
		}		
?>
	
</div>

</div>

</body>
</html>
<?php } ?>