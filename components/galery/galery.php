<div class="galeryContainer">
<?php
if(isset($_GET['галерии'])) {
    $galeryType = $_GET['галерии'];
    $select = "SELECT * FROM gal_holders WHERE категория='$galeryType'";
    $run_query = $conn->query($select);   

    while ($data=mysqli_fetch_array($run_query)) {
        $id = $data['id'];
        $title = $data['заглавие'];
        $date = $data['дата'];
        $image = $data['снимка'];
        $category = $data['категория'];

        $the_dir =str_replace('.', '',$title);	
        $dir = str_replace(' ', '_',$the_dir);
        $css_idd = $dir.$date;

        echo "        
        <div class='galHolder' onClick='$(\"#$dir\").fadeIn(400)'>
        <div>$title</div>
        <div>дата: $date</div>
        <img src='admin/galery_images/$dir/$image' alt='$title'>
        </div>


        <div class='galery' id='$dir'>
        <div class='galeryFrameGrid'>
        <div class='close_btn'><img src='images/closebtn.png' alt='$title' onClick='$(\"#$dir\").fadeOut(400)'></div>

        <div class='small_img_holder'>
        <div class='small_img' onClick='$(\".show_image\").removeClass(\"show_image\");$(\"#$css_idd\").addClass(\"show_image\")'>
        <img src='admin/galery_images/$dir/$image' alt='$title'>
        </div>
        ";
        
        $photos = "SELECT * FROM photos WHERE gal_holder_id='$id'";
        $run_photos_query = $conn->query($photos);   
        while ($photo_data = mysqli_fetch_array($run_photos_query)) {
            $photo_id = $photo_data['id'];
            $photo_title = $photo_data['заглавие'];
            $photo_image = $photo_data['снимка'];

            $create_id =str_replace('.', '',$photo_title);	
            $css_id = str_replace(' ', '_',$create_id). $photo_id;

            echo "     
                <div class='small_img' onClick='$(\".show_image\").removeClass(\"show_image\");$(\"#$css_id\").addClass(\"show_image\")'>          
                <img src='admin/galery_images/$dir/$photo_image' alt='$photo_title'>
                </div>
            ";     
        }
        echo "</div>
        <div class='hidden_img show_image' id='$css_idd'>
        <img src='admin/galery_images/$dir/$image' alt='$title'>
        </div>";
        $photos = "SELECT * FROM photos WHERE gal_holder_id='$id'";
        $run_photos_query = $conn->query($photos);   
        while ($photo_data = mysqli_fetch_array($run_photos_query)) {
            $photo_id = $photo_data['id'];
            $photo_title = $photo_data['заглавие'];
            $photo_image = $photo_data['снимка'];

            $create_id =str_replace('.', '',$photo_title);	
            $css_id = str_replace(' ', '_',$create_id). $photo_id;

            echo "     
                <div class='hidden_img' id='$css_id'>
                <img src='admin/galery_images/$dir/$photo_image' alt='$photo_title'>
                </div>
            ";     
        }
        echo "</div></div>";
    }
}
?>
</div>
