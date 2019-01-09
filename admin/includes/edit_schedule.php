<?php
include_once "db_includes.php";
include_once "MyImages.php";
@session_start();

if(!isset($_SESSION['име'])) {
	echo "<script>window.open('../login.php','_self')</script>";
} else {
if(isset($_GET['промени_в_отбор'])) {
	
	$edit_id = $_GET['промени_в_отбор'];
	
	$select_kid = "SELECT * FROM schedule WHERE id='$edit_id'";
	
	$run_query = $conn->query($select_kid);
	
	while ($row_kid=mysqli_fetch_array($run_query)) {
		
		$id = $row_kid['id'];
		$category = $row_kid['категория'];
		$birthday = $row_kid['рождена_дата'];
		$description = $row_kid['описание'];
		$photo1 = $row_kid['снимка1'];
		$photo2 = $row_kid['снимка2'];
		$firstName = $row_kid['име'];
		$lastName = $row_kid['фамилия'];

		$old_dir = $firstName."_".$lastName;
	}	
}

?>

	<form action="" method="post" enctype="multipart/form-data">

		<h2>Промяна на обект:</h2>

		<div class="row"><div class="title">Име:</div><input type="text" name="firstName" size="60" value="<?php echo $firstName; ?>"></div>

		<div class="row"><div class="title">Фамилия:</div><input type="text" name="lastName" size="60" value="<?php echo $lastName; ?>"></div>

		<div class="row"><div class="title">Снимка:</div><input type="file" name="photo1" accept=".png, .jpg, .jpeg"><img src="object_images/<?php echo $old_dir; ?>/<?php echo $photo1; ?> " width="60"/><?php echo $photo1; ?></div>

		<div class="row"><div class="title">Снимка2:</div><input type="file" name="photo2" accept=".png, .jpg, .jpeg"><img src="object_images/<?php echo $old_dir; ?>/<?php echo $photo2; ?> " width="60"/><?php echo $photo2; ?></div>

		<div class="row"><div class="title">Години:</div><input type="date" name="birthday" size="60" value="<?php echo $birthday; ?>"></div>

		<div class="row"><div class="title">Категория:</div>
		<select name="category">
			<option><?php echo $category; ?></option>
			<option>Треньори</option>
			<option>Състезатели</option>
		</select>
		</div>

		<div class="row"><div class="title">Описание:</div><textarea name="description" rows="10" cols="50"><?php echo $description; ?></textarea></div>

		<input type="submit" name="update" value="Промени сега!"/>

	</form>

	<?php
if(isset($_POST['update'])) {

	$up_firstName = $_POST['firstName'];
	$up_lastName = $_POST['lastName'];
	$up_photo1 = $_FILES['photo1']['name'];
	$up_photo1_tmp = $_FILES ['photo1']['tmp_name'];
	$up_photo2 = $_FILES['photo2']['name'];
	$up_photo2_tmp = $_FILES ['photo2']['tmp_name'];
	$up_birthday = $_POST['birthday'];
	$up_category = $_POST['category'];
	$up_description= $_POST['description'];	
	
	$new_dir = $up_firstName."_".$up_lastName;
	
	$resizeImage = new MyImages();
	$editImage1 = "object_images/$new_dir/$up_photo1";
	$editImage2 = "object_images/$new_dir/$up_photo2";
		
	if($up_photo1=='' AND $up_photo2=='') {
	
		$update_kid = "UPDATE schedule SET име='$up_firstName', категория='$up_category', описание='$up_description', рождена_дата='$up_birthday', фамилия='$up_lastName' WHERE id='$id'";
		
		if ($conn->query($update_kid) === true){
		
		if(rename ("object_images/$old_dir" , "object_images/$new_dir") === TRUE) {
	
			echo "<script>alert('Промяната е направена успешно!');</script>";
			
			echo "<script>window.open('index.php?добави_в_отбор','_self');</script>";
		}
		}
		exit();
	} else if($up_photo2=='') {
		
		$update_kid = "UPDATE schedule SET име='$up_firstName', категория='$up_category', описание='$up_description', рождена_дата='$up_birthday', снимка1='$up_photo1', фамилия='$up_lastName' WHERE id='$id'";
		
			if ($conn->query($update_kid)=== true){
			
				rename ("object_images/$old_dir" , "object_images/$new_dir");

				$photo_file = "object_images/$new_dir/$photo1";
				unlink($photo_file);	
					
				if (move_uploaded_file($up_photo1_tmp,$editImage1) === TRUE) {
					$resizeImage->resizeAnImage($editImage1, 1920);
					
					echo "<script>alert('Промяната е направена успешно!');</script>";
						
					echo "<script>window.open('index.php?добави_в_отбор','_self');</script>";
				}
				exit();
			}
			
		} else if($up_photo1=='') {
		
		$update_kid = "UPDATE schedule SET име='$up_firstName', категория='$up_category', описание='$up_description', рождена_дата='$up_birthday', снимка2='$up_photo2', фамилия='$up_lastName' WHERE id='$id'";
		
			if ($conn->query($update_kid)=== true){
			
				rename ("object_images/$old_dir" , "object_images/$new_dir");
			
				$photo_file2 = "object_images/$new_dir/$photo2";
				unlink($photo_file2);
				
				if (move_uploaded_file($up_photo2_tmp, $editImage2) === TRUE) {
					$resizeImage->resizeAnImage($editImage2, 1920);

					echo "<script>alert('Промяната е направена успешно!');</script>";
					
					echo "<script>window.open('index.php?добави_в_отбор','_self');</script>";
				}
				exit();
			}
		} else {
		
			$update_kid = "UPDATE schedule SET име='$up_firstName', категория='$up_category', описание='$up_description', рождена_дата='$up_birthday', снимка1='$up_photo1', снимка2='$up_photo2', фамилия='$up_lastName' WHERE id='$id'";
		
			if ($conn->query($update_kid)=== true){
			
			rename ("object_images/$old_dir" , "object_images/$new_dir");	
					
			$photo_file = "object_images/$new_dir/$photo1";
			unlink($photo_file);	
			$photo_file2 = "object_images/$new_dir/$photo2";
			unlink($photo_file2);
		
			if (move_uploaded_file($up_photo1_tmp, $editImage1) === TRUE AND move_uploaded_file($up_photo2_tmp, $editImage2) === TRUE) {		
				$resizeImage->resizeAnImage($editImage1, 1920);		
				$resizeImage->resizeAnImage($editImage2, 1920);
				
				echo "<script>alert('Промяната е направена успешно!');</script>";
					
				echo "<script>window.open('index.php?добави_в_отбор','_self');</script>";
			}
			exit();
		
		}
	
	}

}	
}?>

