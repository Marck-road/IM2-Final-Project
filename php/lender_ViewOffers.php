<?php
    session_start();

    $con = mysqli_connect('localhost', 'root', 'Furina de Fontaine');  //Change according to your settings
    mysqli_select_db($con, 'loanapp');

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        if($_POST["loansFilter"] == 1){
            $s = "SELECT * 
            FROM loan_application
            WHERE Lender_ID = '{$_SESSION['id']}'";
        } else if ($_POST["loansFilter"] == 2){
            $s = "SELECT * 
            FROM loan_application
            WHERE Lender_ID = '{$_SESSION['id']}'
            AND Status = 'Approved'";
        } else if ($_POST["loansFilter"] == 3){
            $s = "SELECT * 
            FROM loan_application
            WHERE Lender_ID = '{$_SESSION['id']}'
            AND Status = 'Denied'";
        } else if ($_POST["loansFilter"] == 4){
            $s = "SELECT * 
            FROM loan_application
            WHERE Lender_ID = '{$_SESSION['id']}'
            AND Status = 'Pending'";
        }
    } else{
        $s = "SELECT * 
            FROM loan_application
            WHERE Lender_ID = '{$_SESSION['id']}'
            AND Status = 'Pending'";
    }
    
    

    $result = mysqli_query($con, $s);
    $num = mysqli_num_rows($result); 
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Offers</title>
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/viewLoans.css">
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
                <li><a href="About Us/About Us.html">Contact Us</a></li>
                <li><a href="#footer">About Us</a></li>
                <li><a href="#footer">FAQs</a></li>
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
            <h1>Company's Loan Offers</h1> 
            <form id="filterForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <select name="loansFilter" id="loansFilter" onchange="submitForm()">
                    <option value="1" <?php echo (isset($_POST['loansFilter']) && $_POST['loansFilter'] == '1') ? 'selected' : ''; ?>>All</option>
                    <option value="2" <?php echo (isset($_POST['loansFilter']) && $_POST['loansFilter'] == '2') ? 'selected' : ''; ?>>Approved</option>
                    <option value="3" <?php echo (isset($_POST['loansFilter']) && $_POST['loansFilter'] == '3') ? 'selected' : ''; ?>>Denied</option>
                    <option value="4" <?php echo (!isset($_POST['loansFilter']) || (isset($_POST['loansFilter']) && $_POST['loansFilter'] == '4')) ? 'selected' : ''; ?>>Pending</option>
                </select>
            </form>
        </div>
        <?php
            
            if($num == 0){?>
                <div class="noResults">
                    <i class="fa-solid fa-kiwi-bird" id="kiwi"></i></i>
                    <p class="noText"></p>-No Loan Offers Yet-</p>
                </div>
            <?php
            } else{

            

            $index = 1;
            while($row = mysqli_fetch_array($result)){

                $lender_ir = "SELECT Interest_Rate FROM lender_interest_rates
                WHERE Lender_ID = '" . $row["Lender_ID"] . "' AND Tenure_ID = '" . $row["Tenure_ID"] . "'";
                $paysched = "SELECT Frequency FROM payment_sched
                WHERE Schedule_ID = '" . $row["Schedule_ID"] . "'";
                $tenure = "SELECT * FROM tenure 
                WHERE Tenure_ID = '" . $row["Tenure_ID"] . "'";
                $lender = "SELECT * FROM lender 
                WHERE Lender_ID = '" . $row["Lender_ID"] . "'";

                $modalId = "infoModal_" . $index;
                $overlayId = "overlay_" . $index;
                
                $userDetails = getUserDetails($con, $row["User_ID"]);
                $loanDetails = calculateLoanDetails($con, $row["Loan_Amt"], $lender_ir, $tenure, $paysched, $lender);
            
            
        ?>
        <div class="loan_container">
            <div class="centered_column">
                <img src="../images/slideshow2.png" alt="Company Logo" class="company_logo">
            </div>

            <div class="column">
                <div class="row">
                    <h2><?php echo $userDetails['userLname'];?>, <?php echo $userDetails['userFname'];?> <?php echo $userDetails['userMname'];?></h2>
                </div>
                <div class="row">
                    <p>Loan Amount: ₱<?php echo $row['Loan_Amt'];?></p>
                </div>
            </div>

            <div class="column">
                <div class="row">
                    <h3>Interest Rate</h3>
                </div>
                <div class="row_value">
                    <p><?php echo $loanDetails['monthly_interest'];?>%</p>
                </div>
                <div class="row">
                    <h3>per month</h3>
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
                    <p><?php echo $row['Status'];?></p>
                </div>
            </div>

            <div class="centered_column">
                <div class="row">
                    <button onclick="openModal('<?php echo $modalId; ?>', '<?php echo $overlayId; ?>')">More Info</button>
                </div>
            </div>

            <div id="<?php echo $overlayId; ?>" class="overlay" onclick="closeModal('<?php echo $modalId; ?>', '<?php echo $overlayId; ?>')"></div>
            
            <div id="<?php echo $modalId; ?>" class="modal">
                <h2>
                    <div class="row">
                        <?php echo $userDetails['userLname'];?>, <?php echo $userDetails['userFname'];?> <?php echo $userDetails['userMname'];?> 
                    </div>
                </h2>

                <p>Email Address: <?php echo $userDetails['userEmail']; ?></p>
                <p>Contact Number: <?php echo $userDetails['userContact']; ?></p>
                <p>Loan Amount: ₱<?php echo number_format($row['Loan_Amt'], 2, '.', ','); ?></p>
                <p>Tenure Selected: <?php echo $loanDetails['loan_tenure'];?></p>
                <p>Payment Schedule Selected: <?php echo $loanDetails['payment_schedule'];?></p>
                <p>Interest: <?php echo number_format($loanDetails['ir_result'], 2, '.', ','); ?>%</p>
                <p>Interest Payable: ₱<?php echo number_format($loanDetails['interest_payable'], 2, '.', ','); ?></p>
                <p>Monthly Payment: ₱<?php echo $loanDetails['monthly_payable'];?></p>
                <p>Total Payable: ₱<?php echo number_format($loanDetails['total_payable'], 2, '.', ','); ?></p>
                
                <form method="post" action="updateLoanApp_Status.php">
                    <input type="hidden" name="loanAppID" value="<?php echo $row['LoanApp_ID']; ?>">
                    <div class="button-container">
                        <button type="submit" name="status" value="Denied">Deny</button>
                        <button type="submit" name="status" value="Approved">Approve</button>
                    </div>
                </form>
            
            </div>

        </div>

        <?php
            $index++;
            }
        }
        ?>
    
    </div>


    <script src="https://kit.fontawesome.com/e140ca9b66.js" crossorigin="anonymous"></script>       
    <script src="../js/slideshow.js"></script>
    <script src="../js/viewLoans.js"></script>

    </body>
</html>

<?php
    function calculateLoanDetails($con, $amt_borrowed, $lender_ir, $tenure, $paysched, $lender)
    {
        $ir_query = mysqli_query($con, $lender_ir);
        $ir_result = mysqli_fetch_array($ir_query);

        $sched_query = mysqli_query($con, $paysched);
        $sched_result = mysqli_fetch_array($sched_query);

        $resultTenure = mysqli_query($con, $tenure);
        $selectedTenure = mysqli_fetch_array($resultTenure);

        $resultLender= mysqli_query($con, $lender);
        $lenderName = mysqli_fetch_array($resultLender);

        $interest_payable = ($amt_borrowed * $ir_result["Interest_Rate"]);
        
        $ir_result["Interest_Rate"] = 100 * $ir_result["Interest_Rate"];
        $total_payable = $interest_payable + $amt_borrowed;
    
        switch ($selectedTenure["Tenure_ID"]) {
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
            'payment_schedule' => $sched_result["Frequency"],
            'loan_tenure' => $selectedTenure["Duration"],
            'lender_name' => $lenderName["Lender_Name"],
            'lender_email' => $lenderName["Email"],
            'lender_contact' => $lenderName["Contact_Number"]
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