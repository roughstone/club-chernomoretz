<?php
include_once "db_includes.php";
@session_start();

if(!isset($_SESSION['име'])) {
	echo "<script>window.open('../login.php','_self')</script>";
} else {
?>

<form action="includes/insert_video.php" method="post" enctype="multipart/form-data">
	
	<h2>Добави в видео.</h2>

	<div class="row"><div class="title">Заглавие:</div><input type="text" name="name" size="60"></div>

	<div class="row"><div class="title">Дата:</div><input type="date" name="date" size="60"></div>

	<div class="row"><div class="title">Снимка:</div><input type="file" name="photo" accept=".png, .jpg, .jpeg"></div>

	<div class="row"><div class="title">Категория:</div>
		<select name="category">			 
			<option>изберете категория</option>
			<option>състезания</option>
			<option>тренировки</option>
			<option>участия</option>
		</select>
	</div>

	<div class="row"><div class="title">Линк:</div><input type="text" name="link" size="60"></div>
			
	<input type="submit" name="submit" value="Добави">

</form>
	
<table>
		
<tr>
	<th colspan="7">Всички новини</th>
</tr>	
	<tr>
		<th>Номер</th>
		<th>Заглавие</th>
		<th>Дата</th>
		<th>Снимка</th>
		<th>Категория</th>
		<th>Изтрий</th>
	</tr>
<?php
$get_galery = "SELECT * FROM video";
$run_galery = $conn->query($get_galery);
	
	while ($row_galery=mysqli_fetch_array($run_galery)) {
			
		$id=$row_galery['id'];
		$name=$row_galery['заглавие'];
		$date=$row_galery['дата'];
		$cat=$row_galery['категория'];
		$image=$row_galery['снимка'];
		$vid_link=$row_galery['линк'];
			
		$dir = str_replace(' ', '_',$name);
						
?>
	<tr>
		<td><?php echo $id; ?></td>
		<td><?php echo $name; ?></td>
		<td><?php echo $date; ?></td>
		<td><img src="video_images/<?php echo $dir; ?>/<?php echo $image; ?>" width="80"><?php echo $image; ?></td>
		<td><?php echo $cat; ?></td>
		<td><a href="includes/delete_video.php?delete_video=<?php echo $id; ?>">Изтрий</a></td>
	</tr>

<?php
}
if(isset($_POST['submit'])) {
	
	$vid_name = $_POST['name'];
	$vid_date = $_POST['date'];
	$vid_photo = $_FILES['photo']['name'];
	$vid_photo_tmp = $_FILES ['photo']['tmp_name'];
	$vid_link = $_POST['link'];
	$vid_cat = $_POST['category'];

	$new_dir = str_replace(' ', '_',$vid_name);	
	
	if ($vid_name=='' OR $vid_link=='' OR $vid_date=='' OR $vid_cat=='' OR $vid_photo=='') {
		
		echo "<script>alert('Моля попълнете всички полета!');</script>";
		exit();
	}
	else {
		
		$insert_vid = "INSERT INTO video (дата, категория, заглавие, линк, снимка) 
		VALUES ('$vid_date','$vid_cat','$vid_name','$vid_link','$vid_photo')";
		
		if ($conn->query($insert_vid) === TRUE) {
		
			mkdir("../video_images/$new_dir");
			
			$imgDir = "../video_images/$new_dir/$vid_photo";

			if (move_uploaded_file($vid_photo_tmp, $imgDir) === TRUE) {
					
				$resizeImage = new MyImages();
				$resizeImage->resizeAnImage($imgDir, 1920);

				echo "<script>alert('Записът в Видео е направен успешно!');</script>";
			
				echo "<script>window.open('../index.php?добави_видео','_self');</script>";
			}
		}
	
	}
	
}
} 
?>

