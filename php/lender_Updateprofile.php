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


$lender_id = $_SESSION["id"];
$lenderName = $_POST['Name'];
$email = $_POST['email'];
$contactNum = $_POST['contactNum'];
$minLoan = $_POST['minLoan'];
$maxLoan = $_POST['maxLoan'];
$minSal = $_POST['minSal'];
$desc = $_POST['desc'];

$s = " select * from lender where Email = '$email'"; //select query

$result = mysqli_query($con, $s);
$num = mysqli_num_rows($result);



if($num == 1){
    
    $s = " select * from lender where Email = '$email'
    AND Lender_ID = $lender_id"; //select query

    $result = mysqli_query($con, $s);
    $num = mysqli_num_rows($result);

    if($num != 1){
        $isValid = false;
        $echo = "Email already exists.";
        header("location:lender_profile.php?duplicate=error");
    }

} 


if($isValid){   
        
    $updateQuery = "UPDATE lender
    SET Lender_Name = '$lenderName', 
        Description = '$desc', 
        Contact_Number = '$contactNum', 
        Email = '$email', 
        MinSalary_Required = '$minSal', 
        MinLoan_Amt = '$minLoan', 
        MaxLoan_Amt = '$maxLoan'
    WHERE Lender_ID = $lender_id";  // Add the WHERE clause to specify which user to update

mysqli_query($con, $updateQuery);

// Assuming $user_id is the unique identifier for the user whose profile is being edited
header('location: lender_profile.php?success=update');

    }
?>