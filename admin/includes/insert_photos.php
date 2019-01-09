<?php
include_once "db_includes.php";
@session_start();

if(!isset($_SESSION['име'])) {
	echo "<script>window.open('../login.php','_self')</script>";
} else {

	if(isset($_GET['добави_снимки'])) {
		
	$edit_id = $_GET['добави_снимки'];
		
	$get_galery = "SELECT * FROM gal_holders WHERE id='$edit_id'";
	
	$run_galery = $conn->query($get_galery);
	
		while ($row_galery=mysqli_fetch_array($run_galery)) {
			
			$galery_id=$row_galery['id'];
			$gal_name=$row_galery['заглавие'];
			$gal_date=$row_galery['дата'];
			$gal_cat=$row_galery['категория'];
			$gal_photo=$row_galery['снимка'];
			
			$the_dir = str_replace('.', '',$gal_name);	
			$dir = str_replace(' ', '_',$the_dir);		
			
		}	
	}
?>

<form action="" method="post" enctype="multipart/form-data">
				
	<h2>Добави снимки В - <?php echo $gal_name;?>.</h2>
				
	<div class="row"><div class="title">Заглавие на снимка:</div><input type="text" name="name" size="60"></div>
				
	<div class="row"><div class="title">Снимка:</div><input type="file" id="photo" name="photo" accept=".png, .jpg, .jpeg"></div>
			
	<input type="submit" name="update" value="Добави">
		
</form>

<?php
echo "<div class='glavna' align='center'><p align='center'>$gal_photo <bold>ЗАГЛАВНА НА</bold> $gal_name</p>
	<div style='background-image:url(galery_images/$dir/$gal_photo')></div>
	</div>
	";
		
$get_photos = "SELECT * FROM photos WHERE gal_holder_id='$edit_id'";
$run_photos = $conn->query($get_photos);
	while($row_photos=mysqli_fetch_array($run_photos)) {
					
		$photo_gal=$row_photos['gal_holder_id'];
		$photo_id=$row_photos['id'];
		$photo_obj=$row_photos['снимка'];
		$photo_name=$row_photos['заглавие'];
					
		echo "<div class='photo'><p>$photo_obj от $gal_name</p>
		<div style='background-image:url(galery_images/$dir/$photo_obj')></div>
		<a href='includes/delete_photo.php?delete_photo=$photo_id&gal=$photo_gal'><p>Изтрий<p></a>
		</div>
		";
			
	}

if(isset($_POST['update'])) {
	
	$photo_name=$_POST['name'];
	$photo = $_FILES['photo']['name'];
	$photo_tmp = $_FILES ['photo']['tmp_name'];
			
		$update_kid = "INSERT INTO photos (gal_holder_id, снимка, заглавие) 
		VALUES ('$edit_id','$photo','$photo_name')";
		
		if ($conn->query($update_kid)=== true){
			
		$imgDir = "galery_images/$dir/$photo";
		
			if (move_uploaded_file($photo_tmp, $imgDir) === TRUE) {
			
			$resizeImage = new MyImages();
			$resizeImage->resizeAnImage($imgDir, 1920);

			echo "<script>window.open('index.php?добави_снимки=$edit_id','_self');</script>";	
			}
		}
	}
}?>

