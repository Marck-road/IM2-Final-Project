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
    $income = $_POST['income'];
    $valid1 = $_POST['valid1'];
    $valid2 = $_POST['valid2'];
    $utility = $_POST['utility'];
    
    $sql = "UPDATE user
        SET Account_Status = '$accstatus',
            Income_Document = '$income',
            ValidID_1 = '$valid1',
            ValidID_2 = '$valid2',
            Utility_Bill = '$utility'
        WHERE User_ID = $userId;";
    mysqli_query($con, $sql);

    header('location: borrower_profile.php?success=update');
?>