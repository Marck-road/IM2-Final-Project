<?php

session_start();


$con = mysqli_connect('localhost', 'root', 'Furina de Fontaine');  //Change according to your settings
    
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_select_db($con, 'loanapp');
    $retVal = "";
    $isValid = true;
    $status = 400; 

$fname = $_POST['fname'];
$mname = $_POST['mname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$password = $_POST['password'];
$confPassword = $_POST['confPassword'];
$contactNum = $_POST['contactNum'];
$birthday = $_POST['birthday'];
$city = $_POST['city'];
$province = $_POST['province'];
$zipCode = $_POST['zipCode'];
$monthlyIncome = $_POST['monthlyIncome'];
$employmentStatus = $_POST['employmentStatus'];

if($isValid && ($password != $confPassword) ){
    $isValid = false;
    header("location:SignupPage.php?pass=error");
    exit();
}

if ($isValid && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $isValid = false;
    $echo = "Invalid email.";
    header("location:SignupPage.php?email=error");
    exit();
}

echo $contactNum;
//Checks if any email duplications
$s = " select * from user where Email = '$email'"; //select query

$result = mysqli_query($con, $s);
$num = mysqli_num_rows($result);

if($num == 1){
    $isValid = false;
    $echo = "Email already exists.";
    header("location:SignupPage.php?duplicate=error");
} 


if($isValid){   
        $hashed_password = md5($password);
        $reg= " INSERT INTO user (Email, Password, First_Name, Middle_Name, Last_Name, Monthly_Income, Birthday, City, Province, ZIP_Code, Contact_Number, Employment_Status) 
        VALUES ('$email', '$hashed_password', '$fname', '$mname', '$lname', '$monthlyIncome', '$birthday', '$city', '$province', '$zipCode', '$contactNum', '$employmentStatus')";
        mysqli_query($con, $reg);
        header('location:Loginpage.php?success=register');
    }
?>