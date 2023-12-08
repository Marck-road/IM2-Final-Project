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

    $Loan_id = $_POST['Loan_id'];
    $amt = $_POST['LoanAmt'];
    $Interest = $_POST['Interest'];
    $Tenure = $_POST['Tenure'];
    $pay_sched = $_POST['pay_sched'];
    $User_id = $_POST['User_id'];
    $Lender_id = $_POST['Lender_id'];
    $status = 'Approved';
    $HoldStatus = 'OnHold';

$finalAmt = $amt + ($amt * ($Interest / 100));


if($isValid){   
        $reg= " INSERT INTO loan_application (User_ID, Lender_ID, Schedule_ID, Tenure_ID, Loan_Amt, Status) 
        VALUES ('$User_id', '$Lender_id', '$pay_sched', '$Tenure', '$amt', '$status')";
        echo $finalAmt;
        mysqli_query($con, $reg);

        $LoanApp_ID = mysqli_insert_id($con);

        $reg= "INSERT INTO loan (LoanReference_ID, LoanApp_ID) VALUES($Loan_id, $LoanApp_ID)";
        mysqli_query($con, $reg);
        
        $sql = "UPDATE loan
                SET Status = '$HoldStatus'
                WHERE Loan_ID = $Loan_id";
        mysqli_query($con, $sql);

        createLoan_Entity($con, $LoanApp_ID, $finalAmt, $pay_sched);
        
        header('location:lender_Dashboard.php?success=application');
        exit;

    }


    function createLoan_Entity($con, $loanAppID, $finalAmt, $pay_sched) {
        // initialize first loan billing period only
        $currentTimestamp = time();
        $currentTimestamp = date('Y-m-d H:i:s', $currentTimestamp);
        $endDate = new DateTime($currentTimestamp);
        $loanBP_Amt = $finalAmt;

        $sql = "SELECT Loan_ID FROM loan
                WHERE LoanApp_ID = $loanAppID";
        $result = mysqli_query($con, $sql);
        $loan_id = mysqli_fetch_array($result);

        if($pay_sched == 1){
            $loanBP_Amt = $finalAmt / 4;
            $endDate->modify('+1 week');
        } else if ($pay_sched == 2){
            $loanBP_Amt =  $finalAmt / 2;
            $endDate->modify('+15 days');
        } else if ($pay_sched == 3){
            $loanBP_Amt =  $finalAmt;
            $endDate->modify('+1 month');
        } else if ($pay_sched == 4){
            $loanBP_Amt = $finalAmt * 4;
            $endDate->modify('+4 months');
        }

        // removes commas since it causes errors
        $loanBP_Amt = str_replace(',', '', $loanBP_Amt);
        $endDateTimestamp = $endDate->format('Y-m-d H:i:s');
        
        $regBP= "INSERT INTO loanbilling_period (Loan_ID, Amount, Date_start, Date_end) 
        VALUES('$loan_id[Loan_ID]', '$loanBP_Amt', '$currentTimestamp', '$endDateTimestamp')";
        mysqli_query($con, $regBP);
    }



?>