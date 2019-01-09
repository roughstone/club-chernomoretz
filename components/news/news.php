<div class="newsContainer">
<?php
$select = 'SELECT * FROM news WHERE категория="Новини"';
$run_query = $conn->query($select);   

while ($data=mysqli_fetch_array($run_query)) {
    $title = $data['заглавие'];
    $date = $data['дата'];
    $image = $data['снимка'];
    $description = $data['описание'];

    $the_dir = str_replace('.', '',$title);
    $dir = str_replace(' ', '_',$the_dir);

    echo "
    <div class='news'>
    <div onClick='$(\"#$dir\").fadeIn(400)'>
    <h2>$title</h2>
    <div class='news_image'>
    <img src='admin/news_images/$dir/$image' alt='$title'>
    </div>
    <p>Виж тук...</p>
    <h3>дата: $date</h3>
    </div>  
    </div>
    <div class='bigNewsFrame' id=$dir>
    <div class='newsGrid'>
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
