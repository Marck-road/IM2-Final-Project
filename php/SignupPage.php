<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create an Account for Free!</title>
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/signup.css">
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
                <li><a href="../php/index.php">Home</a></li>
                <li><a href="applyLender.php">Join our Team</a></li>
                <li><a href="About Us/About Us.html">Contact Us</a></li>
                <li><a href="#footer">About Us</a></li>
                <li><a href="#footer">FAQs</a></li>
                <li><a href="Loginpage.php">Login</a></li>

            </ul>
        </div>
    </nav>
    
    <div class="content-container">
        <div class="register-container">
            <form action="../php/userRegister.php" method="post" id="regForm">
                <h3>Registration</h3>

                <div class="tab">
                    <!-- First and Middle Name in the same row -->
                    <div class="row-container">
                        <div class="form-group">
                            <label for="fname">First Name</label>
                            <input type="text" id="fname" placeholder="Enter First Name" name="fname" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="mname">Middle Name</label>
                            <input type="text" id="mname" placeholder="Enter Middle Name" name="mname">
                        </div>
                    </div>
            
                    <!-- Last Name -->
                    <div class="form-group">
                        <label for="lname">Last Name</label>
                        <input type="text" id="lname" placeholder="Enter Last Name" name="lname" required>
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" placeholder="Enter Email Address" name="email" required>
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" placeholder="Enter Password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="confPassword">Confirm Password</label>
                        <input type="password" id="confPassword" placeholder="Enter Password" name="confPassword" required>
                    </div>
                </div>

                <div class="tab">
                    <div class="row-container">
                        <!-- Contact Number -->
                        <div class="form-group">
                            <label for="contactNum">Contact Number</label>
                            <input type="text" id="contactNum" placeholder="Enter Contact Number" name="contactNum" required>
                        </div>
                
                        <!-- Birthday -->
                        <div class="form-group">
                            <label for="birthday">Birthday</label>
                            <input type="date" id="birthday" name="birthday" required>
                        </div>
                    </div>

                    <div class="row-container">
                        <!-- City -->
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" id="city" placeholder="Enter City" name="city" required>
                        </div>
                
                        <!-- Province -->
                        <div class="form-group">
                            <label for="province">Province</label>
                            <input type="text" id="province" placeholder="Enter Province" name="province" required>
                        </div>
                    </div>
            
                    
            
                    <!-- Zip Code -->
                    <div class="form-group">
                        <label for="zipCode">Zip Code</label>
                        <input type="text" id="zipCode" placeholder="Enter Zip Code" name="zipCode" required>
                    </div>
            
                    <!-- Monthly Income -->
                    <div class="form-group">
                        <label for="monthlyIncome">Monthly Income</label>
                        <input type="number" id="monthlyIncome" placeholder="Enter Monthly Income" name="monthlyIncome" required>
                    </div>
            
                    <!-- Employment Status Dropdown -->
                    <div class="form-group">
                        <label for="employmentStatus">Employment Status</label>
                        <select id="employmentStatus" name="employmentStatus" required>
                            <option value="employed">Employed</option>
                            <option value="self-employed">Self-Employed</option>
                            <option value="unemployed">Unemployed</option>
                        </select>
                    </div>
                </div>

                <div style="text-align:center;margin-top:40px;">
                    <span class="step"></span>
                    <span class="step"></span>
                </div>

                

                <!-- Submit Button -->
                <div class="button-container">
                    <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                    <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                </div>

                <div class="errors">
                    <?php
                        $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

                        echo '<p id="failMsg">Email already taken</p>';
                        
                        
                            
                        
                        if(strpos($fullUrl, "pass=error") == true) {
                            echo '<p id="failMsg">Passwords does not match</p>';
                        }

                        if(strpos($fullUrl, "duplicate=error") == true) {
                            echo '<p id="failMsg">Email already taken</p>';
                        }

                        if(strpos($fullUrl, "empty=error") == true) {
                            echo '<p id="failMsg">Please fill in all the fields</p>';
                        }

                        if(strpos($fullUrl, "email=error") == true) {
                            echo '<p id="failMsg">Not valid email</p>';
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

    <script src="../js/signup.js"></script>
</body>
</html>