<?php

session_start();

$con = mysqli_connect('localhost', 'root1', '12345'); //connect to server

mysqli_select_db($con, 'userregistration'); //select database

$name = $_POST['user'];
$pass = $_POST['password'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$middlename = $_POST['middlename'];
$email = $_POST['email'];
$birthdate = $_POST['birthdate'];
$address = $_POST['address'];

$hashed_password = password_hash($pass, PASSWORD_DEFAULT);

$s = " select * from usertable where name = '$name'"; //select query
 
$result = mysqli_query($con, $s);
$num = mysqli_num_rows($result);

if($num == 1){
    echo" Username Already Taken";
} else{
    $reg= " insert into usertable (name, password, firstname, lastname, middlename, email, birthdate, address) values ('$name', '$hashed_password', '$firstname', '$lastname', '$middlename', '$email', '$birthdate', '$address')";
    mysqli_query($con, $reg);
    echo" Registration Successful";
    header('location:act 3.html');
}

?>