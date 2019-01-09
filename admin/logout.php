<?php
session_start();
?>
<!DOCTYPE html>
<html>
<body>
<?php
session_destroy();

echo"<script>window.open('../index.php','_self')</script>";
?>
</body>
</html>