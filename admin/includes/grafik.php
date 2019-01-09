<?php
include_once "db_includes.php";
@session_start();

if(!isset($_SESSION['име'])) {
	echo "<script>window.open('../login.php','_self')</script>";
} else {

	$select_tr = "SELECT * FROM trainings";
	
	$run_tr = $conn->query($select_tr);
		
	while ($row_tr=mysqli_fetch_array($run_tr)) {
		
		$tr_id = $row_tr['id'];
		$mon = $row_tr['понеделник'];
		$tue = $row_tr['вторник'];
		$wen = $row_tr['сряда'];
		$thr = $row_tr['четвъртък'];
		$fri = $row_tr['петък'];
		$sat = $row_tr['събота'];
		$sun = $row_tr['неделя'];
		$mon1 = $row_tr['понеделник1'];
		$tue1 = $row_tr['вторник1'];
		$wen1 = $row_tr['сряда1'];
		$thr1 = $row_tr['четвъртък1'];
		$fri1 = $row_tr['петък1'];
		$sat1 = $row_tr['събота1'];
		$sun1 = $row_tr['неделя1'];
	
	}

?>

	<form action="" method="post" enctype="multipart/form-data">
		
				<h2>Състезатели.</h2>

			<div class="row"><div class="title">Понеделник:</div><input type="text" name="mon" size="60" value="<?php echo $mon; ?>"></div>

			<div class="row"><div class="title">Вторник:</div><input type="text" name="tue" size="60" value="<?php echo $tue; ?>"></div>

			<div class="row"><div class="title">Сряда:</div><input type="text" name="wen" size="60" value="<?php echo $wen; ?>"></div>

			<div class="row"><div class="title">Четвъртък:</div><input type="text" name="thr" size="60" value="<?php echo $thr; ?>"></div>

			<div class="row"><div class="title">Петък:</div><input type="text" name="fri" size="60" value="<?php echo $fri; ?>"></div>

			<div class="row"><div class="title">Събота:</div><input type="text" name="sat" size="60" value="<?php echo $sat; ?>"></div>

			<div class="row"><div class="title">Неделя:</div><input type="text" name="sun" size="60" value="<?php echo $sun; ?>"></div>

				<h2>Подготвителни групи.</h2>

			<div class="row"><div class="title">Понеделник:</div><input type="text" name="mon1" size="60" value="<?php echo $mon1; ?>"></div>

			<div class="row"><div class="title">Вторник:</div><input type="text" name="tue1" size="60" value="<?php echo $tue1; ?>"></div>

			<div class="row"><div class="title">Сряда:</div><input type="text" name="wen1" size="60" value="<?php echo $wen1; ?>"></div>

			<div class="row"><div class="title">Четвъртък:</div><input type="text" name="thr1" size="60" value="<?php echo $thr1; ?>"></div>

			<div class="row"><div class="title">Петък:</div><input type="text" name="fri1" size="60" value="<?php echo $fri1; ?>"></div>

			<div class="row"><div class="title">Събота:</div><input type="text" name="sat1" size="60" value="<?php echo $sat1; ?>"></div>

			<div class="row"><div class="title">Неделя:</div><input type="text" name="sun1" size="60" value="<?php echo $sun1; ?>"></div>

		<input type="submit" name="update" value="Промени сега!"/>

	</form>

<?php

	if(isset($_POST['update'])) {
	$up_mon = $_POST['mon'];
	$up_tue = $_POST['tue'];
	$up_wen = $_POST['wen'];
	$up_thr = $_POST['thr'];
	$up_fri = $_POST['fri'];
	$up_sat = $_POST['sat'];
	$up_sun = $_POST['sun'];
	$up_mon1 = $_POST['mon1'];
	$up_tue1 = $_POST['tue1'];
	$up_wen1 = $_POST['wen1'];
	$up_thr1 = $_POST['thr1'];
	$up_fri1 = $_POST['fri1'];
	$up_sat1 = $_POST['sat1'];
	$up_sun1 = $_POST['sun1'];
	
	if ($up_mon=='' OR $up_tue=='' OR $up_wen=='' OR $up_thr=='null' OR $up_fri=='' OR $up_sat=='' OR $up_sun=='' OR 
	$up_mon1=='' OR $up_tue1=='' OR $up_wen1=='' OR $up_thr1=='null' OR $up_fri1=='' OR $up_sat1=='' OR $up_sun1=='') {
		
				echo "<script>alert('Моля попълнете всички полета!');</script>";
		exit();
	}
	else {
		$update_tr = "UPDATE trainings SET понеделник='$up_mon', вторник='$up_tue', сряда='$up_wen', четвъртък='$up_thr', петък='$up_fri', събота='$up_sat', неделя='$up_sun', понеделник1='$up_mon1', вторник1='$up_tue1', сряда1='$up_wen1', четвъртък1='$up_thr1', петък1='$up_fri1', събота1='$up_sat1', неделя1='$up_sun1' WHERE id='$tr_id'";
		
		if ($conn->query($update_tr) === TRUE) {
		echo "<script>alert('Промяната е направена успешно!');</script>";
		
		echo "<script>window.open('http://club-chernomoretz.com/admin/index.php?grafik','_self');</script>";
	}
	}
	
}

}?>