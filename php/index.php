<?php
    session_start();

    $con = mysqli_connect('localhost', 'root', 'Furina de Fontaine');  //Change according to your settings
    mysqli_select_db($con, 'loanapp');

    // $sort = "ASC";
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
    <title>Welcome to LoanDaddy</title>
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/slideshow.css">
    <link rel="stylesheet" href="../css/searchBar.css">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;400&display=swap" rel="stylesheet">
</head>
<body>
<div class="wrapper">
    <nav>
        <div class="navbar">
            <div class="logo">
                <a href="#"><img src="../images/ldaddy.png" class="logo"></a>
            </div>
            <ul class="menu">
                <li><a href="index.php">Home</a></li>
                <li><a href="applyLender.php">Join our Team</a></li>
                <li><a href="#footer">Contact Us</a></li>
                <li><a href="AboutUsPage.php">About Us</a></li>
                <li><a href="FAQsPage.php">FAQs</a></li>
                <li><a href="Loginpage.php">Login</a></li>
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
            <p class="adv_label">Advanced Search:</p>
            
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
            
            $modalId = "infoModal_" . $index;
            $overlayId = "overlay_" . $index;
            $ir_query = mysqli_query($con, $lender_ir);
            $ir_result = mysqli_fetch_array($ir_query);
            $interest_payable = ($amt_borrowed * $ir_result["Interest_Rate"]);
            
            $ir_result["Interest_Rate"] = 100 * $ir_result["Interest_Rate"];
            $total_payable = $interest_payable + $amt_borrowed;

            if($tenure == 1){
                $monthly_interest = $ir_result["Interest_Rate"];
                $monthly_payable = number_format($total_payable, 2, '.', ',');
            } else if ($tenure == 2){
                $monthly_interest = round($ir_result["Interest_Rate"] / 2, 2);
                $monthly_payable = number_format($total_payable / 2, 2, '.', ',');
            } else if ($tenure == 3){
                $monthly_interest = round($ir_result["Interest_Rate"] / 6, 2);
                $monthly_payable = number_format($total_payable / 6, 2, '.', ',');
            } else if ($tenure == 4){
                $monthly_interest = round($ir_result["Interest_Rate"] / 12, 2);
                $monthly_payable= number_format($total_payable / 12, 2, '.', ',');
            } else if ($tenure == 5){
                $monthly_interest = round($ir_result["Interest_Rate"] / 24, 2);
                $monthly_payable= number_format($total_payable / 24, 2, '.', ',');
            } 
            
                // $lender_ir = $lender_ir * 100;

                
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
                        <p><?php echo $monthly_interest;?>%</p>
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
                        <p>₱<?php echo $monthly_payable;?></p>
                    </div>
                </div>

                <!-- Column 5: Apply Now Button, More Info Button -->
                <div class="centered_column">
                    <a href="Loginpage.php">
                        <div class="row">
                            <button>Apply Now</button>
                        </div>
                    </a>
                    <div class="row">
                        <button onclick="openModal('<?php echo $modalId; ?>', '<?php echo $overlayId; ?>')">More Info</button>
                    </div>
                </div>

                <div id="<?php echo $overlayId; ?>" class="overlay" onclick="closeModal('<?php echo $modalId; ?>', '<?php echo $overlayId; ?>')"></div>
            
                <div id="<?php echo $modalId; ?>" class="modal">
                <h2>
                    <div class="row">
                        <?php echo $row['Lender_Name'];?>
                    </div>
                </h2>


                <?php 
                    $getTenure = "SELECT * FROM tenure WHERE Tenure_ID = $tenure";
                    $resultTenure = mysqli_query($con, $getTenure);

                    $selectedTenure = mysqli_fetch_array($resultTenure);
                ?>

                <p>Email Address: <?php echo $row['Email']; ?></p>
                <p>Contact Number: <?php echo $row['Contact_Number']; ?></p>
                <p>Minimum Salary Required: ₱<?php echo number_format($row['MinSalary_Required'], 2, '.', ','); ?></p>
                <p>Loan Amount: ₱<?php echo number_format($amt_borrowed, 2, '.', ','); ?></p>
                <p>Tenure Selected: <?php echo $selectedTenure['Duration'];?></p>
                <p>Interest: <?php echo number_format($ir_result["Interest_Rate"], 2, '.', ','); ?>%</p>
                <p>Interest Payable: ₱<?php echo number_format($interest_payable, 2, '.', ','); ?></p>
                <p>Monthly Payment: ₱<?php echo $monthly_payable;?></p>
                <p>Total Payable: ₱<?php echo number_format($total_payable, 2, '.', ','); ?></p>
                
               
                <button onclick="closeModal('<?php echo $modalId; ?>', '<?php echo $overlayId; ?>')">Close</button>
                <a href="Loginpage.php">
                    <button>Apply Now</button>
                </a>
                </div>
            </div>

          

            <?php
            $index++;
            }
            ?>
        </div>

    </div>

    <?php
        include '../html/footer.html';
    ?>

           

    <script src="../js/modal.js"></script>
    <script src="../js/slideshow.js"></script>
</body>
</html>