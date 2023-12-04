<?php
    session_start();

    $con = mysqli_connect('localhost', 'root', 'Furina de Fontaine');  //Change according to your settings
    mysqli_select_db($con, 'loanapp');

    // $sort = "ASC";
    $s = " SELECT * FROM lender ";
    $result = mysqli_query($con, $s); 
    
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to LoanDaddy</title>
    <link rel="stylesheet" href="../css/hamburgerstyle.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/slideshow.css">
    <link rel="stylesheet" href="../css/searchBar.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;400&display=swap" rel="stylesheet">
</head>
<body>
    <label class="hamburger_menu">
        <input type="checkbox">
    </label>


    <nav>
        <div class="navbar">
            <div class="logo">
                <a href="#"><img src="../images/ldaddy.png" class="logo"></a>
            </div>
            <ul class="menu">
                <li><a href="#">Home</a></li>
                <li><a href="#PetServices">Join our Team</a></li>
                <li><a href="About Us/About Us.html">Contact Us</a></li>
                <li><a href="#footer">About Us</a></li>
                <li><a href="#footer">FAQs</a></li>
                <li><a href="#footer">Login</a></li>
            </ul>
        </div>

    </nav>

    <div class="slideshow-container">
        <div class = "dot-container">
            <span class="dot" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
            <span class="dot" onclick="currentSlide(3)"></span>
        </div>
        <div class="mySlides fade">
            <img src="../images/slideshow1.png" style="width:100%">
        </div>
        <div class="mySlides fade">
            <img src="../images/slideshow2.png" style="width:100%">
        </div>
        <div class="mySlides fade">
            <img src="../images/slideshow3.png" style="width:100%">
        </div>

        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
        
    </div>

    <div class= "SearchView">
        <p class="adv_label">Advanced Search</p>
        <form>

            <label for="amt_borrowed">Amount Borrowed</label>
            <input type="number" name="amt_borrowed" id="amt_borrowed" value="200000"><br>
            <label for="interest">Interest Rate (per month)</label>
            <input type="number" name="interest" id="interest"><br>
            <label for="tenure">Tenure:</label>
            <select name="tenure" id="tenure">
                <option value="1 Month">1 Month</option>
                <option value="3 Months">3 Months</option>
                <option value="6 Months">6 Months</option>
                <option value="1 Year" selected>1 Year</option>
                <option value="2 Years">2 Years</option>
            </select> 
            <label for="pay_sched">Payment Schedule:</label>
            <select name="pay_sched" id="pay_sched">
                <option value="Weekly">Weekly</option>
                <option value="Semi-Monthly">Semi-Monthly</option>
                <option value="Monthly" selected>Monthly</option>
                <option value="Quarterly">Quarterly</option>
            </select> <br>
            <div class="button-container">
                <input type="submit" value="Submit"> 
            </div>
        </form>
    </div>

    <script src="../js/slideshow.js"></script>
</body>
</html>