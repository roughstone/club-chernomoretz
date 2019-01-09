<?php
include_once "db_includes.php";
@session_start();

if(!isset($_SESSION['име'])) {
	echo "<script>window.open('../login.php','_self')</script>";
} else {
?>

<?php

	if(isset($_GET['изтрий_новина'])) {
		
		$delete_id = $_GET['изтрий_новина'];
		
		$delete_dir = "SELECT * FROM news WHERE id='$delete_id'";
		
		$run_dir = $conn->query($delete_dir);
		while ($row_array = mysqli_fetch_array($run_dir)) {
			
			$get_dir = $row_array['заглавие'];	
			$get_image = $row_array['снимка'];
		}
		$the_old_dir = str_replace('.', '',$get_dir);
		$old_dir = str_replace(' ', '_',$the_old_dir);
		

		$image_file = "../news_images/$old_dir/$get_image";
		unlink($image_file);
		rmdir ("../news_images/$old_dir");
			
		$delete_news = "DELETE FROM news WHERE id='$delete_id'";
		
		$run_delete = $conn->query($delete_news);
		
		echo "<script>alert('Новината е изтрита!')</script>";
		
		echo "<script>window.open('../index.php?добави_новина','_self')</script>";
		
		
	}
	

}?>

