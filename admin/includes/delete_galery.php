<?php
include_once "db_includes.php";
@session_start();

if(!isset($_SESSION['име'])) {
	echo "<script>window.open('../login.php','_self')</script>";
} else {
?>

<?php

	if(isset($_GET['изтрий_галерия'])) {
		
		$delete_id = $_GET['изтрий_галерия'];
		
		$photo_name = "SELECT * FROM gal_holders WHERE id=$delete_id";
		$run_photo = $conn->query($photo_name);
				
		while ($row_photo=mysqli_fetch_array($run_photo)) {
		
			$photo_obj = $row_photo['снимка'];
			$gal_dir = $row_photo['заглавие'];
			$the_dir = str_replace('.','',$gal_dir);
			$dir = str_replace(' ','_',$the_dir);
		}	
		
		$photos = "SELECT * FROM photos WHERE gal_holder_id='$delete_id'";
		$run_photos = $conn->query($photos);
		
		while($row_photos=mysqli_fetch_array($run_photos)) {
			
			$galery_photos=$row_photos['снимка'];
			$photo_file = "../galery_images/$dir/$galery_photos";
			unlink($photo_file);
		}
		
		$del_galery_photos = "DELETE FROM photos WHERE gal_holder_id ='$delete_id'";
		$run_delete_photos = $conn->query($del_galery_photos);
	
		$gal_photo_file = "../galery_images/$dir/$photo_obj";
		unlink($gal_photo_file);
		rmdir ("../galery_images/$dir");
		
		$delete_galery = "DELETE FROM gal_holders WHERE id='$delete_id'";
		$run_delete = $conn->query($delete_galery);
	
		echo "<script>alert('Галерията е изтрита!')</script>";
		
		echo "<script>window.open('../index.php?добави_галерия','_self')</script>";
		
	}

}?>