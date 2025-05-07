<?php
include('connection.php');
if(isset($_POST['resetPasswordVerificationBtn'])){
    // When creating/updating password
    $userpassword = $_POST['flduserpassword'];
    $userconfirmpassword = $_POST['flduserconfirmpassword'];

    // Encrypt OTP using SHA256
    $userotpcode = $_POST['flduserotpcode'];
    $userotpcode = hash('sha256', $userotpcode);
    
    $verifyotpcode = $_SESSION['fldverifyotpcode'];

    if($verifyotpcode ==  $userotpcode){
        //1. if password dont match
        if($userpassword !== $userconfirmpassword){
            header('location: ../resetpasswordverification.php?error=Passwords Do Not Match&flduseremail='.$useremail);
            exit;
        }
        else if(strlen($userpassword) < 8)
        {//2. if password is less than 8 characters
            header('location: ../resetpasswordverification.php?error=Password Must Be Atleast 8 Characters&flduseremail='.$useremail);
            exit;
        }
        else{//3. no errors
            // Use PHP's built-in password hashing function
            $userpassword = password_hash($userpassword, PASSWORD_DEFAULT);
            
            //3.1 check whether there is a user with this email or not
            $stmt = $conn->prepare("SELECT flduserid, flduserfirstname FROM users WHERE flduseremail = ? LIMIT 1");
            $stmt->bind_param('s',$useremail);
            if($stmt->execute()){
                $stmt->bind_result($userid, $userfirstname);
                $stmt->store_result();
            }
            else{
                $stmt->close();
                header('../resetpasswordverification.php?error=Something Went Wrong!! Contact Support Team.&flduseremail='.$useremail);
                exit;
            }

            //3.1.1 if there is a user already registered with this email
            if($stmt->num_rows() == 1){
                $stmt->fetch();
                $stmt->close();
                
                $stmt1 = $conn->prepare("UPDATE users SET flduserpassword=? WHERE flduseremail=?");
                $stmt1->bind_param('ss',$userpassword,$useremail);
                if($stmt1->execute()){
                    // Initialize Rate Limit
                    $_SESSION['login_attempts'] = 0;
                    $_SESSION['last_login_attempt'] = time();

                } else{
                    header('location: ../resetpasswordverification.php?error=Something Went Wrong!! Contact Support Team.&flduseremail='.$useremail);
                    exit;
                }
            }
            else{//3.1.2 if no user registered with this email before
                header('location: ../resetpasswordverification.php?error=Email Not Found!&flduseremail='.$useremail);
                exit;
            }
        }
    } else{
        header('location: ../resetpasswordverification.php?error=OTP Code Is Incorrect!&flduseremail='.$useremail);
        exit;
    }
}