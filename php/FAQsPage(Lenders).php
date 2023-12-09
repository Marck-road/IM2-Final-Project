<?php
    

    session_start();
    
    if ($_SESSION['SESSIONID_VALUE'] != session_id()){
        header('location: index.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoanDaddy FAQs</title>
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/FAQs.css">
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
                            <a id="dp-option" href="lender_profile.php"> <i class="fa-regular fa-user"></i> View Profile</a>
                            <a id="dp-option" href="logout.php" onclick="return confirm('Are you sure you want to logout?')"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
                        </div>
                </li>
            </ul>
        </div>
        
    </nav>
    
    <div class="content-container">
        <div class="asking-container">
            <h2>FAQ</h2>
            <p><center>Frequently Asked Questions</center></p>

            <h3>1. What is LoanDaddy?</h3>
            <p>LoanDaddy is a platform that facilitates secure and efficient loan transactions. Whether you're an individual or a business, we connect borrowers with suitable lenders to meet financial needs.</p>

            <h3>2. How does LoanDaddy work?</h3>
            <p>Borrowers can browse available lenders, apply for personal loans, and monitor transactions on our web-based platform. Lenders can approve loans, track repayments, and manage their lending portfolio.</p>

            <h3>3. Is LoanDaddy a legitimate service?</h3>
            <p>Yes, LoanDaddy is a legitimate service. We prioritize the security and stability of transactions and work with trusted partners to ensure a reliable financial ecosystem.</p>

            <h3>4. How is my personal information protected?</h3>
            <p>We implement security measures to protect your personal information. Please refer to our Privacy Policy for detailed information on how we handle data.</p>

            <h3>5. How can I edit my account information?</h3>
            <p>Log in to your account, go to the Profile Settings, and make the necessary edits. Ensure your information is up-to-date for a seamless experience.</p>

            <h3>6. Can I negotiate loan terms with the lender?</h3>
            <p>Yes, borrowers can communicate with lenders to negotiate loan terms, including extending the tenure or modifying payment schedules.</p>
        </div>
    </div>

    <?php
        include '../html/footer(Lenders).html';
    ?>

<script src="https://kit.fontawesome.com/e140ca9b66.js" crossorigin="anonymous"></script>
    
</body>
</html>
