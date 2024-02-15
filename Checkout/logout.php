<?php

session_start();
$conn = new mysqli('localhost','root','','form');
if(isset($_SESSION['unique_id'])){
    $logout_id= mysqli_real_escape_string($conn,$_GET['logout_id']);
    if(isset($logout_id)){
        session_unset();
        session_destroy();
        header("Location: login.php");
    }
    else{
        header("Location: index.php");
    }
}
else{
    header("Location: login.php");
}

?> 