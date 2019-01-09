<?php
include_once "db_includes.php";
include_once "MyImages.php";
@session_start();

if(!isset($_SESSION['име'])) {
	echo "<script>window.open('../login.php','_self')</script>";
} else {
?>

	<form action="includes/insert_news.php" method="post" enctype="multipart/form-data">
		
				<h2>Добавяне на Новина.</h2>

			<div class="row"><div class="title">Заглавие:</div><input type="text" name="title" size="60"></div>
			
			<div class="row"><div class="title">Снимка/картинка:</div><input type="file" name="image" accept=".png, .jpg, .jpeg"></div>

			<div class="row"><div class="title">Дата:</div><input type="date" name="date" size="60"></div>

			<div class="row"><div class="title">Категория:</div>
			<select name="category">
				<option>Избери категория</option>
				<option>Новини</option>
				<option>Обявления</option>
  			</select>
			</div>
			<div class="row"><div class="title">Описание:</div><textarea name="description" rows="10" cols="50"></textarea></div>
					
<input type="submit" name="submit" value="Добави"></td>
		
	</form>
	<table align="center">
		
	<tr>
		<th colspan="8">Всички новини</th>
	</tr>	
		<tr>
			<th>Номер</th>
			<th>Заглавие</th>
			<th>Снимка/картинка</th>
			<th>Дата</th>
			<th>Категория</th>
			<th>Описание</th>
			<th>Промени</th>
			<th>Изтрий</th>
		</tr>
<?php
	$get_news = "SELECT * FROM news";
	$run_news = $conn->query($get_news);
	
	while ($row_news= mysqli_fetch_array($run_news)) {
		
		$id = $row_news['id'];
		$category = $row_news['категория'];
		$description = substr($row_news['описание'],0,30);
		$date = $row_news['дата'];
		$image = $row_news['снимка'];
		$title = $row_news['заглавие'];
		
		$the_old_dir = str_replace('.', '',$title);
		$old_dir = str_replace(' ', '_',$the_old_dir);		
		
?>
		<tr>
		<td><?php echo $id; ?></td>
		<td><?php echo $title; ?></td>
		<td><img src="news_images/<?php echo $old_dir; ?>/<?php echo $image; ?>" width="80"><?php echo $image; ?></td>
		<td><?php echo $date; ?></td>
		<td><?php echo $category; ?></td>
		<td><?php echo $description; ?></td>
		<td><a href="index.php?промени_новина=<?php echo $title;?>">Промени</a</td>
		<td><a href="includes/delete_news.php?изтрий_новина=<?php echo $id; ?>">Изтрий</a></td>
		</tr>
		
<?php } ?>
</table>

	<?php
if(isset($_POST['submit'])) {
	
	$title = $_POST['title'];
	$image = $_FILES['image']['name'];
	$image_tmp = $_FILES ['image']['tmp_name'];
	$date = $_POST['date'];
	$category = $_POST['category'];
	$description = $_POST['description'];

	$the_dir = str_replace('.', '',$title);
	$new_dir = str_replace(' ', '_',$the_dir);

	$insert_news = "INSERT INTO news (категория, дата, описание, снимка, заглавие) 
	VALUES ('$category','$date','$description','$image','$title')";
	
	if ($conn->query($insert_news) === TRUE) {
			
	mkdir("../news_images/$new_dir");
	$imgDir = "../news_images/$new_dir/$image";


		if (move_uploaded_file($image_tmp,$imgDir) === TRUE) {
		
		$resizeImage = new MyImages();
		$resizeImage->resizeAnImage($imgDir, 1920);
			
		echo "<script>alert('Записът е  >Новини< направен успешно!');</script>";
				
		echo "<script>window.open('../index.php?добави_новина','_self');</script>";
		}
	}
}
}?>



