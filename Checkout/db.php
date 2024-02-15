<?php
$conn = new mysqli('localhost','root','','form');
if($conn){
    echo " " . mysqli_connect_error();
}
?>