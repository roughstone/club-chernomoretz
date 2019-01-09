<div class="scheduleContainer">
<?php

function getAge($then) {
    $then_ts = strtotime($then);
    $then_year = date('Y', $then_ts);
    $age = date('Y') - $then_year;
    if(strtotime('+' . $age . ' years', $then_ts) > time()) $age--;
    return $age;
}

    if(isset($_GET['треньори'])) {    
	    $select = 'SELECT * FROM schedule WHERE категория="Треньори"';
        $run_query = $conn->query($select);   
    }
    if(isset($_GET['състезатели'])) {    
        $select = 'SELECT * FROM schedule WHERE категория="Състезатели" ORDER BY име ASC';
        $run_query = $conn->query($select);   
        }
    
    while ($data=mysqli_fetch_array($run_query)) {
        $id = $data['id'];
        $description = $data['описание'];
        $image1 = $data['снимка1'];
        $image2 = $data['снимка2'];
        $name = $data['име'];
        $family = $data['фамилия'];
        $birthday = $data['рождена_дата'];
        $category = $data['категория'];

        $yeasrs = getAge($birthday);

        $dir = $name.'_'.$family;
        $fullName = $name.' '.$family;
        $frameId = str_replace(' ','', $id.$name.$family);

        if ($category ==='Състезатели') {
            echo "
            <div class='schedule' onClick='$(\"#$frameId\").fadeIn(400)'>
            <div class='scheduleGrid'>    
                <div><img src='admin/object_images/$dir/$image1' alt='$fullName'></div>
                <div>Име:<br> 
                Фамилия:<br>           
                Години:<br>
                </div>
                <div>$name<br>
                $family<br>
                $yeasrs<br>
                </div>
                <div>Виж още</div>         
            </div>
            </div>
            <div class='scheduleFrame' id=$frameId>
            <div class='scheduleFrameGrid'>
                <div><img src='images/closebtn.png' onClick='$(\"#$frameId\").fadeOut(400)'></div>
                <div><img src='admin/object_images/$dir/$image1' alt='$fullName'></div>
                <div><img src='admin/object_images/$dir/$image2' alt='$fullName'>$description</div>
                <div>Име:<br> 
                Фамилия:<br>           
                Години:<br>
                </div>
                <div>$name<br>
                $family<br>
                $yeasrs<br>
                </div>    
                
            </div>    
            </div>
        ";
        }
        if ($category ==='Треньори') {
            echo "
            <div class='trainers'>
            <div class='trainersGrid'>
                <div><img src='admin/object_images/$dir/$image1' alt='$fullName'></div> 
                <div>Име:<br> 
                Фамилия:<br>           
                Години:<br>
                </div>
                <div>$name<br>
                $family<br>
                $yeasrs<br>
                </div>
                <div>$description</div>  
            </div>    
            </div>

            ";
            }
    }

?>
</div>

