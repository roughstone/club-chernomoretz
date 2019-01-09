<?php
include '../includes/Dbh.php';
include 'Admin.php';
session_start();
?>

<!doctype html>
<head>


	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login Form</title>
	<meta name="description" content="">
	<meta name="author" content="">

	

	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
	

	<link rel="stylesheet" href="../styles/base1.css">
	<link rel="stylesheet" href="../styles/skeleton.css">
	<link rel="stylesheet" href="../styles/layout.css">
	
</head>
<body>


	<div class="container">
		
		<div class="form-bg">
			<form method="post" action="login.php">
				<h2>Login</h2>
				
				<p><input type="text" name="admin_name" placeholder="Потребителско име:"></p>
				
				<p><input type="password" name="admin_password" placeholder="Парола:"></p>
				<input type="submit" name="login" value="Admin login"/>
			<form>
		</div>


	</div>


</body>
</html>

<?php

if(isset($_POST['login'])) {
	$admin = new Admin();
	$admin->setTheAdmin(); 
}
?>