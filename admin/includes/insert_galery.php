<?php
include_once "db_includes.php";
include_once "MyImages.php";
@session_start();

if(!isset($_SESSION['име'])) {
	echo "<script>window.open('../login.php','_self')</script>";
} else {
?>

	<form action="includes/insert_galery.php" method="post" enctype="multipart/form-data">
		
		<h2>Добави в галерия.</h2>

		<div class="row"><div class="title">Заглавие:</div><input type="text" name="name" size="60"></div>

		<div class="row"><div class="title">Снимка:</div><input type="file" name="image" accept=".png, .jpg, .jpeg"></div>

		<div class="row"><div class="title">Дата:</div><input type="date" name="date" size="60"></div>

		<div class="row"><div class="title">Категория:</div>
		<select name="category">
			<option>Избери категория</option>
			<option>Състезания</option>
			<option>Тренировки</option>
			<option>Участия</option>
		</select>
		</div>
		<input type="submit" name="submit" value="Добави">

	</form>
	
	<table>
		
	<tr>
		<th colspan="7">Всички новини</th>
	</tr>	
	<tr>
		<th>Номер</th>
		<th>Заглавие</th>
		<th>Снимка/картинка</th>
		<th>Дата</th>
		<th>Категория</th>
		<th>Снимки</th>
		<th>Промени</th>
		<th>Изтрий</th>
	</tr>
<?php
	$get_galery = "SELECT * FROM gal_holders";
	$run_galery = $conn->query($get_galery);
	
		while ($row_galery=mysqli_fetch_array($run_galery)) {
			
			$id=$row_galery['id'];
			$name=$row_galery['заглавие'];
			$date=$row_galery['дата'];
			$cat=$row_galery['категория'];
			$photo=$row_galery['снимка'];
			
			$the_old_dir =str_replace('.', '',$name);	
			$old_dir = str_replace(' ', '_',$the_old_dir);			
?>
		<tr>
		<td><?php echo $id; ?></td>
		<td><?php echo $name; ?></td>
		<td><img src="galery_images/<?php echo $old_dir; ?>/<?php echo $photo; ?>" width="80"></td>
		<td><?php echo $date; ?></td>
		<td><?php echo $cat; ?></td>
		<td><a href="index.php?добави_снимки=<?php echo $id;?>">Снимки</a></td>
		<td><a href="index.php?промени_галерия=<?php echo $id;?>">Промени</a></td>
		<td><a href="includes/delete_galery.php?изтрий_галерия=<?php echo $id; ?>">Изтрий</a></td>
		</tr>
		
<?php } ?>
	</table>
	<?php
if(isset($_POST['submit'])) {
	
	$gal_name = $_POST['name'];
	$gal_image = $_FILES['image']['name'];
	$gal_image_tmp = $_FILES['image']['tmp_name'];
	$gal_date = $_POST['date'];
	$gal_cat = $_POST['category'];

	$the_new_dir = str_replace('.', '',$gal_name);	
	$new_dir = str_replace(' ', '_',$the_new_dir);		
			
		$insert_gal = "INSERT INTO gal_holders (дата, категория, заглавие, снимка) VALUES ('$gal_date','$gal_cat','$gal_name','$gal_image')";
	
		if ($conn->query($insert_gal) === TRUE) {
			
		mkdir("../galery_images/$new_dir");	
		
		$imgDir = "../galery_images/$new_dir/$gal_image";

		if (move_uploaded_file($gal_image_tmp, $imgDir) === TRUE) {

			$resizeImage = new MyImages();
			$resizeImage->resizeAnImage($imgDir, 1920);
		
			echo "<script>alert('Записът в >Галерия</ е направен успешно!');</script>";
			
			echo "<script>window.open('../index.php?добави_галерия','_self');</script>";
		}
		}	
	}
}?>

