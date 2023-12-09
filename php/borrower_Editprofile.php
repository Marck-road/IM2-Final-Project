<?php

session_start();

if ($_SESSION['SESSIONID_VALUE'] != session_id()){
    header('location: index.php');
}
    $con = mysqli_connect('localhost', 'root', 'Furina de Fontaine');  //Change according to your settings
    mysqli_select_db($con, 'loanapp');


    $s = "SELECT * FROM user WHERE User_ID = '{$_SESSION['id']}'";
    $result = mysqli_query($con, $s);
    $num = mysqli_num_rows($result); 
    $profileDetails = mysqli_fetch_array($result)

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
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
    
    
    <div class="container" id="container">
    <div class="form-item">
        <h1>User Profile</h1>
        <form action="edit_profile_action.php" method="post">
            <div class="form-row">
                <div class="form-item">
                    <label for="name">First Name</label>
                    <input type="text" name="fname" value="<?php echo $profileDetails['First_Name'];?>" step="any">
                    <label for="name">Middle Name</label>
                    <input type="text" name="mname" value=" <?php echo $profileDetails['Middle_Name'];?>step="any">
                    <label for="name">Last Name</label>
                    <input type="text" name="lname" value="<?php echo $profileDetails['Last_Name'];?>" step="any">
                </div>
            </div>

            <div class="form-row">
                <div class="form-item">
                    <label for="email">Email</label>
                    <input type="email" name="email" value="<?php echo $profileDetails['Email'];?>">
                </div>
                <div class="form-item">
                    <label for="phone">Phone Number</label>
                    <input type="text" name="phone" value="<?php echo $profileDetails['Contact_Number'];?>">
                </div>
            </div>

            <div class="form-row">
                <div class="form-item">
                    <label for="interest">Birthday</label>
                    <input type="text" name ="birthday" value="<?php echo $profileDetails['Birthday'];?>" >
                </div>
                <div class="form-item">
                    <label for="interest_payable">City</label>
                    <input type="text" name="city" value="<?php echo $profileDetails['City'];?>" >
                </div>
            </div>

            <div class="form-row">
                <div class="form-item">
                    <label for="monthly_payment">ZIP_Code</label>
                    <input type="text" name="zip" value="<?php echo $profileDetails['ZIP_Code'];?>" >
                </div>
                <div class="form-item">
                    <label for="total_payable">Employment Status</label>
                    <input type="text" name="employment" value="<?php echo $profileDetails['Employment_Status']; ?>" >
                </div>
            </div>
            <div>

            <div class="row">
                <div class="column">
                    <button type="submit" class="getVerified">Submit</button>
                </div>
                <div class="column">
                        <button class="approve-btn" onClick="borrower_profile.php" type="button"><a href="borrower_profile.php" id="cancelbtn">Cancel</a></button>
    
                </div>
                
            </div>
        </form>
    </div>
</div>
        <script src="https://kit.fontawesome.com/e140ca9b66.js" crossorigin="anonymous"></script>       
    </body>
</html>