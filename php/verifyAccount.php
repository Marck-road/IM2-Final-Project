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

    $user = $_POST["User_ID"];
    $status = $_POST["status"];

    if($status){
        $sql = "UPDATE user
        SET Verified_at = CURRENT_TIMESTAMP,
            Account_Status = 'Verified'
        WHERE User_ID = $user";

        if(mysqli_query($con, $sql)){
            header('location:verificationRequest.php?update=success');
        }
    } else{
        header('location:verificationRequest.php?deny=success');
    }



?>