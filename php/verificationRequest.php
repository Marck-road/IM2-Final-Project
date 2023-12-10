<?php
    

    session_start();
    
    if ($_SESSION['SESSIONID_VALUE'] != session_id()){
        header('location: index.php');
    }

    $con = mysqli_connect('localhost', 'root', 'Furina de Fontaine');  //Change according to your settings
    mysqli_select_db($con, 'loanapp');

    $search = isset($_GET['search']) ? $_GET['search'] : '';
    $sql = "SELECT * FROM user 
    WHERE CONCAT(First_Name, ' ', Last_Name) LIKE '%$search%'
    AND Account_Status = 'Pending'";
    $result = $con->query($sql);

    $result = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Verification Requests</title>
        <link rel="stylesheet" href="../css/loginpage.css">
        <link rel="stylesheet" href="../css/navbar.css">
        <link rel="stylesheet" href="../css/userAccounts.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-..."
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                    <h1>ADMIN DASHBOARD</h1>
                </div>
                <ul class="menu">
                <a class="adminLogout" id="dp-option" href="logout.php" onclick="return confirm('Are you sure you want to logout?')"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
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
                <th>Income Document</th>
                <th>Valid ID 1</th>
                <th>Valid ID 2</th>
                <th>Utility Bill</th>
                <th>Action</th>
                
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
                <td>
                <?php
                    $imageData = $row['Income_Document'];
                    $imageBase64 = base64_encode($imageData);
                    $imageType = "image/jpeg";

                    if ($imageData) {
                        echo '<img src="data:' . $imageType . ';base64,' . $imageBase64 . '" alt="Screenshot">';
                    } else {
                        echo 'No image available';
                    }
                ?>
                </td>
                <td>
                <?php
                    $imageData = $row['ValidID_1'];
                    $imageBase64 = base64_encode($imageData);
                    $imageType = "image/jpeg";

                    if ($imageData) {
                        echo '<img src="data:' . $imageType . ';base64,' . $imageBase64 . '" alt="Screenshot">';
                    } else {
                        echo 'No image available';
                    }
                ?>
                </td>
                <td>
                <?php
                    $imageData = $row['ValidID_2'];
                    $imageBase64 = base64_encode($imageData);
                    $imageType = "image/jpeg";

                    if ($imageData) {
                        echo '<img src="data:' . $imageType . ';base64,' . $imageBase64 . '" alt="Screenshot">';
                    } else {
                        echo 'No image available';
                    }
                ?>
                </td>
                <td>
                <?php
                    $imageData = $row['Utility_Bill'];
                    $imageBase64 = base64_encode($imageData);
                    $imageType = "image/jpeg";

                    if ($imageData) {
                        echo '<img src="data:' . $imageType . ';base64,' . $imageBase64 . '" alt="Screenshot">';
                    } else {
                        echo 'No image available';
                    }
                ?>
                </td>



                <td class="approveButtons">
                    <form action="verifyAccount.php" method="post">
                    <input type="hidden" name="User_ID" value="<?php echo $row['User_ID']?>">

                        <button type="submit" name="status" value="0" onclick="return confirm('Deny Verification of User?')" id="updatePayBtn">
                            <i id="failButton" class="fa-solid fa-circle-xmark"></i>
                        </button> 
                        <button type="submit" name="status" value="1" onclick="return confirm('Approve Verification of User?')" id="updatePayBtn">
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

<script src="https://kit.fontawesome.com/e140ca9b66.js" crossorigin="anonymous"></script> 
      
    </table>
</html>
