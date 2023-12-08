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

    $payment_id = $_POST["Payment_ID"];
    $bp_id = $_POST["BillingPeriod_id"];
    $status = $_POST['status']; 
    $loanDetails = json_decode($_POST['loanDetails'], true);
    $userDetails = json_decode($_POST['userDetails'], true);
    $excess = false;

    $loansql = "SELECT Loan_ID FROM loanbilling_period
    WHERE LBPeriod_ID = $bp_id";

    $result = mysqli_query($con, $loansql);
    $loandetails = mysqli_fetch_array($result);
    $loan_id = $loandetails["Loan_ID"];

    // Update payment status to approved or denied
    $sql = "UPDATE payment
                SET Status = '$status'
                WHERE Payment_ID = $payment_id";
    mysqli_query($con, $sql);

    //get payment details
    $paymentsql = "SELECT * FROM payment
    WHERE Payment_ID = $payment_id";
    $paymentResult = mysqli_query($con, $paymentsql);
    $payment_details = mysqli_fetch_array($paymentResult);

    $bpsql = "SELECT * FROM loanbilling_period
    WHERE LBPeriod_ID = $bp_id";
    $bpresult = mysqli_query($con, $bpsql);
    $bp_details = mysqli_fetch_array($bpresult);
   
    if($status == "Success"){
        //if wa kaabot sa payment needed sa lbperiod, then dont do anything
        if($payment_details['Amount_Paid'] >= $bp_details['Amount']){
            //updates LBPeriod Status to closed if reached atleast amounts
            $sql = "UPDATE loanbilling_period
                SET Status = 'Closed'
                WHERE LBPeriod_ID = $bp_id";
                mysqli_query($con, $sql);
            // then checks for any excess
            if($payment_details['Amount_Paid'] > $bp_details['Amount']){
                $excess = true;
            }
        }
        
        // if approve, need to check if naa pay balance nabilin
        if(checkBalance($con, $loan_id, $loanDetails)){
            // if ever naa, calculate next pay date and generate new bill period.
            create_billPeriod($con, $loan_id, $loanDetails, $payment_details, $excess, $bp_details);
            
            header('location:lender_Dashboard.php?update=success');
        }else{
            // if ever wa nay balance, end it and change status of loan to closed
            $closesql = "UPDATE loan
                    SET Status = 'Closed'
                    WHERE Loan_ID = $loan_id";
            mysqli_query($con, $closesql);
        }
    }else{
        header('location:lender_Dashboard.php?update=success');
    }

function checkBalance($con, $loan_id, $loanDetails){
    $totalPayable = $loanDetails['total_payable'];

    // Fetch all payments linked to loanbilling_period that is linked to the specified loan_id
    $sql = "SELECT SUM(Amount_Paid) AS totalPaid
            FROM payment
            INNER JOIN loanbilling_period ON payment.LBPeriod_ID = loanbilling_period.LBPeriod_ID
            WHERE loanbilling_period.Loan_ID = $loan_id
            AND payment.Status = 'Success'";

    $result = mysqli_query($con, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalPaid = $row['totalPaid'];

        // Calculate the balance
        $balance = $totalPayable - $totalPaid;

        // Return the calculated balance
        return $balance;
    } else {
        // Handle query error
        echo "Error in query: " . mysqli_error($con);
        return false;
    }
}
    function create_billPeriod($con, $loan_id, $loanDetails, $payment_details, $excess, $bp_details){
        $startDate = new DateTime($bp_details['Date_end']);
        $endDate = new DateTime($bp_details['Date_end']);

        $loanBP_Amt = $loanDetails['monthly_payable'];

        switch ($loanDetails['paysched_id']) {
            case 1:
                $loanBP_Amt = $loanDetails['monthly_payable'] / 4;
                $endDate->modify('+1 week');
                break;
            case 2:
                $loanBP_Amt = $loanDetails['monthly_payable'] / 2;
                $endDate->modify('+15 days');
                break;
            case 3:
                $loanBP_Amt = $loanDetails['monthly_payable'];
                $endDate->modify('+1 month');
                break;
            case 4:
                $loanBP_Amt = $loanDetails['monthly_payable'] * 4;
                $endDate->modify('+4 months');
                break;
        }

      
        
      
        $loanBP_Amt = str_replace(',', '', $loanBP_Amt);
             
        $startDateTimestamp = $startDate->format('Y-m-d H:i:s');
        $endDateTimestamp = $endDate->format('Y-m-d H:i:s');
        
        //subtract amt of next billing period if there is excess
        if($excess){
            $loanBP_Amt = $loanBP_Amt - ($payment_details['Amount_Paid']- $loanBP_Amt); 
        }
        
        
        $regBP= "INSERT INTO loanbilling_period (Loan_ID, Amount, Date_start, Date_end) 
        VALUES('$loan_id', '$loanBP_Amt', '$startDateTimestamp', '$endDateTimestamp')";
        mysqli_query($con, $regBP);
    }
?>