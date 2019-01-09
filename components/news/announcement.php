<div class="announcementContainer">
    <h1>Обявления:</h1>
<?php
$select = 'SELECT * FROM news WHERE категория="Обявления"';
$run_query = $conn->query($select);   

while ($data=mysqli_fetch_array($run_query)) {
    $title = $data['заглавие'];
    $date = $data['дата'];
    $image = $data['снимка'];
    $description = $data['описание'];

    $the_dir = str_replace('.', '',$title);
    $dir = str_replace(' ', '_',$the_dir);

    echo "
    <div class='announcement'>
    <div onClick='$(\"#$dir\").fadeIn(400)'>
    <img src='admin/news_images/$dir/$image' alt='$title'>
    <h2>$title</h2>
    <p>Виж тук...</p>
    <h3>Дата: $date</h3>
    </div>
    </div>  
    <div class='bigAnnouncementFrame' id=$dir>
    <div class='announcementGrid'>
    <div><img src='images/closebtn.png' onClick='$(\"#$dir\").fadeOut(400)'></div>
    <div>$title</div> 
    <div><img src='admin/news_images/$dir/$image' alt='$title'></div> 
    <div>$description</div> 
    <div>дата: $date</div> 
    </div>  
    </div>  
    ";
}
?>
</div>
