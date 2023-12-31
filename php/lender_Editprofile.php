<?php

session_start();

if ($_SESSION['SESSIONID_VALUE'] != session_id()){
    header('location: index.php');
}
    $con = mysqli_connect('localhost', 'root', 'Furina de Fontaine');  //Change according to your settings
    mysqli_select_db($con, 'loanapp');


    $s = "SELECT * FROM lender WHERE Lender_ID = '{$_SESSION['id']}'";
    $result = mysqli_query($con, $s);
    $num = mysqli_num_rows($result); 
    $profileDetails = mysqli_fetch_array($result)

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Profile</title>
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/slideshow.css">
    <link rel="stylesheet" href="../css/searchBar.css">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/userProfile.css">
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
                <a href="#lender_Dashboard.php"><img src="../images/ldaddy.png" class="logo"></a>
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
                            <a id="dp-option" href="lender_profile.php"> <i class="fa-regular fa-user"></i> View Profile</a>
                            <a id="dp-option" href="logout.php" onclick="return confirm('Are you sure you want to logout?')"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
                        </div>
                </li>
            </ul>
        </div>
        
    </nav>
    
    
    <div class="container" id="container">
        
        <div class="form-item" >
            <h1>Company Profile</h1>
            <form action="lender_Updateprofile.php" method="POST">
            
                            <div class="form-row">
                                <div class="form-item">
                                    <label for="Name">Name</label>
                                    <input type="text" name="Name" value="<?php echo $profileDetails['Lender_Name'];?>"> 
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-item">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" value="<?php echo $profileDetails['Email'];?>" readonly>
                                </div>
                                <div class="form-item">
                                    <label for="contactNum">Contact Number</label>
                                    <input type="text" name="contactNum" value="<?php echo $profileDetails['Contact_Number'];?>" readonly>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-item">
                                    <label for="minLoan">Minimum Loan Amount</label>
                                    <input type="text" name="minLoan" value="<?php echo $profileDetails['MinLoan_Amt'];?>" readonly>
                                </div>
                                <div class="form-item">
                                    <label for="maxLoan">Maximum Loan Amount</label>
                                    <input type="text" name="maxLoan" value="<?php echo $profileDetails['MaxLoan_Amt'];?>" readonly>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-item">
                                    <label for="minSal">Minimum Salary Required</label>
                                    <input type="text" name="minSal" value="<?php echo $profileDetails['MinSalary_Required'];?>"> 
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-item">
                                    <label for="desc">Description</label>
                                    <input type="text" name="desc" value="<?php echo $profileDetails['Description'];?>"> 
                                </div>
                            </div>

                       
            <div>
                <div class="row">
                    <div class="column">

                        
                            </div>
                        </div>
                        <div class="success" id = "updateSuccessMsg">
                            <?php
                        $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                        
                        if(strpos($fullUrl, "success=update") == true) {
                            echo '<p id="updateSuccessMsg">Successfully updated details!</p>';
                        }
                        
                        
                        ?>
                </div>
                <div class="fail">
                    <?php
                        $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                        
                        if(strpos($fullUrl, "duplicate=error") == true) {
                            echo '<p id="failMsg">Email already exists!</p>';
                        }
                        
                        
                        ?>
                </div>
                        
                <div class="row">
                <div class="column">
                    <button type="submit" class="getVerified">Submit</button>
                </div>
                <div class="column">
                        <button class="approve-btn" onClick="lender_profile.php" type="button"><a href="lender_profile.php" id="cancelbtn">Cancel</a></button>
    
                </div>
                
            </div>

            </form>
            </div>
        </div>

        <script src="https://kit.fontawesome.com/e140ca9b66.js" crossorigin="anonymous"></script>       
    </body>
</html>