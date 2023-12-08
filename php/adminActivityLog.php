<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Activity Log</title>
        <link rel="stylesheet" href="../css/navbar.css">
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
                    <a href="../php/index.php"><img src="../images/ldaddy.png" class="logo"></a>
                </div>
                <div class="navbar-center">
                    <h1>ACTIVITY LOG</h1>
                </div>
                <ul class="menu">
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
                <tbody>
                    <tr>
                        <td>001</td>
                        <td>John Doe</td>
                        <td>ABC Lender</td>
                        <td>Php 5000</td>
                        <td>2023-11-28</td>
                    </tr>
                    <tr>
                        <td>002</td>
                        <td>Jane Smith</td>
                        <td>XYZ Bank</td>
                        <td>Php 8000</td>
                        <td>2023-11-27</td>
                    </tr>
                </tbody>
            </table>
        </div>
        
    </body>
</html>