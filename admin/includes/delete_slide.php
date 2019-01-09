<?php
include_once "db_includes.php";
@session_start();

if(!isset($_SESSION['име'])) {
	echo "<script>window.open('../login.php','_self')</script>";
} else {

	if(isset($_GET['изтрий_слайд'])) {
		
		$delete_id = $_GET['изтрий_слайд'];
		
		$slide_name = "SELECT * FROM slider WHERE id=$delete_id";
		$run_slide = $conn->query($slide_name);
				
		while ($row_slide=mysqli_fetch_array($run_slide)) {
			
			$sl_photo1=$row_slide['снимка1'];
			$sl_photo2=$row_slide['снимка2'];
			
		}	
		
		$photo_file1 = "../../images/$sl_photo1";
		unlink($photo_file1);	
		$photo_file2 = "../../images/$sl_photo2";
		unlink($photo_file2);
		
		$delete_slide = "DELETE FROM slider WHERE id='$delete_id'";
		
		$run_delete = $conn->query($delete_slide);
		
		echo "<script>alert('Обекта е изтрит!')</script>";
		
		echo "<script>window.open('../index.php?добави_слайд','_self')</script>";
		
	}

}?>