<?php
    

    session_start();
    
    if ($_SESSION['SESSIONID_VALUE'] != session_id()){
        header('location: index.php');
    }


    // Function to approve/deny loan
    function updateLoanStatus($con, $loanAppID, $status) {
        $con = mysqli_connect('localhost', 'root', 'Furina de Fontaine');  //Change according to your settings
        mysqli_select_db($con, 'loanapp');

        $sql = "UPDATE loan_application
                SET Status = '$status'
                WHERE LoanApp_ID = $loanAppID";

        if (mysqli_query($con, $sql)) {
            return true; // Successfully updated
        } else {
            return false; // Update failed
        }
    }

    // Check if form submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $loanAppID = $_POST['loanAppID'];
        $status = $_POST['status']; 
        $loanDetails = json_decode($_POST['loanDetails'], true);
        $userDetails = json_decode($_POST['userDetails'], true);

        $con = mysqli_connect('localhost', 'root', 'Furina de Fontaine');  //Change according to your settings
        mysqli_select_db($con, 'loanapp');

        // Check if the loanAppID and status are not empty
        if (!empty($loanAppID) && !empty($status)) {
            if (updateLoanStatus($con, $loanAppID, $status)) {
                if($status == "Approved"){
                    createLoan_Entity($con, $loanAppID, $loanDetails);
                }
                header('location:lender_ViewOffers.php?updateStatus=success');
            } else {
                header('location:lender_ViewOffers.php?updateStatus=error');
            }
        } else {
            header('location:lender_ViewOffers.php?incomplete=error');

        }
    }

    function createLoan_Entity($con, $loanAppID, $loanDetails) {
        $reg= "INSERT INTO loan (LoanApp_ID) VALUES($loanAppID)";
        mysqli_query($con, $reg);

        // initialize first loan billing period only
        $currentTimestamp = time();
        $currentTimestamp = date('Y-m-d H:i:s', $currentTimestamp);
        $endDate = new DateTime($currentTimestamp);
        $loanBP_Amt = $loanDetails['monthly_payable'];

        $sql = "SELECT Loan_ID FROM loan
                WHERE LoanApp_ID = $loanAppID";
        $result = mysqli_query($con, $sql);
        $loan_id = mysqli_fetch_array($result);

        if($loanDetails['payment_schedule'] == 1){
            $loanBP_Amt =  $loanDetails['monthly_payable'] / 4;
            $endDate->modify('+1 week');
        } else if ($loanDetails['payment_schedule'] == 2){
            $loanBP_Amt =  $loanDetails['monthly_payable'] / 2;
            $endDate->modify('+15 days');
        } else if ($loanDetails['payment_schedule'] == 3){
            $loanBP_Amt =  $loanDetails['monthly_payable'];
            $endDate->modify('+1 month');
        } else if ($loanDetails['payment_schedule'] == 4){
            $loanBP_Amt = $loanDetails['monthly_payable'] * 4;
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