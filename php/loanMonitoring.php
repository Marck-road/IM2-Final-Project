<?php
    session_start();

    $con = mysqli_connect('localhost', 'root', 'Furina de Fontaine');  //Change according to your settings
   
    // Function to fetch loan details
    function fetchLoanDetails($userID) {
        global $conn;

        $userID = intval($userID);

        $sql = "SELECT loan.*, lender.Lender_Name
                FROM loan
                INNER JOIN loan_application ON loan.LoanApp_ID = loan_application.LoanApp_ID
                INNER JOIN lender ON loan_application.Lender_ID = lender.Lender_ID
                WHERE loan_application.User_ID = $userID";

        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        } else {
            return [];
        }
    }

    // Check if user is logged in and fetch their loan details
    if (isset($_SESSION['user_id'])) {
        $userID = $_SESSION['user_id'];

        $loanDetails = fetchLoanDetails($userID);

        if (!empty($loanDetails)) {
            foreach ($loanDetails as $loan) {
                echo "Loan ID: " . $loan['Loan_ID'] . "<br>";
                echo "Amount Payable: " . $loan['Amount_Payable'] . "<br>";
                echo "Next Payment Date: " . $loan['Next_Payment_Date'] . "<br>";
                echo "Lender: " . $loan['Lender_Name'] . "<br>";
                echo "<hr>";
            }
        } else {
            echo "No active loans found for this user.";
        }
    } else {
        echo "Please log in to view loan details.";
    }
?>