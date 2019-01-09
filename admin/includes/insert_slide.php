<?php
include_once "db_includes.php";
include_once "MyImages.php";
@session_start();

if(!isset($_SESSION['име'])) {
	echo "<script>window.open('../login.php','_self')</script>";
} else {
?>
    <form action="includes/insert_slide.php" method="post" enctype="multipart/form-data">

        <h2>Добавяне на слайд.</h2>

        <div class="row"><div class="title">Заглавие:</div><input type="text" name="title" size="60"></div>

        <div class="row"><div class="title">Снимка/картинка 1:</div><input type="file" name="photo1" accept=".png, .jpg, .jpeg"></div>

        <div class="row"><div class="title">Снимка/картинка 2:</div><input type="file" name="photo2" accept=".png, .jpg, .jpeg"></div>

        <div class="row"><div class="title">Описание:</div><textarea name="description" rows="10" cols="50"></textarea></div>

        <input type="submit" name="submit" value="Добави"></td>

    </form>

    <table>
		
        <tr>
            <th colspan="9">Всички обекти</th>
        </tr>	
            <tr>
                <th>Заглавие</th>
                <th>Снимка1</th>
                <th>Снимка2</th>
                <th>Описание</th>
                <th>Промени</th>
                <th>Изтрий</th>
            </tr>
    
    <?php
        $get_slider = "SELECT * FROM slider";
        $run_slider = $conn->query($get_slider);
        
        while ($row_slider= mysqli_fetch_array($run_slider)) {
            
            $sl_id = $row_slider['id'];
            $sl_title = $row_slider['заглавие'];
            $sl_photo1 = $row_slider['снимка1'];
            $sl_photo2 = $row_slider['снимка2'];
            $sl_description = substr($row_slider['описание'],0,30);

    ?>
            <tr>
            <td><?php echo $sl_title; ?></td>
            <td><img src="../images/<?php echo $sl_photo1; ?>" width="80"></td>
            <td><img src="../images/<?php echo $sl_photo2; ?>" width="80"></td>
            <td><?php echo $sl_description; ?></td>
            <td><a href="index.php?промени_слайд=<?php echo $sl_id; ?>">Промени</a></td>
            <td><a href="includes/delete_slide.php?изтрий_слайд=<?php echo $sl_id; ?>">Изтрий</a></td>
            </tr>
            
    <?php } ?>
    </table>

<?php

    if(isset($_POST['submit'])) {
        $sl_title = $_POST['title'];
        $sl_image1 = $_FILES['photo1']['name'];
        $sl_image1_tmp = $_FILES['photo1']['tmp_name'];
        $sl_image2 = $_FILES['photo2']['name'];
        $sl_image2_tmp = $_FILES['photo2']['tmp_name'];
        $sl_description = $_POST['description'];

        $insert_slide = "INSERT INTO slider (заглавие, снимка1, снимка2, описание) VALUES('$sl_description','$sl_image1','$sl_image2','$sl_title')";

        if ($conn->query($insert_slide) === TRUE) {
            $imgDir1="../../images/$sl_image1";
            $imgDir2="../../images/$sl_image2";
            if (move_uploaded_file($sl_image1_tmp, $imgDir1) === TRUE AND move_uploaded_file($sl_image2_tmp, $imgDir2) === TRUE) {
            $resizeImage = new MyImages();
            $resizeImage->resizeAnImage($imgDir1, 1920);
            $resizeImage->resizeAnImage($imgDir2, 1920);

            echo "<script>alert('Записът е направен успешно!');</script>";
            echo "<script>window.open('../index.php?добави_слайд','_self');</script>";
            }
        } else {
            echo "<script>alert('ВЪзникна грешка моля опитайте по късно!');</script>";
            echo "<script>window.open('../index.php?добави_слайд','_self');</script>";
        }

    }

}
?>