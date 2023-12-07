<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - LoanDaddy</title>
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/aboutus.css"> <!-- Add your about us page-specific CSS file here -->
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
                <li><a href="borrower_Dashboard.php">Home</a></li>
                <li><a href="viewLoans.php">View Loans</a></li>
                <li><a href="#footer">Contact Us</a></li>
                <li><a href="AboutUsPage(Borrowers).php">About Us</a></li>
                <li><a href="FAQsPage(Borrowers).php">FAQs</a></li>
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

    <div class="content-container">
        <div class="about-us-container">
            <h2>About Us</h2>

            <div class="about-section">
                <div class="left-section">
                    <h3>Who we are?</h3>
                    <p>Welcome to LoanDaddy, where we understand that borrowing money is a common necessity in life. Founded with a mission to provide efficient and secure loan transactions, we cater to the financial needs of individuals and businesses.</p>
                </div>

                <div class="right-section">
                    <h3>Our Story</h3>
                    <p>In a world where expenses are constant, LoanDaddy emerged to address the challenges faced by individuals and businesses in securing loans. Whether it's for business expansion, unexpected expenses, or personal needs, we aim to simplify the loaning process.</p>
                </div>
            </div>

            <div class="team-section">
                <h3>Our Team</h3>
                <div class="team-members">
                    <div class="team-member">
                        <img src="../images/team_member2.jpg" alt="Team Member 1">
                        <p><b>Peter Abangan</b></p>
                    </div>
                    <div class="team-member">
                        <img src="../images/team_member1.jpg" alt="Team Member 2">
                        <p><b>Mark Calzada></b></p>
                        <p>Team Leader</p>
                    </div>
                    <div class="team-member">
                        <img src="../images/team_member3.jpg" alt="Team Member 3">
                        <p><b>Athena Uy</b></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
        include '../html/footer(Borrowers).html';
    ?>
    
    <script src="https://kit.fontawesome.com/e140ca9b66.js" crossorigin="anonymous"></script>       
</body>

</html>
