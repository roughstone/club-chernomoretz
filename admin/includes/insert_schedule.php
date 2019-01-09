<?php
include_once "db_includes.php";
include_once "MyImages.php";
@session_start();

if(!isset($_SESSION['име'])) {
	echo "<script>window.open('../login.php','_self')</script>";
} else {
?>
	<form action="includes/insert_schedule.php" method="post" enctype="multipart/form-data">

				<h2>Добавяне на дете.</h2>

			<div class="row"><div class="title">Име:</div><input type="text" name="firstName" size="60"></div>

			<div class="row"><div class="title">Фамилия:</div><input type="text" name="lastName" size="60"></div>

			<div class="row"><div class="title">Снимка:</div><input type="file" name="photo1" accept=".png, .jpg, .jpeg"></div>

			<div class="row"><div class="title">Снимка2:</div><input type="file" name="photo2" accept=".png, .jpg, .jpeg"></div>

			<div class="row"><div class="title">Роден на:</div><input type="date" name="birhtday" size="60"></div>

			<div class="row"><div class="title">Категория:</div>
			<select name="category">
				<option>Избери категория</option>
				<option>Треньори</option>
				<option>Състезатели</option>
			</select>
			</div>

			<div class="row"><div class="title">Описание:</div><textarea name="description" rows="10" cols="50"></textarea></div>

			<input type="submit" name="submit" value="Добави">
				
	</form>
		
<table>	
	<tr>
		<th colspan="9">Всички обекти</th>
	</tr>	
		<tr>
			<th>Номер</th>
			<th>Име</th>
			<th>Фамилия</th>
			<th>Снимка</th>
			<th>Снимка2</th>
			<th>Години</th>
			<th>Категория</th>
			<th>Описание</th>
			<th>Промени</th>
			<th>Изтрий</th>
		</tr>

<?php
	$get_kids = "SELECT * FROM schedule";
	$run_kids = $conn->query($get_kids);
	
	while ($row_kids= mysqli_fetch_array($run_kids)) {
		
		$id = $row_kids['id'];
		$category = $row_kids['категория'];
		$description = substr($row_kids['описание'],0,30);
		$firstName = $row_kids['име'];
		$lastName = $row_kids['фамилия'];
		$photo1 = $row_kids['снимка1'];
		$photo2 = $row_kids['снимка2'];
		$birthday = $row_kids['рождена_дата'];
		
		$old_dir = $firstName."_".$lastName;
		
?>
		<tr>
		<td><?php echo $id; ?></td>
		<td><?php echo $firstName; ?></td>
		<td><?php echo $lastName; ?></td>
		<td><img src="object_images/<?php echo $old_dir; ?>/<?php echo $photo1; ?>" width="80"></td>
		<td><img src="object_images/<?php echo $old_dir; ?>/<?php echo $photo2; ?>" width="80"></td>
		<td><?php echo $birthday; ?></td>
		<td><?php echo $category; ?></td>
		<td><?php echo $description; ?></td>
		<td><a href="index.php?промени_в_отбор=<?php echo $id; ?>">Промени</a></td>
		<td><a href="includes/delete_schedule.php?delete_schedule=<?php echo $id; ?>">Изтрий</a></td>
		</tr>
		
<?php } ?>
</table>

	<?php
if(isset($_POST['submit'])) {
	
	$ch_Fname = $_POST['firstName'];
	$ch_Lname = $_POST['lastName'];
	$ch_image = $_FILES['photo1']['name'];
	$ch_image_tmp = $_FILES ['photo1']['tmp_name'];
	$ch_image2 = $_FILES['photo2']['name'];
	$ch_image2_tmp = $_FILES ['photo2']['tmp_name'];
	$ch_birthday = $_POST['birhtday'];
	$ch_cat = $_POST['category'];
	$ch_disc = $_POST['description'];	
	
	$ch_name_dir = $ch_Fname."_".$ch_Lname;
	
	if ($ch_Fname=='' OR $ch_Lname=='' OR $ch_image=='' OR $ch_birthday=='' OR $ch_cat=='' OR $ch_disc=='') {
		
		echo "<script>alert('Моля попълнете всички полета!');</script>";
		exit();
	}
	else {
		
		$insert_kids = "INSERT INTO schedule (име, категория, описание, рождена_дата, снимка1, снимка2, фамилия) 
		VALUES ('$ch_Fname','$ch_cat','$ch_disc','$ch_birthday','$ch_image','$ch_image2','$ch_Lname')";
	
		if ($conn->query($insert_kids) === TRUE) {
			
		mkdir("../object_images/$ch_name_dir");

		$editImage1 = "../object_images/$ch_name_dir/$ch_image";
		$editImage2 = "../object_images/$ch_name_dir/$ch_image2";
			
		if (move_uploaded_file($ch_image_tmp,$editImage1) === TRUE AND move_uploaded_file($ch_image2_tmp,$editImage2) === TRUE) {

			$resizeImage = new MyImages();
			$resizeImage->resizeAnImage($editImage1, 1920);
			$resizeImage->resizeAnImage($editImage2, 1920);

			echo "<script>alert('Записът в >Обекти</ е направен успешно!');</script>";
			
			echo "<script>window.open('../index.php?добави_в_отбор','_self');</script>";
		}			
		}		
	}	
}
}?>

