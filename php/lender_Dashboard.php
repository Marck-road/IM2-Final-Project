<?php
    session_start();

    $con = mysqli_connect('localhost', 'root', 'Furina de Fontaine');  //Change according to your settings
    mysqli_select_db($con, 'loanapp');

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $amt_borrowed = $_POST["amt_borrowed"];
        $tenure = $_POST["tenure"];
        $pay_schedule = $_POST["pay_sched"];
    } else{
        $amt_borrowed = 0;
        $tenure = 6;
        $pay_schedule = 5;
    }

    $s = "SELECT *, loan.Status AS loanStatus FROM loan
      INNER JOIN loan_application ON loan_application.LoanApp_ID = loan.LoanApp_ID
      WHERE loan_application.Lender_ID = '{$_SESSION['id']}'";

    if ($tenure != 6) {
        $s .= " AND loan_application.Tenure_ID = $tenure";
    }

    if ($amt_borrowed != 0 && $amt_borrowed != NULL) {
        $s .= " AND loan_application.Loan_amt = $amt_borrowed";
    }

    if ($pay_schedule != 5) {
        $s .= " AND loan_application.Schedule_ID = $pay_schedule";
    }
    

    $result = mysqli_query($con, $s);
    $num = mysqli_num_rows($result); 
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lender Dashboard</title>
    <link rel="stylesheet" href="../css/hamburgerstyle.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/slideshow.css">
    <link rel="stylesheet" href="../css/searchBar.css">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/lenderDashboard.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;400&display=swap" rel="stylesheet">
    <script src="../js/modal.js"></script>
