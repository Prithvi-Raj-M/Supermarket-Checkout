<?php
session_start();
$conn = new mysqli('localhost','root','','form');
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$email=$_POST['email'];
$phone=$_POST['phone'];
$password=md5($_POST['pass']);
$cpassword=md5($_POST['cpass']);
$role= 'user';
$verification_status = '0';

if(!empty($fname) && !empty($lname) && !empty($email) && !empty($phone) && !empty($password) && !empty($cpassword)){
    if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $sql = mysqli_query($conn, "SELECT email FROM users WHERE email = '{$email}'");
        if(mysqli_num_rows($sql)>0){
            echo "$email ~ Already Exists ";
        }
        else{
            if($password == $cpassword){
                $random_id= mt_rand(100000,999999);
                $otp= mt_rand(1111,9999);

                $sql2=mysqli_query($conn,"INSERT INTO users (unique_id, fname,lname,email,phone, password,otp,verification_status,role) VALUES ('{$random_id}','{$fname}','{$lname}','{$email}','{$phone}',
                '{$password}','{$otp}','{$verification_status}','{$role}')");
                if($sql2){
                    $sql3=mysqli_query($conn,"SELECT *FROM users WHERE email = '{$email}'");
                    if(mysqli_num_rows($sql3)>0){
                        $row = mysqli_fetch_assoc($sql3);
                        $_SESSION['unique_id'] = $row['unique_id'];
                        $_SESSION['email']= $row['email'];
                        $_SESSION['otp']= $row['otp'];
                        if($otp){
                            $receiver = $email;
                            $subject = "Email Test via PHP using Localhost";
                            $body = "The otp is $otp";
                            $sender = "From: projectcheckout9@gmail.com";
                            if(mail($receiver, $subject, $body, $sender)){
                                echo "Success";
                            }else{
                                echo "Sorry, failed while sending mail!";
                            }
                        }
                    }
                }
                else{
                    echo "Something went Wrong!"; 
                }
            }
            else{
                echo "Password Mismatch "; 
            }
        }
    }
    else{
        echo "$email ~ This is not a valid email ";
    }
}
else{
    echo "All Input Fields are Required";
}
?>