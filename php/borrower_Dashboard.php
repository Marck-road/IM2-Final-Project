<?php
    session_start();

    if ($_SESSION['SESSIONID_VALUE'] != session_id()){
        header('location: index.php');
    }

    $con = mysqli_connect('localhost', 'root', 'Furina de Fontaine');  //Change according to your settings
    mysqli_select_db($con, 'loanapp');

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $amt_borrowed = $_POST["amt_borrowed"];
        $interest_rate = $_POST["interest"];
        $tenure = $_POST["tenure"];
        $pay_schedule = $_POST["pay_sched"];
    } else{
        $amt_borrowed = 60000;
        $interest_rate = 1;
        $tenure = 4;
        $pay_schedule = 3;
    }
    
    $s = "SELECT DISTINCT * 
      FROM lender 
      RIGHT JOIN lender_interest_rates ON lender.Lender_ID = lender_interest_rates.Lender_ID
      RIGHT JOIN lender_payment_scheds ON lender.Lender_ID = lender_payment_scheds.Lender_ID
      WHERE lender_interest_rates.Tenure_ID = $tenure
        AND lender_payment_scheds.Schedule_ID = $pay_schedule
        AND $amt_borrowed >= MinLoan_Amt
        AND $amt_borrowed <= MaxLoan_Amt
        AND lender_interest_rates.Interest_Rate <= $interest_rate
        AND lender.Verified_at IS NOT NULL
        ";

    $result = mysqli_query($con, $s);
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrower Dashboard</title>
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/slideshow.css">
    <link rel="stylesheet" href="../css/searchBar.css">
    <link rel="stylesheet" href="../css/index.css">
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
                <input type="number" name="amt_borrowed" id="amt_borrowed" value="<?php echo isset($_POST['amt_borrowed']) ? $_POST['amt_borrowed'] : '60000'; ?>" step="any"><br>

                <label for="interest">Interest Rate (per tenure)</label>
                <input type="number" name="interest" id="interest" value="<?php echo isset($_POST['interest']) ? $_POST['interest'] : '1'; ?>" step="any"><br>

                <label for="tenure">Tenure:</label>
                <select name="tenure" id="tenure">
                    <option value="1" <?php echo (isset($_POST['tenure']) && $_POST['tenure'] == '1') ? 'selected' : ''; ?>>1 Month</option>
                    <option value="2" <?php echo (isset($_POST['tenure']) && $_POST['tenure'] == '2') ? 'selected' : ''; ?>>3 Months</option>
                    <option value="3" <?php echo (isset($_POST['tenure']) && $_POST['tenure'] == '3') ? 'selected' : ''; ?>>6 Months</option>
                    <option value="4" <?php echo (!isset($_POST['tenure']) || (isset($_POST['tenure']) && $_POST['tenure'] == '4')) ? 'selected' : ''; ?>>1 Year</option>
                    <option value="5" <?php echo (isset($_POST['tenure']) && $_POST['tenure'] == '5') ? 'selected' : ''; ?>>2 Years</option>
                </select>


                <label for="pay_sched">Payment Schedule:</label>
                <select name="pay_sched" id="pay_sched">
                    <option value="1" <?php echo (isset($_POST['pay_sched']) && $_POST['pay_sched'] == '1') ? 'selected' : ''; ?>>Weekly</option>
                    <option value="2" <?php echo (isset($_POST['pay_sched']) && $_POST['pay_sched'] == '2') ? 'selected' : ''; ?>>Semi-Monthly</option>
                    <option value="3" <?php echo (!isset($_POST['pay_sched']) || (isset($_POST['pay_sched']) && $_POST['pay_sched'] == '3')) ? 'selected' : ''; ?>>Monthly</option>
                    <option value="4" <?php echo (isset($_POST['pay_sched']) && $_POST['pay_sched'] == '4') ? 'selected' : ''; ?>>Quarterly</option>
                </select>

                      <br>
                    <div class="button-container">
                        <input type="submit" value="Submit"> 
                    </div>
            </form>
        </div>

        <div class="ListView">
            <div class="List_header">
                <h1>Available Loans</h1>
            </div>
            <?php
            $index = 1;
            while($row = mysqli_fetch_array($result))
            {
            $lender_ir = "SELECT Interest_Rate FROM lender_interest_rates
              WHERE Lender_ID = '" . $row["Lender_ID"] . "' AND Tenure_ID = '" . $tenure . "'";
            $paysched = "SELECT Frequency FROM payment_sched
              WHERE Schedule_ID = '" . $pay_schedule . "'";
            
            $modalId = "infoModal_" . $index;
            $overlayId = "overlay_" . $index;
            
            $loanDetails = calculateLoanDetails($con, $amt_borrowed, $lender_ir, $tenure, $paysched);
        
                
            ?>
                <div class="loan_container">
                <!-- Column 1: Small Image -->
                <div class="centered_column">
                    <img src="../images/slideshow2.png" alt="Company Logo" class="company_logo">
                </div>

                <!-- Column 2: Company Name, Description -->
                <div class="column">
                    <div class="row">
                        <h2><?php echo $row['Lender_Name'];?></h2>
                    </div>
                    <div class="row">
                        <p><?php echo $row['Description'];?></p>
                    </div>
                </div>

                <!-- Column 3: Interest Rate -->
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

                <!-- Column 4: Monthly Repayment -->
                <div class="column">
                    <div class="row">
                        <h3>Monthly Repayment</h3>
                    </div>
                    <div class="row_value">
                        <p>₱<?php echo $loanDetails['monthly_payable'];?></p>
                    </div>
                </div>

                <!-- Column 5: Apply Now Button, More Info Button -->
                <div class="centered_column">
   
                    <div class="row">
                        <button onclick="openModal('<?php echo $modalId; ?>apply', '<?php echo $overlayId; ?>apply')">Apply Now</button>
                    </div>
               
                    <div class="row">
                        <button onclick="openModal('<?php echo $modalId; ?>', '<?php echo $overlayId; ?>')">More Info</button>
                    </div>
                </div>

                <div id="<?php echo $overlayId; ?>" class="overlay" onclick="closeModal('<?php echo $modalId; ?>', '<?php echo $overlayId; ?>')"></div>
                <div id="<?php echo $overlayId; ?>apply" class="overlay" onclick="closeModal('<?php echo $modalId; ?>apply', '<?php echo $overlayId; ?>apply')"></div>
                <div id="<?php echo $modalId; ?>" class="modal">

                
                <h2>
                    <div class="row" id="row_header">Company Info</div>
                    <div class="row" id="company_name">
                        <?php echo $row['Lender_Name'];?>
                    </div>
                </h2>
                    

                    <?php 
                        $getTenure = "SELECT * FROM tenure WHERE Tenure_ID = $tenure";
                        $resultTenure = mysqli_query($con, $getTenure);

                        $selectedTenure = mysqli_fetch_array($resultTenure);
                    ?>

                    <div class="info-row">
                        <div class="info-item">
                            <label for="email">Email Address:</label>
                            <input type="text" value="<?php echo $row['Email']; ?>" readonly>
                        </div>]
                    </div>

                    <div class="info-row">
                        <div class="info-item">
                            <label for="contact">Contact Number:</label>
                            <input type="text" value="<?php echo $row['Contact_Number']; ?>" readonly>
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-item">
                            <label for="min_salary">Minimum Salary Required:</label>
                            <input type="text" value="₱<?php echo number_format($row['MinSalary_Required'], 2, '.', ','); ?>" readonly>
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-item">
                            <label for="loan_amount">Loan Amount:</label>
                            <input type="text" value="₱<?php echo number_format($amt_borrowed, 2, '.', ','); ?>" readonly>
                        </div>
                        <div class="info-item">
                            <label for="tenure">Tenure Selected:</label>
                            <input type="text" value="<?php echo $selectedTenure['Duration'];?>" readonly>
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-item">
                            <label for="interest">Interest:</label>
                            <input type="text" value="<?php echo number_format($loanDetails['ir_result'], 2, '.', ','); ?>%" readonly>
                        </div>
                        <div class="info-item">
                            <label for="monthly_payment">Monthly Payment:</label>
                            <input type="text" value="₱<?php echo $loanDetails['monthly_payable'];?>" readonly>
                        </div>
                        
                    </div>

                    <div class="info-row">
                        <div class="info-item">
                            <label for="interest_payable">Interest Payable:</label>
                            <input type="text" value="₱<?php echo number_format($loanDetails['interest_payable'], 2, '.', ','); ?>" readonly>
                        </div>
                        <div class="info-item">
                            <label for="total_payable">Total Payable:</label>
                            <input type="text" value="₱<?php echo number_format($loanDetails['total_payable'], 2, '.', ','); ?>" readonly>
                        </div>
                    </div>
                    <div class="button-container">
                        <button onclick="closeModal('<?php echo $modalId; ?>', '<?php echo $overlayId; ?>')">Close</button>
                        <button onclick="closeOpenModal('<?php echo $modalId; ?>', '<?php echo $overlayId; ?>')">Apply Now</button>
                    </div>
                    
                </div>

                <div id="<?php echo $modalId; ?>apply" class="modal">
                <h2>
                    <div class="row" id="row_header">APPLY NOW</div>
                    <div class="row" id="company_name">
                        <?php echo $row['Lender_Name'];?>
                    </div>
                </h2>

                    
                    <form id="loanConfirmationForm" method="post" action="applyLoan.php">
                        <?php 
                            $getTenure = "SELECT * FROM tenure WHERE Tenure_ID = $tenure";
                            $resultTenure = mysqli_query($con, $getTenure);
                            $selectedTenure = mysqli_fetch_array($resultTenure);
                        ?>
                            <label for="amt_borrowed">Loan Amount</label>
                            <input type="number" name="amt_borrowed" id="amt_borrowed" value="<?php echo $amt_borrowed?>" step="any" readonly><br>

                            <label for="tenure">Tenure:</label>
                            <select name="tenure" id="tenure" disabled>
                                <option value="1" <?php echo ($tenure == '1') ? 'selected' : ''; ?>>1 Month</option>
                                <option value="2" <?php echo ($tenure == '2') ? 'selected' : ''; ?>>3 Months</option>
                                <option value="3" <?php echo ($tenure == '3') ? 'selected' : ''; ?>>6 Months</option>
                                <option value="4" <?php echo ($tenure == '4') ? 'selected' : ''; ?>>1 Year</option>
                                <option value="5" <?php echo ($tenure == '5') ? 'selected' : ''; ?>>2 Years</option>
                            </select>

                            <label for="pay_sched">Payment Schedule:</label>
                            <select name="pay_sched" id="pay_sched" disabled>
                                <option value="1" <?php echo ($pay_schedule == '1') ? 'selected' : ''; ?>>Weekly</option>
                                <option value="2" <?php echo ($pay_schedule == '2') ? 'selected' : ''; ?>>Semi-Monthly</option>
                                <option value="3" <?php echo ($pay_schedule == '3') ? 'selected' : ''; ?>>Monthly</option>
                                <option value="4" <?php echo ($pay_schedule == '4') ? 'selected' : ''; ?>>Quarterly</option>
                            </select>
                                
                            
                            <hr class="divider">

                            <h3>Confirm Details:</h3>
              
                            <div class="form-row">
                                <div class="form-item">
                                    <label for="amt_borrowed">Loan Amount</label>
                                    <input type="text" value="₱<?php echo number_format($amt_borrowed, 2, '.', ',');?>" step="any" readonly>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-item">
                                    <label for="tenure">Tenure Selected</label>
                                    <input type="text" value="<?php echo $selectedTenure['Duration'];?>">
                                </div>
                                <div class="form-item">
                                    <label for="pay_sched">Payment Schedule</label>
                                    <input type="text" value="<?php echo $loanDetails['payment_schedule'];?>">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-item">
                                    <label for="interest">Interest</label>
                                    <input type="text" value="<?php echo number_format($loanDetails['ir_result'], 2, '.', ','); ?>%">
                                </div>
                                <div class="form-item">
                                    <label for="interest_payable">Interest Payable</label>
                                    <input type="text" value="₱<?php echo number_format($loanDetails['interest_payable'], 2, '.', ','); ?>">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-item">
                                    <label for="monthly_payment">Monthly Payment</label>
                                    <input type="text" value="₱<?php echo $loanDetails['monthly_payable'];?>">
                                </div>
                                <div class="form-item">
                                    <label for="total_payable">Total Payable</label>
                                    <input type="text" value="₱<?php echo number_format($loanDetails['total_payable'], 2, '.', ','); ?>">
                                </div>
                            </div>

                              
                            
                                <!-- hiddedn values to be submitted -->
                                <input type="hidden" name="userID" value="<?php echo $_SESSION['id']; ?>">
                                <input type="hidden" name="lenderID" value="<?php echo $row['Lender_ID']; ?>">
                                <input type="hidden" name="scheduleID" value="<?php echo $pay_schedule; ?>">
                                <input type="hidden" name="tenureID" value="<?php echo $tenure; ?>">
                                <input type="hidden" name="loanAmt" value="<?php echo $amt_borrowed; ?>">
                                    
                                <div class="button-container">
                                    <button id ="submitModal" type="button" onclick="closeModal('<?php echo $modalId; ?>apply', '<?php echo $overlayId; ?>apply')">Cancel</button>
                                    <button id ="submitModal">Confirm</button> 
                                </div>

                    </form>
                </div>

           
                    <?php
                        $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

                        if(strpos($fullUrl, "success=application") == true) {
                            echo '<script>';
                                echo 'openSuccessModal("successModal", "successOverlay");';
                            echo '</script>';
                            ?>
                                
                            <?php
                        }
                    ?>

                    
               
                <div id="successOverlay" class="overlay" onclick="closeModal('successModal', 'successOverlay')"></div>
                    
                <div id="successModal" class="modal">
                    <div class="row">
                        Successfully applied loan! Please dont hesitate to contact the 
                        lender through email for more discussion and follow-ups. You will
                        be notified if your loan is approved! 
                    </div>
                    <div class="row">
                        <button id="successBtn" type="button" onclick="closeModal('successModal', 'successOverlay')">Okay</button>
                    </div>
                </div>           
            

            </div>

          

            <?php
            $index++;
            }
            ?>
        </div>

    </div>

    <?php
        include '../html/footer(Borrowers).html';
    ?>

    <script src="https://kit.fontawesome.com/e140ca9b66.js" crossorigin="anonymous"></script>       
    <script src="../js/slideshow.js"></script>
</body>
</html>

<?php
    function calculateLoanDetails($con, $amt_borrowed, $lender_ir, $tenure, $paysched)
    {
        $ir_query = mysqli_query($con, $lender_ir);
        $ir_result = mysqli_fetch_array($ir_query);

        $sched_query = mysqli_query($con, $paysched);
        $sched_result = mysqli_fetch_array($sched_query);

        $interest_payable = ($amt_borrowed * $ir_result["Interest_Rate"]);
        
        $ir_result["Interest_Rate"] = 100 * $ir_result["Interest_Rate"];
        $total_payable = $interest_payable + $amt_borrowed;
    
        switch ($tenure) {
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
            'payment_schedule' => $sched_result["Frequency"]
        ];
    }

?>