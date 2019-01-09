<?php
include_once "db_includes.php";
@session_start();

if(!isset($_SESSION['име'])) {
	echo "<script>window.open('../login.php','_self')</script>";
} else {

if(isset($_GET['промени_слайд'])) {
	
	$edit_id = $_GET['промени_слайд'];
	
	$select_slide = "SELECT * FROM slider WHERE id='$edit_id'";
	
	$run_query = $conn->query($select_slide);
	
	while ($row_slide=mysqli_fetch_array($run_query)) {
		
		$sl_id = $row_slide['id'];
		$sl_title = $row_slide['заглавие'];
		$sl_photo1 = $row_slide['снимка1'];
		$sl_photo2 = $row_slide['снимка2'];
		$sl_discription = $row_slide['описание'];
	
	}
	
}

?>

	<form action="" method="post" enctype="multipart/form-data">

				<h2>Промени новина.</h2>

			<div class="row"><div class="title">Заглавие:</div><input type="text" name="sl_title" size="60" value="<?php echo $sl_title; ?>"></div>

			<div class="row"><div class="title">Снимка/картинка1:</div><input type="file" name="sl_photo1" size="50" accept=".png, .jpg, .jpeg"><img src="../images/<?php echo $sl_photo1; ?>" width="60"/><?php echo $sl_photo1; ?></div>

			<div class="row"><div class="title">Снимка/картинка1:</div><input type="file" name="sl_photo2" size="50" accept=".png, .jpg, .jpeg"><img src="../images/<?php echo $sl_photo2; ?>" width="60"/><?php echo $sl_photo2; ?></div>

			<div class="row"><div class="title">Описание:</div><textarea name="sl_description" rows="10" cols="50"><?php echo $sl_discription; ?></textarea></div>
			
			<input type="submit" name="update" value="Промени сега!"/>

	</form>

	<?php
if(isset($_POST['update'])) {

	$up_sl_title = $_POST['sl_title'];
    $up_sl_photo1 = $_FILES['sl_photo1']['name'];
	$up_sl_photo1_tmp = $_FILES ['sl_photo1']['tmp_name'];
	$up_sl_photo2 = $_FILES['sl_photo2']['name'];
	$up_sl_photo2_tmp = $_FILES ['sl_photo2']['tmp_name'];
	$up_sl_description = $_POST['sl_description'];	
		
	if($up_sl_photo1=='' AND $up_sl_photo2==''){
		
        $update_slide = "UPDATE slider SET заглавие='$up_sl_title', описание='$up_sl_description' WHERE id='$sl_id'";
        
		if ($conn->query($update_slide) === TRUE) {
		
		echo "<script>alert('Промяната е направена успешно!');</script>";
		
		echo "<script>window.open('index.php?добави_слайд','_self');</script>";
		}
		exit();
	} else if($up_sl_photo1=='') {

        $update_slide = "UPDATE slider SET заглавие='$up_sl_title', снимка2='$up_sl_photo2', описание='$up_sl_description' WHERE id='$sl_id'";
        if ($conn->query($update_slide) === TRUE) {

        $photo_file = "../images/$sl_photo2";
		unlink($photo_file);
		
		$imgDir = "../images/$up_sl_photo2";
        
			if (move_uploaded_file($up_sl_photo2_tmp, $imgDir) === TRUE) {
			
			$resizeImage = new MyImages();
			$resizeImage->resizeAnImage($imgDir, 1920);

			echo "<script>alert('Промяната е направена успешно!');</script>";
			
			echo "<script>window.open('index.php?добави_слайд','_self');</script>";
			}
		exit();
		}
    } else if($up_sl_photo2=='') {

        $update_slide = "UPDATE slider SET заглавие='$up_sl_title', снимка1='$up_sl_photo1', описание='$up_sl_description' WHERE id='$sl_id'";
        if ($conn->query($update_slide) === TRUE) {

        $photo_file = "../images/$sl_photo1";
        unlink($photo_file);	
		
		$imgDir = "../images/$up_sl_photo1";

		if (move_uploaded_file($up_sl_photo1_tmp, $imgDir) === TRUE) {
			
			$resizeImage = new MyImages();
			$resizeImage->resizeAnImage($imgDir, 1920);
			
			echo "<script>alert('Промяната е направена успешно!');</script>";
			
			echo "<script>window.open('index.php?добави_слайд','_self');</script>";
		}
		}
		exit();
	}
	else {
		$update_slide = "UPDATE slider SET заглавие='$up_sl_title', снимка1='$up_sl_photo1', снимка2='$up_sl_photo2', описание='$up_sl_description' WHERE id='$sl_id'";
        if ($conn->query($update_slide) === TRUE) {

		$photo_file1 = "../images/$sl_photo1";
		$photo_file2 = "../images/$sl_photo2";
        unlink($photo_file1);	
		unlink($photo_file2);

		$imgDir1 = "../images/$up_sl_photo1";
		$imgDir2 = "../images/$up_sl_photo2";

		if (move_uploaded_file($up_sl_photo1_tmp, $imgDir1) === TRUE AND move_uploaded_file($up_sl_photo2_tmp, $imgDir2) === TRUE) {

			$resizeImage = new MyImages();
			$resizeImage->resizeAnImage($imgDir1, 1920);
			$resizeImage->resizeAnImage($imgDir2, 1920);

			echo "<script>alert('Промяната е направена успешно!');</script>";
			
			echo "<script>window.open('index.php?добави_слайд','_self');</script>";
		}
		}
	exit();
}
}
}?>

