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
    $status = $_POST['status']; 
    $loanDetails = json_decode($_POST['loanDetails'], true);
    $userDetails = json_decode($_POST['userDetails'], true);

    $sql = "UPDATE payment
                SET Status = '$status'
                WHERE Payment_ID = $payment_id";
    mysqli_query($con, $sql);
   
    if($status == "Approved"){
            // if approve, need to check if naa pay balance nabilin
            // if ever naa, calculate next pay date and generate new bill period.
            //      if ever nay sobra, subtract next bill period with excess
            // if ever wa nay balance, end it and change status of loan to closed
    }else{
        // header('location:lender_Dashboard.php?update=success');
    }


function calculateLoanDetails($con, $amt_borrowed, $lender_ir, $selectTenure, $paysched){
    $ir_query = mysqli_query($con, $lender_ir);
    $ir_result = mysqli_fetch_array($ir_query);

    $sched_query = mysqli_query($con, $paysched);
    $sched_result = mysqli_fetch_array($sched_query);

    $tenure_query = mysqli_query($con, $selectTenure);
    $tenure_result = mysqli_fetch_array($tenure_query);


    $interest_payable = ($amt_borrowed * $ir_result["Interest_Rate"]);
    
    $ir_result["Interest_Rate"] = 100 * $ir_result["Interest_Rate"];
    $total_payable = $interest_payable + $amt_borrowed;

    switch ($tenure_result["Tenure_ID"]) {
        case 1:
            $monthly_interest = $ir_result["Interest_Rate"];
            $monthly_payable = number_format($total_payable, 2, '.', ',');
            break;
        case 2:
            $monthly_interest = round($ir_result["Interest_Rate"] / 2, 2);
            $monthly_payable = number_format($total_payable / 2, 2, '.', ',');
            break;
        case 3:
            $monthly_interest = round($ir_result["Interest_Rate"] / 6, 2);
            $monthly_payable = number_format($total_payable / 6, 2, '.', ',');
            break;
        case 4:
            $monthly_interest = round($ir_result["Interest_Rate"] / 12, 2);
            $monthly_payable= number_format($total_payable / 12, 2, '.', ',');
            break;
        case 5:
            $monthly_interest = round($ir_result["Interest_Rate"] / 24, 2);
            $monthly_payable= number_format($total_payable / 24, 2, '.', ',');
            break;
        default:
            break;
    }

    return [
        'ir_result' => $ir_result["Interest_Rate"],
        'interest_payable' => $interest_payable,
        'monthly_interest' => $monthly_interest,
        'monthly_payable' => $monthly_payable,
        'total_payable' => $total_payable,
        'loan_tenure' => $tenure_result["Duration"],
        'payment_schedule' => $sched_result["Frequency"]
    ];
}

    function getUserDetails($con, $user_id){
        $s = "SELECT * FROM user 
                WHERE User_ID = $user_id";

        $user_query = mysqli_query($con, $s);
        $user = mysqli_fetch_array($user_query);

        return[
            'userEmail' => $user['Email'],
            'userFname' => $user['First_Name'],
            'userMname' => $user['Middle_Name'],
            'userLname' => $user['Last_Name'],
            'userMI'=> $user['Monthly_Income'],
            'userContact'=> $user['Contact_Number']
        ];
    }
?>