<div class="trainingsContainer">
<?php
$select = 'SELECT * FROM trainings';
$run_query = $conn->query($select);   

while ($data=mysqli_fetch_array($run_query)) {
    $mon = $data['понеделник'];
    $tue = $data['вторник']; 
    $wen = $data['сряда'];
    $thr = $data['четвъртък'];
    $fri = $data['петък'];
    $sat = $data['събота'];
    $sun = $data['неделя'];
    $mon1 = $data['понеделник1'];
    $tue1 = $data['вторник1'];
    $wen1 = $data['сряда1'];
    $thr1 = $data['четвъртък1'];
    $fri1 = $data['петък1'];
    $sat1 = $data['събота1'];
    $sun1 = $data['неделя1'];

    echo "
    <div class='trainings'>
    <h1>Първа група:</h1>
    <div><h2>Понеделник</h2>$mon</div>
    <div><h2>Вторинк</h2>$tue</div>
    <div><h2>Сряда</h2>$wen</div>
    <div><h2>Четвъртък</h2>$thr</div>
    <div><h2>Петък</h2>$fri</div>
    <div><h2>Събота</h2>$sat</div>
    <div><h2>Неделя</h2>$sun</div>
    </div>

    <div class='trainings'>
    <h1>Втора група:</h1>
    <div><h2>Понеделник</h2>$mon1</div>
    <div><h2>Вторинк</h2>$tue1</div>
    <div><h2>Сряда</h2>$wen1</div>
    <div><h2>Четвъртък</h2>$thr1</div>
    <div><h2>Петък</h2>$fri1</div>
    <div><h2>Събота</h2>$sat1</div>
    <div><h2>Неделя</h2>$sun1</div>
    </div>
    ";
}
?>
</div>
