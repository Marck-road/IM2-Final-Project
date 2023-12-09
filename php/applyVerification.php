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

    $accstatus = "Pending";
    $userId = $_SESSION["id"];

    $sql = "UPDATE user
        SET Account_Status = '$accstatus'
        WHERE User_ID = $userId;";
    mysqli_query($con, $sql);

    header('location: borrower_profile.php?success=update');
?>