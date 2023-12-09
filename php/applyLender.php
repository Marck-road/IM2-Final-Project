<?php
    

    session_start();
    
    if ($_SESSION['SESSIONID_VALUE'] != session_id()){
        header('location: index.php');
    }

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Become One of Us!</title>
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/applyLender.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;400&display=swap" rel="stylesheet">
</head>
<body>
    <label class="hamburger_menu">
        <input type="checkbox">
    </label>


    <nav>
        <div class="navbar">
            <div class="logo">
                <a href="../php/index.php"><img src="../images/ldaddy.png" class="logo"></a>
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
    
    <div class="content-container">
        <div class="register-container">
            <form action="applyLenderAction.php" method="post" id="regForm">
                <h2>Become a LoanDaddy</h2>

                <div class="tab">
       
                    <div class="form-group">
                        <label for="companyName">Company Name</label>
                        <input type="text" id="companyName" placeholder="Enter Company Name" name="companyName" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" placeholder="Enter Email Address" name="email" required>
                    </div>
                    
                    <div class="row-container">
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" placeholder="Enter Password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="confPassword">Confirm Password</label>
                        <input type="password" id="confPassword" placeholder="Enter Password" name="confPassword" required>
                    </div>
                    </div>

                    <div class="form-group">
                        <label for="contactNum">Contact Number</label>
                        <input type="text" id="contactNum" placeholder="Enter Contact Number" name="contactNum" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="desc">Description</label>
                        <input type="text" id="desc" placeholder="Enter Company Description" name="desc" required>
                    </div>

                   
                </div>

                <div class="tab">
                    <div class="form-group">
                        <label for="minSalary">Minimum Salary Required</label>
                        <input type="text" id="minSalary" placeholder="Enter Minimum Salary Required" name="minSalary" required>
                    </div>
                
                    <div class="row-container">
                        <div class="form-group">
                            <label for="minLoan">Minimum Loan Amount</label>
                            <input type="text" id="minLoan" placeholder="Enter Minimum Loan Amount" name="minLoan" required>
                        </div>
                

                        <div class="form-group">
                            <label for="maxLoan">Maximum Loan Amount</label>
                            <input type="text" id="maxLoan" placeholder="Enter Maximum Loan Amount" name="maxLoan" required>
                        </div>
                    </div>
            
                </div>

                <div class="tab">
                    <h3>Select Interest Rates Based on Tenure</h3>
                    <label class="container" onclick="activateT1()">1 Month
                        <input type="checkbox" value= '1' id="Tenure1" name="Tenure1">
                        <span class="checkmark"></span>
                    </label>

                    <div class="percent-container" id="inputT1" style="display:none">
                        <input type="text" placeholder="Enter Interest Rate of 1 Month" name="inputT1" required>
                        <span class="percent-sign">%</span>
                    </div>

                    <label class="container" onclick="activateT2()">3 Months
                        <input type="checkbox" value= '2' id="Tenure2" name="Tenure2">
                        <span class="checkmark"></span>
                    </label>

                    <div class="percent-container" id="inputT2" style="display:none" >
                        <input type="text" placeholder="Enter Interest Rate of 3 Months" name="inputT2" required>
                        <span class="percent-sign">%</span>
                    </div>

                    
                    <label class="container" onclick="activateT3()">6 Months
                        <input type="checkbox" #value= '3' id="Tenure3" name="Tenure3">
                        <span class="checkmark"></span>
                    </label>

                    <div class="percent-container" id="inputT3" style="display:none">
                        <input type="text" placeholder="Enter Interest Rate of 6 Months" name="inputT3" required>
                        <span class="percent-sign">%</span>
                    </div>
                    
                    <label class="container" onclick="activateT4()">1 Year
                        <input type="checkbox" value= '4' id="Tenure4" name="Tenure4">
                        <span class="checkmark"></span>
                    </label>

                    <div class="percent-container" id="inputT4" style="display:none">
                        <input type="text" placeholder="Enter Interest Rate of 2 Years" name="inputT4" required>
                        <span class="percent-sign">%</span>
                    </div>

                    <label class="container" onclick="activateT5()">2 Years
                        <input type="checkbox" value= '5' id="Tenure5" name="Tenure5">
                        <span class="checkmark"></span>
                    </label>

                    <div class="percent-container" id="inputT5" style="display:none">
                        <input type="text" placeholder="Enter Interest Rate of 2 Years" name="inputT5" required>
                        <span class="percent-sign">%</span>
                    </div>
                    
                </div>

                <div class="tab">
                    <h3>Select your Company's Accepted Payment Schedules</h3>

                    <label class="container">Weekly
                        <input type="checkbox" value= '1' id="paysched1" name="paysched1">
                        <span class="checkmark"></span>
                    </label>

                    <label class="container">Semi-Monthly
                        <input type="checkbox" value= '2' id="paysched2" name="paysched2">
                        <span class="checkmark"></span>
                    </label>
                    
                    <label class="container">Monthly
                        <input type="checkbox" #value= '3' id="paysched3" name="paysched3">
                        <span class="checkmark"></span>
                    </label>

                    <label class="container">Quarterly
                        <input type="checkbox" value= '4' id="paysched4" name="paysched4">
                        <span class="checkmark"></span>
                    </label>

                </div>
                

                <div style="text-align:center;margin-top:40px;">
                    <span class="step"></span>
                    <span class="step"></span>
                    <span class="step"></span>
                    <span class="step"></span>
                </div>

                <!-- Submit Button -->
                <div class="button-container">
                    <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                    <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                </div>

                <div class="success">
                    <?php
                        $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

                        if(strpos($fullUrl, "success=register") == true) {
                            echo "Application Successfully Sent! ";
                            echo "Please wait for an email from us for any updates
                            regarding your application!";
                        }
                    ?>
                </div>

                <div class="errors">
                    <?php
                        $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

                        if(strpos($fullUrl, "duplicate=error") == true) {
                            echo "Email already taken";
                        }

                        if(strpos($fullUrl, "empty=error") == true) {
                            echo "Please fill in all the fields";
                        }

                        if(strpos($fullUrl, "email=error") == true) {
                            echo "Not valid email";
                        }
                    ?>
                </div>

        
                
        
                <p class="login-link" id="login-link">Already have an account? <a href="LoginPage.php">Login</a></p>
            </form>
        </div>
    </div>

    <?php
        include '../html/footer.html';
    ?>

    <script src="../js/multiForm.js"></script>
    
    

</body>
</html>