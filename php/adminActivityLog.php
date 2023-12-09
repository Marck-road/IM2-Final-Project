<?php
    

    session_start();
    
    if ($_SESSION['SESSIONID_VALUE'] != session_id()){
        header('location: index.php');
    }

    $con = mysqli_connect('localhost', 'root', 'Furina de Fontaine');  //Change according to your settings
    mysqli_select_db($con, 'loanapp');

    $s = "SELECT *, loan.Status as loanStatus FROM loan INNER JOIN loan_application ON 
    loan.LoanApp_ID = loan_application.LoanApp_ID";

    $result = mysqli_query($con, $s);
?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Activity Log</title>
        <link rel="stylesheet" href="../css/navbar.css">
        <link rel="stylesheet" href="../css/adminTable.css">
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
                <a class="adminLogout" id="dp-option" href="logout.php" onclick="return confirm('Are you sure you want to logout?')"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
                </ul>
                
            </div>
        </nav>        

        <div class="advanced-search">
            <h2>Advanced Search</h2>
            <form action="#" method="GET">
                <label for="amount">Amount</label>
                <input type="text" id="amount" name="amount">

                <label for="user">User</label>
                <input type="text" id="user" name="user">

                <label for="loaner">Loaner</label>
                <input type="text" id="loaner" name="loaner">

                <label for="loan_id">Loan ID</label>
                <input type="text" id="loan_id" name="loan_id">

                <button type="submit">Search</button>
            </form>
        </div>

        <div class="loan-table">

        <?php
            if (mysqli_num_rows($result) > 0) {
        ?>
            
            <table>
                <thead>
                    <tr>
                        <th>Loan ID</th>
                        <th>User</th>
                        <th>Lender</th>
                        <th>Amount Payable</th>
                        <th>Created_At</th>
                    </tr>
                </thead>
                
                <?php
                    while($row = mysqli_fetch_array($result)) {
                ?>
                <tbody>


                    <tr>
                        <td><?php echo $row['Loan_ID'];?></td>
                        <td><?php echo $row['User_ID'];?></td>
                        <td><?php echo $row['Lender_ID'];?></td>
                        <td><?php echo $row['Loan_Amt'];?></td>
                        <td><?php echo $row['loanStatus'];?></td>
                    </tr>
                </tbody>
                <?php
                }
            ?>

            </table>

            <?php
            } else {
                ?>
                        <div class="noResults">
                            <i class="fa-solid fa-kiwi-bird" id="kiwi"></i></i>
                            <p class="noText"></p>-No Loans Found-</p>
                        </div>

                <?php

                        
                    }
                ?>
        </div>
        <script src="https://kit.fontawesome.com/e140ca9b66.js" crossorigin="anonymous"></script> 

    </body>
</html>