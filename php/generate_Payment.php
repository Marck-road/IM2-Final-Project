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

    $lbPeriod_id = $_POST['LBPeriod_id'];
    $amt_paid = $_POST['Amount_Paid'];
    $screenshot = $_POST['Screenshot'];
    $pay_channel = $_POST['PaymentChannel'];

    echo $lbPeriod_id;

    $reg= " INSERT INTO payment (LBPeriod_ID, Amount_Paid, Screenshot, Payment_Channel) 
    VALUES ('$lbPeriod_id', '$amt_paid', '$screenshot', '$pay_channel')";
    mysqli_query($con, $reg);
    header('location:viewLoans.php?success=pay');

?>