<?php

session_start();


$con = mysqli_connect('localhost', 'root', 'Furina de Fontaine');  //Change according to your settings
    
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

mysqli_select_db($con, 'loanapp');
    $retVal = "";
    $isValid = true;
    $status = 400; 

$email= $_POST['email'];  
$pass = $_POST['password']; 
$final_hashed = md5($pass);
$userType;

$s = " select * from admin where username = '$email' && password = '$final_hashed'"; //data will be used
    
$result = mysqli_query($con, $s); 
$num = mysqli_num_rows($result); 

if($num != 0){
    // if admin
    while($row = mysqli_fetch_array($result)){
        $_SESSION['SESSIONID_VALUE'] = session_id();
        $_SESSION['id'] = $row['username'];
    }
    if($num == 1){  
        // header('location:borrower_Dashboard.php');
    } else{
        header("location:../html/Loginpage.html?login=error");
    }
} else {
    $s = " select * from lender where Email = '$email' && Password = '$final_hashed'"; 
    
    $result = mysqli_query($con, $s); 
    $num = mysqli_num_rows($result); 
    if($num != 0){
        // if lender
        while($row = mysqli_fetch_array($result)){
            $_SESSION['SESSIONID_VALUE'] = session_id();
            $_SESSION['id'] = $row['Lender_ID'];
            $_SESSION['email'] = $row['Email'];
        }
        if($num == 1){  
            header('location:lender_Dashboard.php');
        } else{
            header("location:../html/Loginpage.html?login=error");
        }
    } else{
        // If normal User
        $s = " select * from user where Email = '$email' && Password = '$final_hashed'"; 
    
        $result = mysqli_query($con, $s); 
        $num = mysqli_num_rows($result); 

        
        if ($num != 0) {
            while($row = mysqli_fetch_array($result)){
                $_SESSION['SESSIONID_VALUE'] = session_id();
                $_SESSION['id'] = $row['User_ID'];
                $_SESSION['fname'] = $row['First_Name'];
                $_SESSION['mname'] = $row['Middle_Name'];
                $_SESSION['lname'] = $row['Last_Name'];
                $_SESSION['email'] = $row['Email'];
                $_SESSION['password'] = $row['Password'];
                $_SESSION['monthly_Income'] = $row['Monthly_Income'];
                $_SESSION['birthday'] = $row['Birthday'];
                $_SESSION['city'] = $row['City'];
                $_SESSION['province'] = $row['Province'];
                $_SESSION['zip_Code'] = $row['ZIP_Code'];
                $_SESSION['number'] = $row['Contact_Number'];
            }

            if($num == 1){  
                header('location:borrower_Dashboard.php');
    
            
            } else{
                header("location:../html/Loginpage.html?login=error");
            }
            

        }

        
    
        
    }
}

?>