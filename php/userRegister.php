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

$userID = $_POST['userID'];
$lenderID = $_POST['lenderID'];
$scheduleID = $_POST['scheduleID'];
$tenureID = $_POST['tenureID'];
$loanAmt = $_POST['loanAmt'];

if($isValid)
    {   
        $reg= " insert into loan_application (User_ID, Lender_ID, Schedule_ID, Loan_Amt, Tenure_ID) 
        Balues ('$userID', '$lenderID', '$scheduleID', '$tenureID', '$loanAmt')";
        mysqli_query($con, $reg);
        header('location:borrower_Dashboard.php?success=register');
    }
?>