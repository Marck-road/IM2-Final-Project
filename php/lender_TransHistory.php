<?php
    session_start();

    $con = mysqli_connect('localhost', 'root', 'Furina de Fontaine');  //Change according to your settings
    mysqli_select_db($con, 'loanapp');

    $LBPeriod_id = $_POST['LBPeriod_id']; 
    $loanDetails = json_decode($_POST['loanDetails'], true);
    $userDetails = json_decode($_POST['userDetails'], true);

    $jsonloanDetails = json_encode($loanDetails);
    $jsonUserDetails = json_encode($userDetails);

    $sql = "SELECT Loan_ID FROM loanbilling_period Where LBPeriod_ID = $LBPeriod_id";
    $result = mysqli_query($con, $sql);
    $loan_id = mysqli_fetch_array($result);


    $s = "SELECT Payment_ID, payment.Amount_Paid, Screenshot, Payment_Channel, payment.Status, payment.Created_at, loanbilling_period.Loan_ID
    FROM payment 
    INNER JOIN loanbilling_period
    ON loanbilling_period.LBPeriod_ID = payment.LBPeriod_ID
    WHERE loanbilling_period.Loan_ID = $loan_id[Loan_ID]
    ORDER BY Created_at DESC";

    
    $result = mysqli_query($con, $s);
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction History</title>
    <link rel="stylesheet" href="../css/navbar.css">\
    <link rel="stylesheet" href="../css/transHistory.css">
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
                <li><a href="lender_Dashboard.php">Home</a></li>
                <li><a href="lender_ViewOffers.php">New Offers</a></li>
                <li><a href="#footer">Contact Us</a></li>
                <li><a href="AboutUsPage(Lenders).php">About Us</a></li>
                <li><a href="FAQsPage(Lenders).php">FAQs</a></li>
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
    

    <div class="main-container">
        <h1 class="page_header">Payment History</h1>

        <?php
       
            if (mysqli_num_rows($result) > 0) {
        ?>

        <table id="table">
            <tr>
                <th>Payment ID</th>
                <th>Amount Paid</th>
                <th>Screenshot</th>
                <th>Payment Channel</th>
                <th>Status</th>
                <th>Timestamp</th>
                <th>Action</th>
            </tr>

            <?php
                while($row = mysqli_fetch_array($result)) {
            ?>

            <tr>
                <td><?php echo $row['Payment_ID'];?></td>
                <td><?php echo number_format($row['Amount_Paid'], 2, '.', ',');?></td>
                <td>
                    <?php
                        $imageData = $row['Screenshot'];
                        $imageBase64 = base64_encode($imageData);
                        $imageType = "image/jpeg";

                        if ($imageData) {
                            echo '<img src="data:' . $imageType . ';base64,' . $imageBase64 . '" alt="Screenshot">';
                        } else {
                            echo 'No image available';
                        }
                    ?>
                </td>
                <td><?php echo $row['Payment_Channel'];?></td>
                <td><?php echo $row['Status'];?></td>
                <td><?php echo $row['Created_at'];?></td>
                <td class="approveButtons">
                <?php if ($row['Status'] == 'Pending'): ?>
                    <form action="generate_NextBillingPeriod.php" method="post">
                                <input type="hidden" name="Payment_ID" value="<?php echo $row['Payment_ID']?>">
                                <input type="hidden" name="BillingPeriod_id" value="<?php echo $LBPeriod_id?>">
                                <input type="hidden" name="status" value="<?php echo $row['Status']?>">
                                <input type="hidden" name="loanDetails" value="<?php echo htmlspecialchars($jsonloanDetails); ?>">
                                <input type="hidden" name="userDetails" value="<?php echo htmlspecialchars($jsonUserDetails); ?>">

                        <button type="submit" name="status" value="Failed" onclick="return confirm('Confirm you have not received the money?')" id="updatePayBtn">
                            <i id="failButton" class="fa-solid fa-circle-xmark"></i>
                        </button> 
                        <button type="submit" name="status" value="Success" onclick="return confirm('Confirm you have received the money?')" id="updatePayBtn">
                            <i id="successButton" class="fa-solid fa-circle-check"></i>
                        </button>
                    </form>
                <?php elseif ($row['Status'] == 'Success'): ?>
                    <i class="fa-solid fa-check" id="approved"></i></i>
                <?php elseif ($row['Status'] == 'Failed'): ?>
                    <i class="fa-solid fa-xmark" id="denied"></i>
                <?php endif; ?>
            </td>

            </tr>

            <?php
                }
            ?>
        </table>

        <?php
            } else {
                echo '<p>No payment details found.</p>';
            }
        ?>
    </div>

    <?php
        include '../html/footer.html';
    ?>

    <script src="https://kit.fontawesome.com/e140ca9b66.js" crossorigin="anonymous"></script>       
    
</body>
</html>

