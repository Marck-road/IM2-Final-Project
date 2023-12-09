<?php
    

    session_start();
    
    if ($_SESSION['SESSIONID_VALUE'] != session_id()){
        header('location: index.php');
    }


$con = mysqli_connect('localhost', 'root', 'Furina de Fontaine');  //Change according to your settings
    
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_select_db($con, 'loanapp');
    $retVal = "";
    $isValid = true;
    $status = 400; 

$Lender_Name = $_POST['companyName'];
$email = $_POST['email'];
$password = $_POST['password'];
$confPassword = $_POST['confPassword'];
$contactNum = $_POST['contactNum'];
$desc = $_POST['desc'];
$minSalary = $_POST['minSalary'];
$minLoan = $_POST['minLoan'];
$maxLoan = $_POST['maxLoan'];


$tenure = [];
$interest = [];
$paysched = [];



for ($i = 1; $i <= 4; $i++) {
    $key = 'Tenure' . $i;
    $irKey = 'inputT' . $i;
    if(isset($_POST[$key])){
        $tenure[$i] = $i;
        $interest[$i] = $_POST[$irKey]/100;
    } else{
        $tenure[$i] = null;
        $interest[$i] = null;
    }
}

for ($i = 1; $i <= 4; $i++) {
    $schedkey = 'paysched' . $i;
    if(isset($_POST[$schedkey])){
        $paysched[$i] =  $i;
    } else{
        $paysched[$i] = null;
    }
}

if($isValid && ($password != $confPassword) ){
    $isValid = false;
    header("location:applyLender.php?pass=error");
    exit();
}

if ($isValid && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $isValid = false;
    $echo = "Invalid email.";
    header("location:applyLender.php?email=error");
    exit();
}

//Checks if any email duplications
$s = " select * from lender where Email = '$email'"; //select query

$result = mysqli_query($con, $s);
$num = mysqli_num_rows($result);

if($num == 1){
    $isValid = false;
    $echo = "User already exists.";
    header("location:applyLender.php?duplicate=error");
} 

$s = " select * from lender where Lender_Name = '$Lender_Name'"; //select query

$result = mysqli_query($con, $s);
$num = mysqli_num_rows($result);

if($num == 1){
    $isValid = false;
    $echo = "User already exists.";
    header("location:applyLender.php?duplicate=error");
} 


if($isValid){   
        $hashed_password = md5($password);
        $reg= " INSERT INTO lender (Lender_Name, Email, Password, Description, Contact_Number, MinSalary_Required, MinLoan_Amt, MaxLoan_Amt) 
        VALUES ('$Lender_Name', '$email', '$hashed_password', '$desc', '$contactNum', '$minSalary', '$minLoan', '$maxLoan')";
        mysqli_query($con, $reg);

        $s = "SELECT Lender_ID FROM lender WHERE Lender_Name = '$Lender_Name'";
        $lender_query = mysqli_query($con, $s);
        $thisLender =  mysqli_fetch_array($lender_query);
        $lender_id = $thisLender["Lender_ID"];

        for ($i = 1; $i <= 5; $i++) {
            if ($tenure[$i] != NULL && $interest[$i]!=NULL) {
               $insertQuery = "INSERT INTO lender_interest_rates (Tenure_ID, Interest_Rate, Lender_ID) 
                                VALUES ('$tenure[$i]', '$interest[$i]', '$lender_id')";
                
                mysqli_query($con, $insertQuery);
            
            }

        }

        for ($i = 1; $i <= 4; $i++) {
            if ($paysched[$i] != NULL) {
               $insertQuery = "INSERT INTO lender_payment_scheds (Schedule_ID, Lender_ID) 
                                VALUES ('$paysched[$i]', '$lender_id')";
                
                mysqli_query($con, $insertQuery);
            }
        }
        


        header('location:applyLender.php?success=register');
    }
?>