<!DOCTYPE html>
<?php
include_once  "admin/includes/db_includes.php";
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html" charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!--
<link rel="stylesheet" type="text/css" href="styles/style_index12.css">
-->
<link rel="stylesheet" type="text/css" href="index001.css">
<link rel="stylesheet" type="text/css" href="./components/header/header002.css">
<link rel="stylesheet" type="text/css" href="./components/navigation/navigation004.css">
<link rel="stylesheet" type="text/css" href="./components/slider/slider015.css">
<link rel="stylesheet" type="text/css" href="./components/news/announcement005.css">
<link rel="stylesheet" type="text/css" href="./components/news/news005.css">
<link rel="stylesheet" type="text/css" href="./components/footer/footer003.css">
<link rel="stylesheet" type="text/css" href="./components/schedule/schedule102.css">
<link rel="stylesheet" type="text/css" href="./components/trainings/trainings003.css">
<link rel="stylesheet" type="text/css" href="./components/galery/galery015.css">
<link rel="stylesheet" type="text/css" href="./components/contacts/contacts002.css">
<link href="https://fonts.googleapis.com/css?family=Amatic+SC|Bad+Script|Caveat|Cormorant+Infant|Kelly+Slab|Lobster|Seymour+One|Stalinist+One" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="scripts/slider003.js" charset="UTF-8"></script>

<title>Черноморец бургас - клуб по гимнастически спортове</title>
</head>
<body>

<?php
    include("./components/header/header.php");
    include("./components/navigation/navigation.php");
    include("./components/contacts/contacts.php");
?>
<div class="contents">
<?php
    if(isset($_GET['треньори']) OR isset($_GET['състезатели']) OR isset($_GET['Състезатели-id']) OR isset($_GET['Треньори-id'])) {
		include_once("./components/schedule/schedule.php");
        }
    else if(isset($_GET['галерии'])) {
	    include("./components/galery/galery.php");
        } 
    else if(isset($_GET['график'])) {
        include("./components/trainings/trainings.php");
        } 
    else if(isset($_GET['новини'])) {
        include("./components/news/news.php");
        include("./components/news/announcement.php");
        } 
    else {
        include("./components/slider/slider.php"); 
        include("./components/news/announcement.php");
    }
?>
</div>
<?php
    include("./components/footer/footer.php");
?>
</body>
</html>