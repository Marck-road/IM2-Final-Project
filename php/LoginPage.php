<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login to LoanDaddy</title>
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/loginpage.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;400&display=swap" rel="stylesheet">
</head>
<body>
    <nav>
        <div class="navbar">
            <div class="logo">
                <a href="index.php"><img src="../images/ldaddy.png" class="logo"></a>
            </div>
            <ul class="menu">
                <li><a href="index.php">Home</a></li>
                <li><a href="applyLender.php">Join our Team</a></li>
                <li><a href="About Us/About Us.html">Contact Us</a></li>
                <li><a href="#footer">About Us</a></li>
                <li><a href="#footer">FAQs</a></li>
            </ul>
        </div>
    </nav>
    
    <div class="content-container">
        <div class="login-container">
            <form action="../php/loginAction.php" method="post">
                <h3>Login</h3>
                <label for="email">Username/Email</label>
                <input type="text" id="email" placeholder="Enter email address" name="email" required>
                <label for="password">Password</label>
                <input type="password" id="password" placeholder="Enter Password"  name="password" required>
                <div class="botton-container">
                    <button type="submit">Login</button>
                </div>
                <div class="success">
                    <?php
                        $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

                        if(strpos($fullUrl, "update=success") == true) {
                            echo '<p id="updateSuccessMsg">Successfully registered account</p>';
                        }
                    ?>
                </div>

                <div class="fail">
                    <?php
                        $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

                        if(strpos($fullUrl, "password=error") == true) {
                            echo '<p id="failMsg">Incorrect Password</p>';
                        }

                        if(strpos($fullUrl, "login=error") == true) {
                            echo '<p id="failMsg">Login failed</p>';
                        }
                    ?>
                       
                </div>

                <p class="register_link">Don't have an account? <a href="SignupPage.php">Register now</a></p>
            </form>
        </div>
    
        <div class="filler-container">
            <h1>Welcome to LoanDaddy!</h1>
            <p>Writing effectively is an art. Start by using simple, everyday words people can 
                easily understand. Be clear and direct to the point. Keep your thoughts flowing 
                logically, and aim for brevity unless you’re writing in the long form. Your ideas 
                have a purpose so choose words that accurately express them. Ensure your grammar 
                is flawless as it impacts your credibility. Use the active voice whenever possible 
                as it makes any narrative easier to read.</p>
           
                <img src="../images/logo dark.png" class="content_logo">
           
            
        </div>
    </div>
    
    <?php
        include '../html/footer.html';
    ?>

</body>
</html>