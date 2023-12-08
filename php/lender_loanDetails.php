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

    $loanDetails = json_decode($_POST['loanDetails'], true);
    $userDetails = json_decode($_POST['userDetails'], true);
    $loanAppDetails = json_decode($_POST['rowDetails'], true);
    $loanStatus = ($_POST['loanStatus']);


    $jsonloanDetails = json_encode($loanDetails);
    $jsonUserDetails = json_encode($userDetails);
    
    $loanBalance = checkBalance($con, $loanAppDetails["Loan_ID"], $loanDetails);
    $loanDates = getTimestamps($con, $loanAppDetails["Loan_ID"], $loanDetails);

    if($loanStatus != 'Closed' && $loanStatus != 'OnHold'){

        $currentBP = getCurrentBillingPeriod($con, $loanAppDetails["Loan_ID"]);
    }
       
    
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction History</title>
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
                <li><a href="lender_Dashboard.php">Home</a></li>
                <li><a href="lender_ViewOffers.php">New Offers</a></li>
                <li><a href="#footer">Contact Us</a></li>
                <li><a href="AboutUsPage(Lenders).php">About Us</a></li>
                <li><a href="FAQsPage(Lenders).php">FAQs</a></li>
                <li class="user-profile">
                    <a class="dropdown"><i class="fa-solid fa-user"></i></a>
                        <div class="dropdown-content" id="dropdown-content">
                            <a id="dp-option"><i class="fa-regular fa-user"></i> View Profile</a>
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
                    <h2 class="borrower_name" id="borrower_name"><?php echo $userDetails['userLname']; ?>, <?php echo $userDetails['userFname']; ?> <?php echo $userDetails['userMname']; ?></h2>
                </div>
                <div class="row" id="details">
                    <div class="column">
                        <p>Email Address:<br><?php echo $userDetails['userEmail']; ?></p>
                    </div>
                    <div class="column">
                        <p>Contact Number:<br><?php echo $userDetails['userContact']; ?></p>

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
                    <form action="lender_TransHistory.php" method="post" id="historyForm">
                            <div class="row">
                                <input type="hidden" name="loanDetails" value="<?php echo htmlspecialchars($jsonloanDetails); ?>">
                                <input type="hidden" name="userDetails" value="<?php echo htmlspecialchars($jsonUserDetails); ?>">
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
                        <button onclick="openModal('RestructureModal', 'RestructureOverlay')">Create Restructured Account</button>
                    </div>
                </div>
            </div>

            <div id="RestructureOverlay" class="overlay" onclick="closeModal('RestructureModal', 'RestructureOverlay')"></div>
            <div id="RestructureModal" class="modal">
                    <h2>
                    <input type="hidden" name="LBPeriod_id" value="<?php echo $currentBP['currentBP_ID']?>">
                        <div class="row">
                            Create Restructured Account
                        </div>
                        
                    </h2>

                    
                    <form id="submitPayment" method="post" action="Restructure.php">

                            <label for="LoanAmt">Loan_Amt</label>
                            <input type="number" name="LoanAmt" id="LoanAmt" value="<?php echo $loanDetails['total_payable']-$loanBalance['totalPaid']?>" readonly><br>
                            <label for="Interest">Interest</label>
                            <input type="number" name="Interest" id="Interest" value="0"><br>
                            <label for="Tenure">Tenure:</label>
                            <select name="Tenure" id="tenure">
                                <option value="1">1 Month</option>
                                <option value="2">3 Months</option>
                                <option value="3">6 Months</option>
                                <option value="4">1 Year</option>
                                <option value="5">2 Years</option>
                            </select>
                            <label for="pay_sched">Schedule:</label>
                            <select name="pay_sched" id="pay_sched">
                                <option value="1">Weekly</option>
                                <option value="2">Semi-Monthly</option>
                                <option value="3">Monthly</option>
                                <option value="4">Quarterly</option>
                            </select>
                            
                           
                            <!-- hidded values to be submitted -->
                            <input type="hidden" name="Loan_id" value="<?php echo $loanAppDetails["Loan_ID"]?>">
                            <input type="hidden" name="User_id" value="<?php echo $userDetails['userID']?>">
                            <input type="hidden" name="Lender_id" value="<?php echo $_SESSION['id']?>">
                            
                            <div class="button-container">
                                <button type="button" onclick="closeModal('RestructureModal', 'RestructureOverlay')">Cancel</button>
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

