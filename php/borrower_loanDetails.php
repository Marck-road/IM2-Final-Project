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

    $loanDetails = json_decode($_POST['loanDetails'], true);
    $loanAppDetails = json_decode($_POST['rowDetails'], true);
    $loanBalance = checkBalance($con, $loanAppDetails["Loan_ID"], $loanDetails);
    $loanDates = getTimestamps($con, $loanAppDetails["Loan_ID"], $loanDetails);
    $loanStatus = ($_POST['loanStatus']);

    if($loanStatus != 'Closed' && $loanStatus != 'OnHold') {

        $currentBP = getCurrentBillingPeriod($con, $loanAppDetails["Loan_ID"]);
    }
    
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Loans</title>
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/loanDetails.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;400&display=swap" rel="stylesheet">
    <script src="../js/modal.js"></script>
</head>
<body>
<nav>
        <div class="navbar">
            <div class="logo">
                <a href="#"><img src="../images/ldaddy.png" class="logo"></a>
            </div>
            <ul class="menu">
                <li><a href="borrower_Dashboard.php">Home</a></li>
                <li><a href="viewLoans.php">View Loans</a></li>
                <li><a href="#footer">Contact Us</a></li>
                <li><a href="AboutUsPage(Borrowers).php">About Us</a></li>
                <li><a href="FAQsPage(Borrowers).php">FAQs</a></li>
                <li class="user-profile">
                    <a class="dropdown"><i class="fa-solid fa-user"></i></a>
                        <div class="dropdown-content" id="dropdown-content">
                            <a href="borrower_profile.php" id="dp-option"><i class="fa-regular fa-user"></i> View Profile</a>
                            <a id="dp-option" href="logout.php" onclick="return confirm('Are you sure you want to logout?')"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
                        </div>
                </li>
            </ul>
        </div>

    </nav>

    
    
    <div class="ListView">
        <div class="List_header">
            <h1>Loan Information:</h1> 
        </div>
        
        <div class="loan_container">
            <div class="column">
                <div class="row">
                    <img src="../images/slideshow2.png" alt="Company Logo" class="company_logo">
                    <h2 class="lender_name" id="lender_name"><?php echo $loanDetails['lender_name']; ?></h2>
                </div>
                <div class="row" id="details">
                    <div class="column">
                        <p>Email Address:<br><?php echo $loanDetails['lender_email']; ?></p>
                    </div>
                    <div class="column">
                        <p>Contact Number:<br><?php echo $loanDetails['lender_contact']; ?></p>

                    </div>
                    <div class="column">
                        <p>Loan Amount:<br>₱<?php echo number_format($loanAppDetails['Loan_Amt'], 2, '.', ','); ?></p>

                    </div>
                    <div class="column">
                        <p>Tenure Selected:<br><?php echo $loanDetails['loan_tenure'];?></p>

                    </div>
                    <div class="column">
                        <p>Payment Schedule:<br><?php echo $loanDetails['payment_schedule'];?></p>
                   
                    </div>
                </div>
                <div class="row" id="details">
                    <div class="column">
                        <p>Start Date:<br><?php echo $loanDates['startDate'];?></p>
                    </div>
                    <div class="column">
                        <p>End Date:<br><?php echo $loanDates['endDate'];?></p>
                   
                    </div>
                </div>
            </div>
        </div>
        
        <div class="loan_container">
           
            <div class="centered_column" id="colProgress">
                <div class="row" id="details">
                    <div class="circular-progress">
                        <div class="progress-bar">
                            <div class="progress"></div>
                            <div class="progress-mask"></div>
                        </div>
                        <div class="progress-text">
                        <p><?php echo round(($loanBalance['totalPaid'] / $loanDetails['total_payable']) * 100, 2); ?>%</p>
                        </div>
                    </div>

                    <div class="centered_column">
                            <p>Amount Repaid:<br>₱<?php echo number_format($loanBalance['totalPaid'], 2, '.', ',');?> / ₱<?php echo number_format($loanDetails['total_payable'], 2, '.', ',');?></p>
                 
                    </div>

                </div>
             
                    
            </div>
                
            <div class="column">
                <div class="row">
                    <div class="column">
                        <p>Interest:<br><?php echo number_format($loanDetails['ir_result'], 2, '.', ','); ?>%</p>

                    </div>
                    <div class="column">
                        <p>Interest Payable:<br>₱<?php echo number_format($loanDetails['interest_payable'], 2, '.', ','); ?></p>
                    </div>
                    <div class="column">
                        <p>Monthly Interest:<br>₱<?php echo $loanDetails['monthly_interest'];?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="column">
                        <p>Monthly Payment:<br>₱<?php echo $loanDetails['monthly_payable'];?></p>
                    </div>
                    <div class="column">
                        <p>Total Payable:<br>₱<?php echo number_format($loanDetails['total_payable'], 2, '.', ','); ?></p>
                    </div>

                </div>
            </div>
                
            
        
        </div>
        
        <?php
            if($loanStatus == 'Closed' || $loanStatus == 'OnHold'){   ?>
            <div class="centered_column">
            <form action="borrower_TransHistory.php" method="post" id="historyForm">
                            <div class="row">
                                <input type="hidden" name="Loan_id" value="<?php echo $loanAppDetails["Loan_ID"]?>">
                                <input type="hidden" name="LBPeriod_id" value="<?php echo $currentBP['currentBP_ID']?>">
                                <button type="button" onclick="submitForm()">View Transactions History</button>
                            </div>
                    </form>

                    <script>
                        function submitForm() {
                            document.getElementById('historyForm').submit();
                        }
                    </script>
            </div>
                
        <?php
            } else {
        ?>



        <div class="loan_container">

            <div class="column">
                  
                        <h2>Current Loan Billing Period<br></h2>
                  
                        <p>₱<?php echo number_format($currentBP['currentBP_paid'], 2, '.', ',');?> / ₱<?php echo number_format($currentBP['currentBP_amount'], 2, '.', ',');?></p>
                   
            </div>
            <div class="column">
                   
                        <h2>Date Start<br></h2>
                    
                 
                        <p><?php echo $currentBP['currentBP_dateStart']; ?></p>
                   
            </div>
            <div class="column">
                    
                        <h2>Date End<br></h2>
                        <p><?php echo $currentBP['currentBP_dateEnd']; ?></p>
                    
            </div>

            <div class="column">
                <div class="column">
                    <form action="borrower_TransHistory.php" method="post" id="historyForm">
                            <div class="row">
                                <input type="hidden" name="Loan_id" value="<?php echo $loanAppDetails["Loan_ID"]?>">
                                <input type="hidden" name="LBPeriod_id" value="<?php echo $currentBP['currentBP_ID']?>">
                                <button type="button" onclick="submitForm()">View Transactions History</button>
                            </div>
                    </form>

                    <script>
                        function submitForm() {
                            document.getElementById('historyForm').submit();
                        }
                    </script>
                    
                </div>
                <div class="column">
                    <div class="row">
                        <button onclick="openModal('sendPaymentModal', 'sendPaymentOverlay')">Send Payment</button>
                    </div>
                </div>
            </div>

            <div id="sendPaymentOverlay" class="overlay" onclick="closeModal('sendPaymentModal', 'sendPaymentOverlay')"></div>
            <div id="sendPaymentModal" class="modal">
                    <h2>
                        <input type="hidden" name="LBPeriod_id" value="<?php echo $currentBP['currentBP_ID']?>">
                        <div class="row" id="modalHeader">
                            Submit Payment
                        </div>
                        
                    </h2>

                    
                    <form id="submitPayment" method="post" action="generate_Payment.php">

                            <label for="Amount_Paid">Amount Paid</label>
                            <input type="text" name="Amount_Paid" id="Amount_Paid" placeholder="Enter Amount Paid"><br>
                            <label for="PaymentChannel">Payment Channel</label>
                            <input type="text" name="PaymentChannel" id="PaymentChannel" placeholder="Enter Payment Channel"><br>
                            <label for="Screenshot">Screenshot</label>
                            <input type="file" name="Screenshot" id="Screenshot" accept="image/*"><br>
                           
                            <!-- hidded values to be submitted -->
                            <input type="hidden" name="LBPeriod_id" value="<?php echo $currentBP['currentBP_ID']?>">
      
                            <div class="button-container">
                                <button type="button" onclick="closeModal('sendPaymentModal', 'sendPaymentOverlay')">Cancel</button>
                                <button>Confirm</button> 
                            </div>
                    </form>
            </div>



        </div>
        
        <?php
        }
        ?>

        
    
    </div>

    <?php
            include '../html/footer(Borrowers).html';
        ?>

    <?php
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

                if($totalPaid == NULL){
                    $totalPaid = 0;
                }
        
                // Calculate the balance
                $balance = $totalPayable - $totalPaid;
        
                // Return the calculated balance
                return [
                    'balance' => $balance,
                    'totalPaid' => $totalPaid,
                ];
            } else {
                // Handle query error
                echo "Error in query: " . mysqli_error($con);
                return false;
            }
        }

        function getTimestamps($con, $loan_id, $loanDetails){
            $sql = "SELECT Created_at, Updated_at FROM loan
                        WHERE Loan_ID = $loan_id";
            
            $result = mysqli_query($con, $sql);

           
            $endDateTimestamp = time();

            if ($result) {
                $row = mysqli_fetch_assoc($result);

                switch ($loanDetails['payment_ID']) {
                    case 1:
                        $endDateTimestamp = strtotime('+1 week', strtotime($row['Created_at']));
                        break;
                    case 2:
                        $endDateTimestamp = strtotime('+15 days',strtotime($row['Created_at']));
                        break;
                    case 3:
                        $endDateTimestamp = strtotime('+1 month', strtotime($row['Created_at']));
                        break;
                    case 4:
                        $endDateTimestamp = strtotime('+4 months', strtotime($row['Created_at']));
                        break;
                }

                $startDateTimestamp = strtotime($row['Created_at']);
                $startDate = date('M d, Y', $startDateTimestamp);
                $endDate = date('M d, Y', $endDateTimestamp);

                return [
                    'startDate' => $startDate,
                    'endDate' => $endDate,
                ];
            } 
        }

        function getCurrentBillingPeriod($con, $loan_id){
            $sql = "SELECT * FROM loanbilling_period
            WHERE Loan_ID = $loan_id
            AND Status = 'Open'";


            $result = mysqli_query($con, $sql);
            $row = mysqli_fetch_assoc($result);

            $startDateTimestamp = strtotime($row['Date_start']);
            $endDateTimestamp = strtotime($row['Date_end']);
            $startDate = date('M d, Y', $startDateTimestamp);
            $endDate = date('M d, Y', $endDateTimestamp);

            $sql2 = "SELECT SUM(Amount_Paid) AS totalPaid
            FROM payment
            INNER JOIN loanbilling_period ON payment.LBPeriod_ID = loanbilling_period.LBPeriod_ID
            WHERE loanbilling_period.LBPeriod_ID = {$row['Amount']}
            AND payment.Status = 'Success'";

        
            $result2 = mysqli_query($con, $sql2);
            $row2 = mysqli_fetch_assoc($result2);




            return [
                'currentBP_ID' => $row['LBPeriod_ID'],
                'currentBP_amount' => $row['Amount'],
                'currentBP_paid' => $row2['totalPaid'],
                'currentBP_dateStart' => $startDate,
                'currentBP_dateEnd' => $endDate
            ];
        }
    ?>

    <script>
        var totalPaidPercentage = <?php echo ($loanBalance['totalPaid'] / $loanDetails['total_payable']) * 100; ?>;
        var progressElement = document.querySelector('.progress');

        progressElement.style.width = totalPaidPercentage + '%';
    </script>

        

    <script src="https://kit.fontawesome.com/e140ca9b66.js" crossorigin="anonymous"></script>  

    </body>
</html>

