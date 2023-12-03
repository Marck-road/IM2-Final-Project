<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hamburger Menu</title>
    <link rel="stylesheet" href="../css/hamburgerstyle.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;400&display=swap" rel="stylesheet">
</head>
<body>
    <label class="hamburger_menu">
        <input type="checkbox">
    </label>

    <aside class="sidebar">
        <nav>
            <div>Home</div>
            <div>Menu 1</div>
            <div>Menu 2</div>
            <div>Logout</div>
        </nav>

        
    </aside>

    <nav>
        <div class="navbar">
            <div class="logo"><a href="#"><img src="../images/Logo.png" class="logo"></a></div>
                <ul class="menu">
                    <li><a href="#">Home</a></li>
                    <li><a href="#PetServices">Join our Team</a></li>
                    <li><a href="About Us/About Us.html">Contact Us</a></li>
                    <li><a href="#footer">About Us</a></li>
                    <li><a href="#footer">FAQs</a></li>
                    <li><a href="#footer">Login</a></li>
                    
                    <div class="dropdown"> 
                        <div class="dropbtn">
                            <li id="accnav"><a><i class="fa-solid fa-circle-user"></i></a></li>
                        </div>
                    
                    <div class="dropdown-content">
                        <a href ="editaccount/editaccount.html"> Edit Account <i class="fa-solid fa-user-pen"></i></a>
                        <a href ="logout.php"> Logout <i class="fa-solid fa-right-from-bracket"></i></a>
                    </div>
                    </div>
                </ul>
        </div>

    </nav>
</body>
</html>