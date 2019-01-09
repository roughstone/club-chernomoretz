<?php
include_once "db_includes.php";
@session_start();

if(!isset($_SESSION['име'])) {
	echo "<script>window.open('../login.php','_self')</script>";
} else {

	if(isset($_GET['delete_schedule'])) {
		
		$delete_id = $_GET['delete_schedule'];
		
		$photo_name = "SELECT * FROM schedule WHERE id=$delete_id";
		$run_photo = $conn->query($photo_name);
				
		while ($row_photo=mysqli_fetch_array($run_photo)) {
			
			$photo_dir1=$row_photo['име'];
			$photo_dir2=$row_photo['фамилия'];
			$photo_obj=$row_photo['снимка1'];
			$photo_obj2=$row_photo['снимка2'];
			
			$dir = $photo_dir1."_".$photo_dir2;
			
		}			
		$photo_file = "../object_images/$dir/$photo_obj";
		unlink($photo_file);	
		$photo_file2 = "../object_images/$dir/$photo_obj2";
		unlink($photo_file2);
		rmdir ("../object_images/$dir");
		
		$delete_kids = "DELETE FROM schedule WHERE id='$delete_id'";
		
		$run_delete = $conn->query($delete_kids);
		
		echo "<script>alert('Обекта е изтрит!')</script>";
		
		echo "<script>window.open('../index.php?добави_в_отбор','_self')</script>";
		
	}

}?>