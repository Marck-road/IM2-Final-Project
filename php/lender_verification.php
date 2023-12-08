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

    $lender = $_POST["Lender_ID"];
    $status = $_POST["status"];

    if($status){
        $sql = "UPDATE lender
                SET Verified_at = CURRENT_TIMESTAMP
                WHERE Lender_ID = $lender";
        if(mysqli_query($con, $sql)){
            header('location:admin_lenderApplicants.php?update=success');
        }
    } else{
        header('location:admin_lenderApplicants.php?deny=success');
    }



?>