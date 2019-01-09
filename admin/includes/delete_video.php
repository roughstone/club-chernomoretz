<?php
include_once "db_includes.php";
@session_start();

if(!isset($_SESSION['име'])) {
	echo "<script>window.open('../login.php','_self')</script>";
} else {

	if(isset($_GET['delete_video'])) {
		
		$delete_id = $_GET['delete_video'];
		
		$video_name = "SELECT * FROM video WHERE id=$delete_id";
		$run_video = $conn->query($video_name);	
		
		while ($row_video=mysqli_fetch_array($run_video)) {
		
			$vidoe_image = $row_video['снимка'];
			$vidoe_dir = $row_video['заглавие'];
			
			$dir = str_replace(' ','_',$vidoe_dir);
		}	
		
			
		$gal_video_image = "../video_images/$dir/$vidoe_image";
		unlink($gal_video_image);
		rmdir ("../video_images/$dir");
		
		$delete_video = "DELETE FROM video WHERE id='$delete_id'";
		$run_delete = $conn->query($delete_video);
			
		echo "<script>alert('видеото е изтрита!')</script>";
		
		echo "<script>window.open('../index.php?добави_видео','_self')</script>";
		
	}

}?>