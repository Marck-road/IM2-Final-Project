<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Verification Requests</title>
        <link rel="stylesheet" href="../css/navbar.css">
        <link rel="stylesheet" href="../css/verificationRequests.css">
    </head>
    <body>
        <nav>
            <div class="navbar">
                <div class="logo">
                    <a href="../php/index.php"><img src="../images/ldaddy.png" class="logo"></a>
                </div>
                <div class="navbar-center">
                    <h1>VERIFICATION REQUEST</h1>
                </div>
                <ul class="menu">
                </ul>
            </div>
        </nav>       

        <div class="container">
        <?php
            $conn = mysqli_connect('localhost', 'root', '');
            mysqli_select_db($conn, 'loanapp');

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $query = "SELECT * FROM verification_requests WHERE status = 'pending'";
            $result = mysqli_query($conn, $query);

            if(mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    $name = $row['name'];
                    $email = $row['email']; 
                    
                    echo "<div class='rectangle'>";
                    echo "<img src='../images/temp.png' alt='Profile'>";
                    echo "<div class='name-email'>";
                    echo "<div class='name'>$name</div>";
                    echo "<div class='email'>$email</div>";
                    echo "</div>";
                    echo "<a href='../php/userProfile.php' class='more-info-link'>";
                    echo "<button class='more-info-btn'>More Info</button>";
                    echo "</a>";
                    echo "</div>";
                }
            } else {
                echo "<p>No pending verification requests.</p>";
            }
        ?>

        </div>

    </body>
</html>
