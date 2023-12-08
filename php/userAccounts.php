<?php
    session_start();

    $con = mysqli_connect('localhost', 'root', 'Furina de Fontaine');  //Change according to your settings
    mysqli_select_db($con, 'loanapp');

    $search = isset($_GET['search']) ? $_GET['search'] : '';
    $sql = "SELECT User_ID, First_Name, Last_Name, Email, Contact_Number, Employment_Status, Created_at FROM user WHERE CONCAT(First_Name, ' ', Last_Name) LIKE '%$search%'";
    $result = $con->query($sql);

    $result = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Accounts</title>
        <link rel="stylesheet" href="../css/navbar.css">
        <link rel="stylesheet" href="../css/userAccounts.css">
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
                    <a href="admindashboard.php"><img src="../images/ldaddy.png" class="logo"></a>
                </div>
                <div class="navbar-center">
                    <h1>USER ACCOUNTS</h1>
                </div>
                <ul class="menu">
                </ul>
            </div>
        </nav>
        
        <div class="search-user">
            <form method="GET">
                <input type="text" class="search-input" name="search" placeholder="Search User">
                <button type="submit" class="search-btn"><i class="fas fa-search"></i></button>
            </form>
        </div>

        <?php
        
        if (mysqli_num_rows($result) > 0) {
        ?>
                <table id="table">
            <tr>
                <th>User ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Contact Number</th>
                <th>Employment Status</th>
                <th>Created at</th>
                
            </tr>

            <?php
                while($row = mysqli_fetch_array($result)) {
            ?>

            <tr>
                <td><?php echo $row["User_ID"];?></td>
                <td><?php echo $row["First_Name"];?></td>
                <td><?php echo $row["Last_Name"];?></td>
                <td><?php echo $row["Email"];?></td>
                <td><?php echo $row['Contact_Number'];?></td>
                <td><?php echo $row['Employment_Status'];?></td>
                <td><?php echo $row["Created_at"];?></td>
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
                    <p class="noText"></p>-No User Found-</p>
                </div>

        <?php
            }
        ?>


      
    </table>
</html>
