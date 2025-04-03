<?php
include('config.php');
if(isset($_POST['loginVerificationBtn'])){
    $useremail = $_POST['flduseremail'];
    $userotpcode = $_POST['flduserotpcode'];
    $verifyotpcode = $_SESSION['fldverifyotpcode'];
  
    if($verifyotpcode ==  $userotpcode){
        $stmt = $conn->prepare("SELECT flduserid,flduserfullname,flduseremail,flduserpassword FROM users WHERE flduseremail = ? LIMIT 1");
        $stmt->bind_param('s',$useremail);
        if($stmt->execute()){
            $stmt->bind_result($userid,$userfullname,$useremail,$userpassword);
            $stmt->store_result();
            //If user is found in database
            if($stmt->num_rows() == 1){
                $stmt->fetch();
                //Set Users Session
                $_SESSION['flduserid'] = $userid;
                $_SESSION['flduserfullname'] = $userfullname;
                $_SESSION['flduseremail'] = $useremail;
                $_SESSION['logged_in'] = true;

                // Send Email To User
                $to = $useremail;
                $subject = "Successful Login";
                $message = "Hello $userfullname,\n\nYou have successfully logged in to your account.\n\nBest regards,\nHealthcare Friends Team";
                $headers = "From: info@fcsholdix.co.za";
                
                if(mail($to, $subject, $message, $headers)){
                    // Email sent successfully. Go To Account Page.
                    unset($_SESSION['fldverifyotpcode']);
                    header('location: ../dashboard.php?success=Logged In Successfully');
                    exit;
                } else {
                    // Email sending failed
                    unset($_SESSION['fldverifyotpcode']);
                    header('location: ../dashboard.php?error=Failed To Send Login Email To '.$useremail);
                    exit;
                }
            } else {
                // Email Not Found
                header('location: ../loginverification.php?error=Email Not Found!&flduseremail='.$useremail);
                exit;
            }
        } else{
            header('location: ../loginverification.php?error=Could Not Login At The Moment!&flduseremail='.$useremail);
            exit;
        }
    } else{//OTP Code is Wrong
        header('location: ../loginverification.php?error=OTP Code Is Incorrect!&flduseremail='.$useremail);
        exit;
    }
}