</head>
<body>
<div class="wrapper">
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

    


    <div class="slideshow-container">
        <div class = "dot-container">
            <span class="dot" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
            <span class="dot" onclick="currentSlide(3)"></span>
        </div>
        <div class="mySlides fade">
            <img src="../images/slideshow1.png" style="width:100%">
        </div>
        <div class="mySlides fade">
            <img src="../images/slideshow2.png" style="width:100%">
        </div>
        <div class="mySlides fade">
            <img src="../images/slideshow3.png" style="width:100%">
        </div>

        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
        
    </div>

    <div class="main-container">
        <div class= "SearchView">
            <p class="adv_label">Advanced Search</p>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

                <label for="amt_borrowed">Loan Amount</label>
                <input type="number" name="amt_borrowed" id="amt_borrowed" value="<?php echo isset($_POST['amt_borrowed']) ? $_POST['amt_borrowed'] : '0'; ?>" step="any"><br>

                <label for="tenure">Tenure:</label>
                <select name="tenure" id="tenure">
                    <option value="1" <?php echo (isset($_POST['tenure']) && $_POST['tenure'] == '1') ? 'selected' : ''; ?>>1 Month</option>
                    <option value="2" <?php echo (isset($_POST['tenure']) && $_POST['tenure'] == '2') ? 'selected' : ''; ?>>3 Months</option>
                    <option value="3" <?php echo (isset($_POST['tenure']) && $_POST['tenure'] == '3') ? 'selected' : ''; ?>>6 Months</option>
                    <option value="4" <?php echo (isset($_POST['tenure']) && $_POST['tenure'] == '4') ? 'selected' : ''; ?>>1 Year</option>
                    <option value="5" <?php echo (isset($_POST['tenure']) && $_POST['tenure'] == '5') ? 'selected' : ''; ?>>2 Years</option>
                    <option value="6" <?php echo (!isset($_POST['tenure']) || (isset($_POST['tenure']) && $_POST['tenure'] == '6')) ? 'selected' : ''; ?>>All</option>
                </select>


                <label for="pay_sched">Payment Schedule:</label>
                <select name="pay_sched" id="pay_sched">
                    <option value="1" <?php echo (isset($_POST['pay_sched']) && $_POST['pay_sched'] == '1') ? 'selected' : ''; ?>>Weekly</option>
                    <option value="2" <?php echo (isset($_POST['pay_sched']) && $_POST['pay_sched'] == '2') ? 'selected' : ''; ?>>Semi-Monthly</option>
                    <option value="3" <?php echo (isset($_POST['pay_sched']) && $_POST['pay_sched'] == '3') ? 'selected' : ''; ?>>Monthly</option>
                    <option value="4" <?php echo (isset($_POST['pay_sched']) && $_POST['pay_sched'] == '4') ? 'selected' : ''; ?>>Quarterly</option>
                    <option value="5" <?php echo (!isset($_POST['pay_sched']) || (isset($_POST['pay_sched']) && $_POST['pay_sched'] == '5')) ? 'selected' : ''; ?>>All</option>
                </select>

                      <br>
                    <div class="button-container">
                        <input type="submit" value="Submit"> 
                    </div>
            </form>
        </div>

        <div class="ListView">
        <div class="List_header">
            <h1>My Active Loans</h1> 
            <form id="filterForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input type="hidden" name="amt_borrowed" value="<?php echo $amt_borrowed; ?>">
                <input type="hidden" name="tenure" value="<?php echo $tenure; ?>">
                <input type="hidden" name="pay_sched" value="<?php echo $pay_schedule; ?>">
                            
            
                <select name="loansFilter" id="loansFilter" onchange="submitForm()">
                    <option value="1" <?php echo (isset($_POST['loansFilter']) && $_POST['loansFilter'] == '1') ? 'selected' : ''; ?>>All</option>
                    <option value="2" <?php echo (isset($_POST['loansFilter']) && $_POST['loansFilter'] == '2') ? 'selected' : ''; ?>>Approved</option>
                    <option value="3" <?php echo (isset($_POST['loansFilter']) && $_POST['loansFilter'] == '3') ? 'selected' : ''; ?>>Denied</option>
                    <option value="4" <?php echo (isset($_POST['loansFilter']) && $_POST['loansFilter'] == '4') ? 'selected' : ''; ?>>Pending</option>
                </select>
            </form>
        </div>
        <?php
            
            if($num == 0){?>
                <div class="noResults">
                    <i class="fa-solid fa-kiwi-bird" id="kiwi"></i></i>
                    <p class="noText"></p>-No Transaction Found-</p>
                </div>
            <?php
            } else{

            

            $index = 1;
            while($row = mysqli_fetch_array($result)){

                $lender_ir = "SELECT Interest_Rate FROM lender_interest_rates
                WHERE Lender_ID = '" . $row["Lender_ID"] . "' AND Tenure_ID = '" . $row["Tenure_ID"] . "'";
                $paysched = "SELECT * FROM payment_sched
                WHERE Schedule_ID = '" . $row["Schedule_ID"] . "'";
                $selectTenure = "SELECT * FROM tenure 
                WHERE Tenure_ID = '" . $row["Tenure_ID"] . "'";
                $lender = "SELECT * FROM lender 
                WHERE Lender_ID = '" . $row["Lender_ID"] . "'";

                $modalId = "infoModal_" . $index;
                $overlayId = "overlay_" . $index;
                
                $userDetails = getUserDetails($con, $row["User_ID"]);
                $loanDetails = calculateLoanDetails($con, $row["Loan_Amt"], $lender_ir, $selectTenure, $paysched);
                $loanBalance = checkBalance($con, $row["Loan_ID"], $loanDetails);
                
                $jsonloanDetails = json_encode($loanDetails);
                $jsonUserDetails = json_encode($userDetails);
                $jsonrowDetails = json_encode($row);
            
        ?>
        <div class="loan_container">
            <div class="centered_column">
                <img src="../images/slideshow2.png" alt="Company Logo" class="company_logo">
            </div>

            <div class="column">
                <div class="row">
                    <h2><?php echo $userDetails['userLname'];?>, 
                    <?php echo $userDetails['userFname'];?> <?php echo $userDetails['userMname'];?></h2>
                </div>
                <div class="row">
                    <p>Amount Repaid: ₱<?php echo number_format($loanBalance['totalPaid'], 2, '.', ',');?> / ₱<?php echo number_format($loanDetails['total_payable'], 2, '.', ',');?></p>
                </div>
            </div>

            <div class="column">
                <div class="row">
                    <h3>Amount Borrowed</h3>
                </div>
                <div class="row_value">
                    <p>₱<?php echo $row['Loan_Amt'];?></p>
                </div>
            </div>

            <div class="column">
                <div class="row">
                    <h3>Tenure</h3>
                </div>
                <div class="row_value">
                    <p><?php echo $loanDetails['loan_tenure'];?></p>
                </div>
            </div>

            <div class="column">
                <div class="row">
                    <h3>Status</h3>
                </div>
                <div class="row_value">
                    <p><?php echo $row['loanStatus'];?></p>
                </div>
            </div>

           

            <div class="centered_column">
                <div class="row">
                    <form action="lender_loanDetails.php" method="post">
                            <input type="hidden" name="rowDetails" value="<?php echo htmlspecialchars($jsonrowDetails); ?>">
                            <input type="hidden" name="loanDetails" value="<?php echo htmlspecialchars($jsonloanDetails); ?>">
                            <input type="hidden" name="userDetails" value="<?php echo htmlspecialchars($jsonUserDetails); ?>">
                            <input type="hidden" name="loanStatus" value="<?php echo $row['loanStatus']?>">

                            <button type="submit">More Info</button>
                    </form>
                </div>
            </div>

            <div id="<?php echo $overlayId; ?>" class="overlay" onclick="closeModal('<?php echo $modalId; ?>', '<?php echo $overlayId; ?>')"></div>
            
            <div id="<?php echo $modalId; ?>" class="modal">
                <h2>
                    <div class="row">
                    <?php echo $userDetails['userLname'];?>, 
                    <?php echo $userDetails['userFname'];?> <?php echo $userDetails['userMname'];?>
                    </div>
                </h2>

                <p>Email Address: <?php echo $userDetails['userEmail']; ?></p>
                <p>Contact Number: <?php echo $userDetails['userContact']; ?></p>
                <p>Loan Amount: ₱<?php echo number_format($row['Loan_Amt'], 2, '.', ','); ?></p>
                <p>Tenure Selected: <?php echo $loanDetails['loan_tenure'];?></p>
                <p>Payment Schedule: <?php echo $loanDetails['payment_schedule'];?></p>
                <p>Interest: <?php echo number_format($loanDetails['ir_result'], 2, '.', ','); ?>%</p>
                <p>Interest Payable: ₱<?php echo number_format($loanDetails['interest_payable'], 2, '.', ','); ?></p>
                <p>Monthly Payment: ₱<?php echo $loanDetails['monthly_payable'];?></p>
                <p>Total Payable: ₱<?php echo number_format($loanDetails['total_payable'], 2, '.', ','); ?></p>
                
            
                <button onclick="closeModal('<?php echo $modalId; ?>', '<?php echo $overlayId; ?>')">Close</button> 
            </div>

        </div>

        <?php
            $index++;
            }
        }
        ?>
    
    </div>

    </div>

    <?php
        include '../html/footer(Lenders).html';
    ?>

    <script src="https://kit.fontawesome.com/e140ca9b66.js" crossorigin="anonymous"></script>       
    <script src="../js/viewLoans.js"></script>
    <script src="../js/slideshow.js"></script>
</body>
</html>

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
    
            // Calculate the balance
            $balance = $totalPayable - $totalPaid;

            if($totalPaid == NULL){
                $totalPaid = 0;
            }
    
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

    function calculateLoanDetails($con, $amt_borrowed, $lender_ir, $selectTenure, $paysched)
    {
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
            'payment_schedule' => $sched_result["Frequency"],
            'paysched_id' => $sched_result["Schedule_ID"]
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