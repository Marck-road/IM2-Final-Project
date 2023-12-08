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
            <input type="text" class="search-input" placeholder="Search User">
            <button class="search-btn"><i class="fas fa-search"></i></button>
        </div>

        <div class="user-table">
            <table>
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Created_At</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>001</td>
                        <td>John</td>
                        <td>Doe</td>
                        <td>Php 5000</td>
                        <td>2023-11-28</td>
                    </tr>
                    <tr>
                        <td>002</td>
                        <td>Jane</td>
                        <td>Smith</td>
                        <td>Php 8000</td>
                        <td>2023-11-27</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </body>
</html>