<?php
include_once "db_includes.php";
include_once "MyImages.php";
@session_start();

if(!isset($_SESSION['име'])) {
	echo "<script>window.open('../login.php','_self')</script>";
} else {

	if(isset($_GET['промени_галерия'])) {
		
		$edit_id = $_GET['промени_галерия'];
		
		$select_galery = "SELECT * FROM gal_holders WHERE id='$edit_id'";
		
		$run_query = $conn->query($select_galery);
			
		while ($row_galery=mysqli_fetch_array($run_query)) {

			$id=$row_galery['id'];
			$name=$row_galery['заглавие'];
			$date=$row_galery['дата'];
			$category=$row_galery['категория'];
			$photo=$row_galery['снимка'];
			
			$the_old_dir = str_replace('.', '',$name);	
			$old_dir = str_replace(' ', '_',$the_old_dir);	
		
		}
	}

?>

	<form action="" method="post" enctype="multipart/form-data">

		<h2>Промени в галерия.</h2>

		<div class="row"><div class="title">Заглавие:</div><input type="text" name="name" size="60" value="<?php echo $name ?>"></div>

		<div class="row"><div class="title">Снимка:</div><input type="file" name="photo" accept=".png, .jpg, .jpeg"><img src="galery_images/<?php echo $old_dir; ?>/<?php echo $photo; ?>" width="60"/><?php echo $photo; ?></div>

		<div class="row"><div class="title">Дата:</div><input type="date" name="date" size="60" value="<?php echo $date ?>"></div>

		<div class="row"><div class="title">Категория:</div>
		<select name="category">
			<option><?php echo $category ?></option>
			<option>състезания</option>
			<option>тренировки</option>
			<option>участия</option>
		</select>
		</div>

		<input type="submit" name="update" value="Промени"/>

	</form>

 <?php 
if (isset($_POST['update'])) {

	$up_name = $_POST['name'];
	$up_photo = $_FILES['photo']['name'];
	$up_photo_tmp = $_FILES['photo']['tmp_name'];
	$up_date = $_POST['date'];
	$up_cat = $_POST['category'];

	$the_new_dir = str_replace('.', '',$up_name);
	$new_dir = str_replace(' ', '_',$the_new_dir);	
	
	if($up_photo=='') {
				
		$update_gal = "UPDATE gal_holders SET категория='$up_cat', дата='$up_date', заглавие='$up_name' WHERE id='$id'";
			
		if ($conn->query($update_gal) === TRUE) {
			
			if (rename ("galery_images/$old_dir", "galery_images/$new_dir") === TRUE) {
			
			echo "<script>alert('Записът в >Галерия</ променен!');</script>";
			
			echo "<script>window.open('index.php?добави_галерия','_self');</script>";
			}
		}
		exit();
	}
	
	else {
		
		$update_gal = "UPDATE gal_holders SET категория='$up_cat', дата='$up_date', заглавие='$up_name', снимка='$up_photo' WHERE id='$id'";
	
		if ($conn->query($update_gal) === TRUE) {
			
		rename ("galery_images/$old_dir", "galery_images/$new_dir");
			
		$photo_file = "galery_images/$new_dir/$photo";
		unlink($photo_file);
		
		$imgDir = "galery_images/$new_dir/$up_photo";

		if (move_uploaded_file($up_photo_tmp, $imgDir) === TRUE) {

			$resizeImage = new MyImages();
			$resizeImage->resizeAnImage($imgDir, 1920);
		
			echo "<script>alert('Записът в >Галерия</ променен!');</script>";
			
			echo "<script>window.open('index.php?добави_галерия','_self');</script>";
		}
		}
		exit();
	}	
}
}?>