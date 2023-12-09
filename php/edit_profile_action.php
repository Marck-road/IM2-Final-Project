<?php
    

    session_start();
    
    if ($_SESSION['SESSIONID_VALUE'] != session_id()){
        header('location: index.php');
    }

$con = mysqli_connect('localhost', 'root', 'Furina de Fontaine');  //Change according to your settings
    
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_select_db($con, 'loanapp');
    $retVal = "";
    $isValid = true;
    $status = 400; 


$user_id = $_SESSION["id"];
$fname = $_POST['fname'];
$mname = $_POST['mname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$contactNum = $_POST['phone'];
$birthday = $_POST['birthday'];
$city = $_POST['city'];
$zipCode = $_POST['zip'];
$employmentStatus = $_POST['employment'];

$s = " select * from user where Email = '$email'"; //select query

$result = mysqli_query($con, $s);
$num = mysqli_num_rows($result);



if($num == 1){
    
    $s = " select * from user where Email = '$email'
    AND User_ID = $user_id"; //select query

    $result = mysqli_query($con, $s);
    $num = mysqli_num_rows($result);

    if($num != 1){
        $isValid = false;
        $echo = "Email already exists.";
        header("location:borrower_profile.php?duplicate=error");
    }

} 


if($isValid){   
        
    $updateQuery = "UPDATE user 
    SET First_Name = '$fname', 
        Middle_Name = '$mname', 
        Last_Name = '$lname', 
        Email = '$email', 
        Contact_Number = '$contactNum', 
        Birthday = '$birthday', 
        City = '$city', 
        ZIP_Code = '$zipCode', 
        Employment_Status = '$employmentStatus'
    WHERE user_id = $user_id";  // Add the WHERE clause to specify which user to update

mysqli_query($con, $updateQuery);

// Assuming $user_id is the unique identifier for the user whose profile is being edited
header('location: borrower_profile.php?success=update');

    }
?>