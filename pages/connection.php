<?php
    $connect = new mysqli("localhost", "root","","employee_db") or die();

    if($connect->connect_errno)
        echo "Error: <br>" . $connect->connect_errno . "<br>" . $connect->connect_error;
?>