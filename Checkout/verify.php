<?php
session_start();
$conn = new mysqli('localhost','root','','form');
$unique_id = $_SESSION['unique_id'];
if(empty($unique_id)){
    header("Location: login.php");
}
$qry = mysqli_query($conn,"SELECT * FROM users WHERE unique_id = '{$unique_id}'");
if(mysqli_num_rows($qry)>0){
    $row = mysqli_fetch_assoc($qry);
    if($row){
        $_SESSION['verification_status'] = $row['verification_status'];
        if($row['verification_status']=='Verified'){
            header("Location: index.php");
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-eqiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="verify.css">
</head>
<body>
    <div class="form" style="text-align:center;">
        <h2>Verify Your Account</h2>
        <p>We have emailed a 4-Digit verification code to the given email address</p>
        <form action="" autocomplete="off">
            <div class="error-text">
                Error
            </div>
            <div class="fields-input">
                <input type="number" class="otp_field" name="otp1" placeholder="0" min="0" max="9" required onpaste="false">
                <input type="number" class="otp_field" name="otp2" placeholder="0" min="0" max="9" required onpaste="false">
                <input type="number" class="otp_field" name="otp3" placeholder="0" min="0" max="9" required onpaste="false">
                <input type="number" class="otp_field" name="otp4" placeholder="0" min="0" max="9" required onpaste="false">
            </div>
            <div class="submit">
                <input type="submit" value="Verify Now" class="button" id="btn">
            </div>
        </form>
    </div>
    <script src="verify.js"></script>
</body>
</html>