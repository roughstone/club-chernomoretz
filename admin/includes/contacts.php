<?php
include_once "db_includes.php";
@session_start();

if(!isset($_SESSION['име'])) {
	echo "<script>window.open('../login.php','_self')</script>";
} else {
?>

<?php
	
	$select_main = "SELECT * FROM contacts";
	
	$run_query = $conn->query($select_main);
	
	while ($row_main=mysqli_fetch_array($run_query)) {
		
		$id = $row_main['id'];
		$adres = $row_main['адрес'];
		$email = $row_main['емейл'];
		$tel1 = $row_main['телефон1'];
		$tel2 = $row_main['телефон2'];	
	}
	


?>
<form action="includes/contacts.php" method="post" enctype="multipart/form-data">
	
	<h2>Заглавна страница.</h2>
	<div class="row"><div class="title">Телефон:</div><input type="text" name="tel1" size="60" value="<?php echo $tel1; ?>"></div>
	
	<div class="row"><div class="title">Телефон 2:</div><input type="text" name="tel2" size="60" value="<?php echo $tel2; ?>"></div>
	
	<div class="row"><div class="title">Адрес:</div><input type="text" name="adres" size="60" value="<?php echo $adres; ?>"></div>
	
	<div class="row"><div class="title">Емайл:</div><input type="text" name="email" size="60" value="<?php echo $email; ?>"></div>
	
	<input type="submit" name="submit" value="Промени"/>
	
</form>

<?php
if(isset($_POST['submit'])) {
	
	$up_tel1 = $_POST['tel1'];
	$up_tel2 = $_POST['tel2'];
	$up_adres = $_POST['adres'];
	$up_email = $_POST['email'];

	if ($up_tel1=='' OR $up_tel2=='' OR $up_adres=='' OR $up_email=='') {

		echo "<script>alert('Моля попълнете всички полета!');</script>";

	} else {
		
	$update_main = "UPDATE contacts SET телефон1='$up_tel1', телефон2='$up_tel2', адрес='$up_adres', емейл='$up_email' WHERE id='$id'";
		
		if ($conn->query($update_main)=== true){

		echo "<script>alert('Промяната е направена успешно!');</script>";
		
		echo "<script>window.open('../index.php?контакти','_self');</script>";

		}
	}
}
}?>
