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

echo $final_hashed;

$s = " select * from admin where username = '$email' && password = '$final_hashed'"; //data will be used

$result = mysqli_query($con, $s); 
$num = mysqli_num_rows($result); 

while($row = mysqli_fetch_array($result)){
    $_SESSION['SESSIONID_VALUE'] = session_id(); 
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
    $_SESSION['employStatus'] = $row['Employment_Status'];
    $_SESSION['income_docx'] = $row['Income_Document'];
    $_SESSION['validID_1'] = $row['ValidID_1'];
    $_SESSION['validID_2'] = $row['ValidID_2'];
    $_SESSION['util_bill'] = $row['Utility_Bill'];
}

if($num == 1){  //checks if how many were retrieved
    header('location:borrower_Dashboard.php');
    // if($_SESSION['role'] == "User"){
    //     header('location:home.php');
    // }

    // else if($_SESSION['role'] == "Admin"){
    //     header('location:adminpanel/adminpanel.php');
    // }

}

else{
    header("location:../html/Loginpage.html?login=error");
}

?>