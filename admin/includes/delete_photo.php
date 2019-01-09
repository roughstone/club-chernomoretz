<?php
include_once "db_includes.php";
@session_start();

if(!isset($_SESSION['име'])) {
	echo "<script>window.open('../login.php','_self')</script>";
} else {
?>

<?php
	if(isset($_GET['delete_photo'])) {
		
		$delete_id = $_GET['delete_photo'];
		$delete_from_gal = $_GET['gal'];
		
		$photo_name = "SELECT * FROM photos WHERE id=$delete_id";
		$run_photo = $conn->query($photo_name);
			
			while ($row_photo=mysqli_fetch_array($run_photo)) {
		
			$photo_obj=$row_photo['снимка'];
		}	
		
		$gal_name = "SELECT * FROM gal_holders WHERE id=$delete_from_gal";
		$run_gal = $conn->query($gal_name);
				
			while ($row_gal=mysqli_fetch_array($run_gal)) {
		
			$gal_name=$row_gal['заглавие'];
		}		
		$the_dir = str_replace('.','',$gal_name);
		$dir = str_replace(' ','_',$the_dir);
		
		$photo_file = "../galery_images/$dir/$photo_obj";
		$photo_file_thumb = "../galery_images/$dir/thumb/$photo_obj";
		unlink($photo_file);	
		$delete_photo = "DELETE FROM photos WHERE id='$delete_id'";
		
		$run_delete = $conn->query($delete_photo);
				
		
		echo "<script>window.open('../index.php?добави_снимки=$delete_from_gal','_self')</script>";
		
	}


}?>