<?php
    

    session_start();
    
    if ($_SESSION['SESSIONID_VALUE'] != session_id()){
        header('location: index.php');
    }


    $con = mysqli_connect('localhost', 'root', 'Furina de Fontaine');  //Change according to your settings
    mysqli_select_db($con, 'loanapp');

    $s = "SELECT Lender_ID, Lender_Name, Description, Contact_Number,
    Email, MinSalary_Required, MinLoan_Amt, MaxLoan_Amt
    FROM lender 
    WHERE Verified_at IS NULL";

    $result = mysqli_query($con, $s);
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction History</title>
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/adminActivityLog.css">
    <link rel="stylesheet" href="../css/transHistory.css">
    <link rel="stylesheet" href="../css/adminTable.css">
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
                    <a href="admindashboard.php"><img src="../images/ldaddy.png" class="logo"></a>
                </div>
                <div class="navbar-center">
                    <h1>ADMIN DASHBOARD</h1>
                </div>
                <ul class="menu">
                <a class="adminLogout" id="dp-option" href="logout.php" onclick="return confirm('Are you sure you want to logout?')"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
                </ul>
                
            </div>
        </nav> 
    

    <div class="main-container">
        <h1 class="page_header">Lender Applicants</h1>

        <div class="success">
            <?php
                $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

                if(strpos($fullUrl, "update=success") == true) {
                    echo '<p id="updateSuccessMsg">Successfully Verified Lender</p>';
                }

                if(strpos($fullUrl, "deny=success") == true) {
                    echo '<p id="denySuccessMsg">Successfully Denied Lender</p>';
                }
            ?>
        </div>




        <?php
       
            if (mysqli_num_rows($result) > 0) {
        ?>

        <table id="table">
            <tr>
                <th>Lender ID</th>
                <th>Lender Name</th>
                <th>Description</th>
                <th>Contact Number</th>
                <th>Email</th>
                <th>MinSalary_Required</th>
                <th>MinLoan_Amt</th>
                <th>MaxLoan_Amt</th>
                <th>Action</th>
                
            </tr>

            <?php
                while($row = mysqli_fetch_array($result)) {
            ?>

            <tr>
                <td><?php echo $row['Lender_ID'];?></td>
                <td><?php echo $row['Lender_Name'];?></td>
                <td><?php echo $row['Description'];?></td>
                <td><?php echo $row['Contact_Number'];?></td>
                <td><?php echo $row['Email'];?></td>
                <td><?php echo $row['MinSalary_Required'];?></td>
                <td><?php echo $row['MinLoan_Amt'];?></td>
                <td><?php echo $row['MaxLoan_Amt'];?></td>
                
                

                <td class="approveButtons">
                    <form action="lender_verification.php" method="post">
                    <input type="hidden" name="Lender_ID" value="<?php echo $row['Lender_ID']?>">

                        <button type="submit" name="status" value="0" onclick="return confirm('Confirm Denial of Lender?')" id="updatePayBtn">
                            <i id="failButton" class="fa-solid fa-circle-xmark"></i>
                        </button> 
                        <button type="submit" name="status" value="1" onclick="return confirm('Confirm Approval of Lender?')" id="updatePayBtn">
                            <i id="successButton" class="fa-solid fa-circle-check"></i>
                        </button>
                    </form>
                </td>

            </tr>

            <?php
                }
            ?>
        </table>

        <?php
            } else {
        ?>
                <div class="noResults">
                    <i class="fa-solid fa-kiwi-bird" id="kiwi"></i></i>
                    <p class="noText"></p>-No Lender Found-</p>
                </div>

        <?php

                
            }
        ?>
    </div>

   

    <script src="https://kit.fontawesome.com/e140ca9b66.js" crossorigin="anonymous"></script>       

</body>
</html>