<?php

    include "db.php";

    session_start();

    if (!isset($_SESSION['visitor'])){
            $_SESSION['timer'] = time();
            $_SESSION['visitor'] = 0;   //sets session
    }


    if (isset($_POST['email']))
        $email = $_POST['email'];


    $name = $_POST['name'];
    $message = $_POST['message'];
    $date = date('jS F Y');
    $time = date("H:i");
    $moderated = 0;
    $ip = $_SERVER['REMOTE_ADDR'];

     $query = mysql_query("INSERT INTO messages
                    (msg_name,msg_email,msg_message,msg_date,msg_time,msg_moderated,msg_ip)
            VALUES ('$name','$email','$message','$date','$time','$moderated', '$ip')  ");

     mysql_close($query);

     $_SESSION['visitor'] =  $_SESSION['visitor'] + 1;
                       

?>