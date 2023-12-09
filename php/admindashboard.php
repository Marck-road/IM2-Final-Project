<?php

session_start();

if ($_SESSION['SESSIONID_VALUE'] != session_id()){
    header('location: index.php');
}

    $con = mysqli_connect('localhost', 'root', 'Furina de Fontaine');
    mysqli_select_db($con, 'loanapp');

    if ($con->connect_error) {
        die("Connection failed: " . $cnn->connect_error);
    }

    $sql = "SELECT COUNT(*) AS notification_count FROM notification WHERE is_read = 0";

    $result = $con->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $notificationCount = $row["notification_count"];
    } else {
        $notificationCount = 0;
    }

    $con->close();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Dashboard</title>
        <link rel="stylesheet" href="../css/navbar.css">
        <link rel="stylesheet" href="../css/admindashboard.css">
        <link rel="stylesheet" href="../css/adminActivityLog.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-..."
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="../css/loginpage.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;400&display=swap" rel="stylesheet">
    </head>

    <body>
        <nav>
            <div class="navbar">
                <div class="logo">
                    <a href="#"><img src="../images/ldaddy.png" class="logo"></a>
                </div>
                <div class="navbar-center">
                    <h1>ADMIN DASHBOARD</h1>
                </div>
                <ul class="menu">
                </ul>
            </div>
        </nav>        
        
        <div class="dashboard">
        <div class="top-row">
            <?php if ($notificationCount > 0) { ?>
                <a href="../php/verificationRequest.php" class="box">
                    <span class="notif-badge"><?php echo $notificationCount; ?></span>
                    <img src="../images/verify.png" alt="Verification Requests">
                    <h3>Verification Requests</h3>
                </a>
            <?php } else { ?>
                <a href="../php/verificationRequest.php" class="box">
                    <img src="../images/verify.png" alt="Verification Requests">
                    <h3>Verification Requests</h3>
                </a>
            <?php } ?>

            <?php if ($notificationCount > 0) { ?>
                <a href="admin_lenderApplicants" class="box">
                    <span class="notif-badge"><?php echo $notificationCount; ?></span>
                    <img src="../images/lender.png" alt="Lender Applicants">
                    <h3>Lender Applicants</h3>
                </a>
            <?php } else { ?>
                <a href="admin_lenderApplicants.php" class="box">
                    <img src="../images/lender.png" alt="Lender Applicants">
                    <h3>Lender Applicants</h3>
                </a>
            <?php } ?>

            <?php if ($notificationCount > 0) { ?>
                <a href="../php/adminActivityLog.php" class="box">
                    <span class="notif-badge"><?php echo $notificationCount; ?></span>
                    <img src="../images/activity.png" alt="Activity Log">
                    <h3>Activity Log</h3>
                </a>
            <?php } else { ?>
                <a href="../php/adminActivityLog.php" class="box">
                    <img src="../images/activity.png" alt="Activity Log">
                    <h3>Activity Log</h3>
                </a>
            <?php } ?>
            </div>

            <div class="bottom-row">
            <?php if ($notificationCount > 0) { ?>
                <a href="../php/userAccounts.php" class="box">
                    <span class="notif-badge"><?php echo $notificationCount; ?></span>
                    <img src="../images/user.png" alt="User Accounts">
                    <h3>User Accounts</h3>
                </a>
            <?php } else { ?>
                <a href="../php/userAccounts.php" class="box">
                    <img src="../images/user.png" alt="User Accounts">
                    <h3>User Accounts</h3>
                </a>
            <?php } ?>

            <?php if ($notificationCount > 0) { ?>
                <a href="../html/loanerAccounts.html" class="box">
                    <span class="notif-badge"><?php echo $notificationCount; ?></span>
                    <img src="../images/loaner.png" alt="Loaner Accounts">
                    <h3>Lender Accounts</h3>
                </a>
            <?php } else { ?>
                <a href="admin_lenderAccounts.php" class="box">
                    <img src="../images/loaner.png" alt="Loaner Accounts">
                    <h3>Lender Accounts</h3>
                </a>
            <?php } ?>
            </div>
        </div>
    </div>        

    </body>
</html> 
