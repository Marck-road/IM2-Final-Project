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

$LoanReference_ID = $_POST['LoanReference_ID'];

if($isValid)
    {   
        $reg= "INSERT INTO loan (LoanReference_ID) VALUES($LoanReference_ID)";
        mysqli_query($con, $reg);mysqli_query($con, $reg);
        header('location:borrower_Dashboard.php?success=application');
        exit;
    }
?>