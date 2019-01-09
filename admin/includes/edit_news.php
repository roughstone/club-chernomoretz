<?php
include_once "db_includes.php";
include_once "MyImages.php";
@session_start();

if(!isset($_SESSION['име'])) {
	echo "<script>window.open('../login.php','_self')</script>";
} else {

if(isset($_GET['промени_новина'])) {
	
	$editNews = $_GET['промени_новина'];
	
	$select_news = "SELECT * FROM news WHERE заглавие='$editNews'";
	
	$run_query = $conn->query($select_news);
	
	while ($row_news=mysqli_fetch_array($run_query)) {
		
		$id = $row_news['id'];
		$category = $row_news['категория'];
		$description = $row_news['описание'];
		$date = $row_news['дата'];
		$image = $row_news['снимка'];
		$title = $row_news['заглавие'];
		
		$the_old_dir = str_replace('.', '',$title);
		$old_dir = str_replace(' ', '_',$the_old_dir);		
	}	
}

?>

	<form action="" method="post" enctype="multipart/form-data">

				<h2>Промени новина.</h2>

			<div class="row"><div class="title">Заглавие:</div><input type="text" name="title" size="60" value="<?php echo $title; ?>"></div>

			<div class="row"><div class="title">Снимка/картинка:</div><input type="file" name="image" size="50" accept=".png, .jpg, .jpeg"><img src="news_images/<?php echo $old_dir; ?>/<?php echo $image; ?>" width="60"/><?php echo $image; ?></div>

			<div class="row"><div class="title">Дата:</div><input type="date" name="date" size="60" value="<?php echo $date; ?>"></div>

			<div class="row"><div class="title">Категория:</div>
			<select name="category">
				<?php echo "<option>$category</option>";?>
				<option>Новини</option>
				<option>Обявления</option>
			</select>
			</div>

			<div class="row"><div class="title">Описание:</div><textarea name="description" rows="10" cols="50"><?php echo $description; ?></textarea></div>
			
			<input type="submit" name="update" value="Промени сега!"/>

	</form>

	<?php
if(isset($_POST['update'])) {
	
	$up_title = $_POST['title'];
	$up_image = $_FILES['image']['name'];
	$up_image_tmp = $_FILES ['image']['tmp_name'];
	$up_date = $_POST['date'];
	$up_category = $_POST['category'];
	$up_description = $_POST['description'];	
	
	$the_dir = str_replace('.', '',$up_title);
	$new_dir = str_replace(' ', '_',$the_dir);
	
	 if($up_image==''){
		
		$update_news = "UPDATE news SET категория='$up_category', дата='$up_date', описание='$up_description', заглавие='$up_title' WHERE id='$id'";
		
		if ($conn->query($update_news) === TRUE) {
		
			if(rename("news_images/$old_dir" , "news_images/$new_dir") === TRUE) {
			
			echo "<script>alert('Промяната е направена успешно!');</script>";
			
			echo "<script>window.open('index.php?добави_новина','_self');</script>";
			}
		}
		exit();
	}
	else {
		
		$update_news = "UPDATE news SET категория='$up_category', дата='$up_date', описание='$up_description', снимка='$up_image', заглавие='$up_title' WHERE id='$id'";
	
		if ($conn->query($update_news) === TRUE) {
			
		rename ("news_images/$old_dir" , "news_images/$new_dir");
		$image_file = "news_images/$new_dir/$image";
		unlink($image_file);
		
		$imgDir = "news_images/$new_dir/$up_image";

			if (move_uploaded_file($up_image_tmp, $imgDir) === TRUE) {
		
			$resizeImage = new MyImages();
			$resizeImage->resizeAnImage($imgDir, 1920);
			
			echo "<script>alert('Промяната е направена успешно!');</script>";
				
			echo "<script>window.open('index.php?добави_новина','_self');</script>";
			}			
		exit();			
		}	
	}	
}
}?>

