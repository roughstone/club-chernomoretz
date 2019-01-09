<div class="slidersContrainer">
<?php
$select = 'SELECT * FROM slider';
$run_query = $conn->query($select);   

while ($data=mysqli_fetch_array($run_query)) {
    $id =  $data['id'];
    $title = $data['заглавие'];
    $image1 = $data['снимка1'];
    $image2 = $data['снимка2'];
    $description = $data['описание'];

    echo "
    <div class='slide' onClick='$(\"#slFrameId$id\").fadeIn(400); $(\"#slFrameId$id\").addClass(\"visible\")'>
    <div class='activeGrid'>
    <div><p>$title</p></div>
    <div><img src='images/$image1' alt='$title'></div>
    <div>$description</div>
    <div>...</div>
    </div>
    </div>
    ";
}
?>
</div>
<div class="slideFrames">
<?php
$select = 'SELECT * FROM slider';
$run_query = $conn->query($select);   

while ($data=mysqli_fetch_array($run_query)) {
    $id =  $data['id'];
    $title = $data['заглавие'];
    $image1 = $data['снимка1'];
    $image2 = $data['снимка2'];
    $description = $data['описание'];

    echo "
    <div class='slideFrame' id='slFrameId$id'>
    <div class='slideGridFrame'>
    <div>$title</div>
    <div><img src='images/$image1' alt='$title'></div>
    <div><img src='images/$image2' alt='$title'></div>
    <div>$description</div>
    <div><img src='images/closebtn.png' alt='$title' onClick='$(\".visible\").fadeOut(100)'></div>    
    <div class='rightArrow'> > </div>
    <div class='leftArrow'> < </div>
    </div>
    </div>
    ";
}
?>
</div>