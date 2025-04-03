<?php
include('config.php');
if(isset($_POST['loginBtn'])){
  $useremail = $_POST['flduseremail'];
  $userpassword = md5($_POST['flduserpassword']);
  // Generate A Random 6-digit OTP Code
  $otpcode = $_SESSION['fldverifyotpcode'] = rand(100000, 999999);

  $stmt = $conn->prepare("SELECT flduserfullname, flduseremail FROM users WHERE flduseremail = ? AND flduserpassword = ? LIMIT 1");
  $stmt->bind_param('ss',$useremail,$userpassword);
  if($stmt->execute()){
    $stmt->bind_result($userfullname, $useremail);
    $stmt->store_result();
    //If user is found in database
    if($stmt->num_rows() == 1){
      $stmt->fetch();

      // Send Email To User
      $to = $useremail;
      $subject = "Login OTP Code";
      $message = "Hello $userfullname,\n\nHere is your Login OTP Code: $otpcode. \n\nBest regards,\nHealthcare Friends Team";
      $headers = "From: info@fcsholdix.co.za";
      
      if(mail($to, $subject, $message, $headers)){
        // Email sent successfully. Go To Email Verification Page
        header('location: loginverification.php?success=Email Has Been Sent With The OTP Code. Please Enter The OTP Code Before It Expires.&flduseremail='.$useremail);
        exit;
      } else {
        // Email sending failed
        header('location: ../login.php?error=Failed To Send Email Verification To '.$useremail);
        exit;
      }
    }
    else{//Password or Email is Wrong Or not in Database
      //Go To Login Page
      header('location: ../login.php?error=Could Not Verify Your Account!');
      exit;
    }
  }
  else{
    header('location: ../login.php?error=Could Not Login At The Moment');
    exit;
  }
}