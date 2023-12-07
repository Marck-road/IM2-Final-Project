<?php

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

        $con = mysqli_connect('localhost', 'root', 'Furina de Fontaine');  //Change according to your settings
        mysqli_select_db($con, 'loanapp');

        // Check if the loanAppID and status are not empty
        if (!empty($loanAppID) && !empty($status)) {
            if (updateLoanStatus($con, $loanAppID, $status)) {
                if($status == "Approved"){
                    createLoan_Entity($con, $loanAppID);
                }
                header('location:lender_ViewOffers.php?updateStatus=success');
            } else {
                header('location:lender_ViewOffers.php?updateStatus=error');
            }
        } else {
            header('location:lender_ViewOffers.php?incomplete=error');

        }
    }

    function createLoan_Entity($con, $loanAppID) {
        $reg= "INSERT INTO loan (LoanApp_ID) VALUES($loanAppID)";
        mysqli_query($con, $reg);
    }
?>