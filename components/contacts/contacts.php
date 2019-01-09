<div class="contacts_container">
    <?php
        $get_contacts = "SELECT * FROM contacts";
        $run_contacts= $conn->query($get_contacts);
                
            while ($contacts = mysqli_fetch_array($run_contacts)) {
                
                $adress = $contacts['адрес'];
                $email = $contacts['емейл'];
                $tel1 = $contacts['телефон1'];
                $tel2 = $contacts['телефон2'];

                echo "
                <div class='display_contacts'>
                <div>Адрес: $adress</div>
                <div><img src='images/google_maps.jpg' alt='контакти'></div>
                <div>Емейл: $email</div>
                <div>Телефони за връзка: $tel1, $tel2</div>
                </div>
                ";
            }
    ?>
	<form action='' method='post'>

		<input type='text' name='first_name' placeholder='Име:'><br>

		<input type='text' name='last_name' placeholder='Фамилия:'><br>

		<input type='text' name='email' placeholder='Email:'><br>

		<textarea rows='8' name='message' placeholder='Вашето съобщение:'></textarea><br>

	    <input type='submit' name='send_email' value='Изпрати'><input type='button' name='close' value='Затвори' onclick='$(".contacts_container").fadeOut(400);'>

	</form>    
</div>
<?php
	if(isset($_POST['send_email'])){
        $to = "chernomoretz_gym@abv.bg, moni.atanasova@abv.bg"; // this is your Email address
        $from = $_POST['email']; // this is the sender's Email address
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $subject = "Form submission";
        $the_date =  date("d.m.y");
        $message = $first_name . " " . $last_name . " написа:" . "\r\n\n" . $_POST['message'];

    
        $headers = array(
            "From: {$from}",
            "MIME-Version: 1.0",
            "Content-Type: text/html;charset=utf-8"
        );

        $email = mail($to, $subject, $message, implode("\r\n", $headers));

        $set_message = "INSERT INTO messages (first_name, last_name, the_message, the_date) VALUES ('$first_name', '$last_name', '$message', '$the_date')";
        $conn->query($set_message); 
    }
?>
