<?php

    // Function to approve/deny loan
    function updateLoanStatus($loanAppID, $status) {
        global $conn;

        $status = mysqli_real_escape_string($conn, $status);
        $loanAppID = intval($loanAppID);

        $sql = "UPDATE loan_application
                SET Status = '$status'
                WHERE LoanApp_ID = $loanAppID";

        if (mysqli_query($conn, $sql)) {
            return true; // Successfully updated
        } else {
            return false; // Update failed
        }
    }

    // Check if form submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $loanAppID = $_POST['loanAppID'];
        $status = $_POST['status']; 

        // Check if the loanAppID and status are not empty
        if (!empty($loanAppID) && !empty($status)) {
            if (updateLoanStatus($loanAppID, $status)) {
                echo "Loan application (ID: $loanAppID) has been $status.";
            } else {
                echo "Failed to update loan application status.";
            }
        } else {
            echo "LoanApp_ID and Status are required fields.";
        }
    }
?>