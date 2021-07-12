<?php
session_start();
// Change this to your connection info.
$host = 'localhost';
$user = 'root';
$pass = '';
$DB = 'phplogin';
// Try and connect using the info above.
$con = mysqli_connect($host, $user, $pass, $DB) or die("unable to connect");

$username = $_POST['name'];
$password = $_POST['password'];
$email = $_POST['email'];

// Now we check if the data from the login form was submitted, isset() will check if the data exists.
if ( !isset($_POST['name'], $_POST['email'], $_POST['password']) ) {
    exit('Please fill both the username and password fields!');
}



$sql = "SELECT * FROM accounts where username='$username'";

$result = mysqli_query($con, $sql);
$num = mysqli_num_rows($result);

if($num == 0){
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $insert = "INSERT INTO `accounts` (`username`, `password`, `email`) VALUES ('$username', '$hash', '$email')";
    $output = mysqli_query($con, $insert);

    if($output){
        header('Location: success.html');
    }
}
else{
    echo "username already exist";
}