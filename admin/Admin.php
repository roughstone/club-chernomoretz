<?php

class Admin extends Dbh{

    public function setTheAdmin() {
        
        $admin_name = mysqli_real_escape_string($this->connect(),$_POST['admin_name']);
        $admin_password = mysqli_real_escape_string($this->connect(),$_POST['admin_password']);

        $sql = "SELECT * FROM administratos WHERE име='$admin_name' AND парола='$admin_password'";
        $result = $this->connect()->query($sql);
        $numRows = $result->num_rows;
        if ($numRows>0) {
		
            $_SESSION['име'] = '$admin_name';
            
            echo "<script>window.open('index.php?logged=Success','_self')</script>";
            
        }	
        else {
            
            echo "<script>alert('Грешно потрибителско име или парола!')</script>";
        }
    }  
}