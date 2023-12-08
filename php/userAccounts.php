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
                    <a href="../php/index.php"><img src="../images/ldaddy.png" class="logo"></a>
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

    <table>
        <thead>
            <tr>
                <th>User ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Created at</th>
            </tr>
        </thead>
        <tbody>
            
            <?php
                $conn = mysqli_connect('localhost', 'root', '');
                mysqli_select_db($conn, 'loanapp');

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $search = isset($_GET['search']) ? $_GET['search'] : '';
                $sql = "SELECT User_ID, First_Name, Last_Name, Email, Created_at FROM user WHERE CONCAT(First_Name, ' ', Last_Name) LIKE '%$search%'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["User_ID"]. "</td>";
                        echo "<td>" . $row["First_Name"]. "</td>";
                        echo "<td>" . $row["Last_Name"]. "</td>";
                        echo "<td>" . $row["Email"]. "</td>";
                        echo "<td>" . $row["Created_at"]. "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No results found for '$search'</td></tr>";
                }
                $conn->close();
            ?>
        </tbody>
    </table>
</html>
