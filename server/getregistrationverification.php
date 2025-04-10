<?php
include('connection.php');
if(isset($_POST['registrationVerificationBtn'])){
    // Rate Limiting
    if (!isset($_SESSION['login_attempts'])) {
        $_SESSION['login_attempts'] = 0;
        $_SESSION['last_login_attempt'] = time();
    }

    if ($_SESSION['login_attempts'] > 5 && 
        (time() - $_SESSION['last_login_attempt']) < 300) {
        unset($_SESSION['fldverifyotpcode']);
        header('location: ../registration.php?error=Too Many Attempts');
        exit;
    }

    $_SESSION['login_attempts']++;
    $_SESSION['last_login_attempt'] = time();

    $userimage = $_POST['flduserimage'];
    $userfirstname = $_POST['flduserfirstname'];
    $userlastname = $_POST['flduserlastname'];
    $userstreetaddress = $_POST['flduserstreetaddress'];
    $userlocalarea = $_POST['flduserlocalarea'];
    $usercity = $_POST['fldusercity'];
    $userzone = $_POST['flduserzone'];
    $usercountry = $_POST['fldusercountry'];
    $userpostalcode = $_POST['flduserpostalcode'];
    
    $useremail = filter_var($_POST['flduseremail'], FILTER_SANITIZE_EMAIL);
    if (!filter_var($useremail, FILTER_VALIDATE_EMAIL)) {
        header('location: ../registration.php?error=Invalid Email Format');
        exit;
    }
    
    $userphonenumber = $_POST['flduserphonenumber'];
    $userpassword = $_POST['flduserpassword'];
    
    // Encrypt OTP using SHA256
    $userotpcode = $_POST['flduserotpcode'];
    $userotpcode = hash('sha256', $userotpcode);
    
    $verifyotpcode = $_SESSION['fldverifyotpcode'];
  
    if($verifyotpcode ==  $userotpcode){
        //check whether there is a user with this email or not
        $stmt = $conn->prepare("SELECT count(*) FROM users WHERE flduseremail=?");
        $stmt->bind_param('s',$useremail);
        if($stmt->execute()){
            $stmt->bind_result($num_rows);
            $stmt->store_result();
            $stmt->fetch();
        }
        else{
            header('location: ../registrationverification.php?error=Something Went Wrong, Try Again!!&flduserfirstname='.$userfirstname.'&flduserlastname='.$userlastname.'&fldusercountry='.$usercountry.'&flduserzone='.$userzone.'&fldusercity='.$usercity.'&flduserlocalarea='.$userlocalarea.'&flduserstreetaddress='.$userstreetaddress.'&flduserpostalcode='.$userpostalcode.'&flduseremail='.$useremail.'&flduserphonenumber='.$userphonenumber.'&flduserpassword='.$userpassword);
            exit;
        }

        //if there is a user already registered with this email
        if($num_rows != 0){
            header('location: ../registrationverification.php?error=User With This Email Already Exists. Go to Login.&flduserfirstname='.$userfirstname.'&flduserlastname='.$userlastname.'&fldusercountry='.$usercountry.'&flduserzone='.$userzone.'&fldusercity='.$usercity.'&flduserlocalarea='.$userlocalarea.'&flduserstreetaddress='.$userstreetaddress.'&flduserpostalcode='.$userpostalcode.'&flduseremail='.$useremail.'&flduserphonenumber='.$userphonenumber.'&flduserpassword='.$userpassword);
            exit;
        }
        else{//if no user registered with this email before
            //Create New User
            $stmt1 = $conn->prepare("INSERT INTO users (flduserimage,flduserfirstname,flduserlastname,flduserstreetaddress,flduserlocalarea,fldusercity,flduserzone,fldusercountry,flduserpostalcode,flduseremail,flduserphonenumber,flduserpassword)
                    VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");
            $stmt1->bind_param('ssssssssssss',$userimage,$userfirstname,$userlastname,$userstreetaddress,$userlocalarea,$usercity,$userzone,$usercountry,$userpostalcode,$useremail,$userphonenumber,$userpassword);
            //if user details was added succesfully
            if($stmt1->execute()){
                $userid = $stmt1->insert_id;
                $orderid = $userid*-1;
            }
            else{//user could not be added
                header('location: ../registrationverification.php?error=Could Not Create An Account At The Moment&flduserfirstname='.$userfirstname.'&flduserlastname='.$userlastname.'&fldusercountry='.$usercountry.'&flduserzone='.$userzone.'&fldusercity='.$usercity.'&flduserlocalarea='.$userlocalarea.'&flduserstreetaddress='.$userstreetaddress.'&flduserpostalcode='.$userpostalcode.'&flduseremail='.$useremail.'&flduserphonenumber='.$userphonenumber.'&flduserpassword='.$userpassword);
                exit;
            }

            //Create New Customer Billing Address
            $stmt2 = $conn->prepare("INSERT INTO customerbillingaddress (fldbillingid,fldorderid,fldbillingfirstname,fldbillinglastname,fldbillingstreetaddress,fldbillinglocalarea,fldbillingcity,fldbillingzone,fldbillingcountry,fldbillingpostalcode,fldbillingemail,fldbillingphonenumber)
                    VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");
            $stmt2->bind_param('iissssssssss',$userid,$orderid,$userfirstname,$userlastname,$userstreetaddress,$userlocalarea,$usercity,$userzone,$usercountry,$userpostalcode,$useremail,$userphonenumber);
            //if billing details was added succesfully
            if($stmt2->execute()){
                $stmt3 = $conn->prepare("SELECT flduserid,flduserimage,flduserfirstname,flduserlastname,flduserstreetaddress,flduserlocalarea,fldusercity,flduserzone,fldusercountry,flduserpostalcode,flduseremail,flduserphonenumber,flduserpassword FROM users WHERE flduseremail = ? LIMIT 1");
                $stmt3->bind_param('s',$useremail);
                if($stmt3->execute()){
                    $stmt3->bind_result($userid,$userimage,$userfirstname,$userlastname,$userstreetaddress,$userlocalarea,$usercity,$userzone,$usercountry,$userpostalcode,$useremail,$userphonenumber,$userpassword);
                    $stmt3->store_result();
                    //If user is found in database
                    if($stmt3->num_rows() == 1){
                        $stmt3->fetch();
                        // Initialize Rate Limit
                        $_SESSION['login_attempts'] = 0;
                        $_SESSION['last_login_attempt'] = time();
                        
                        //Set Users, Billing & Tesimonials/Suggestions Session
                        $_SESSION['flduserid'] = $_SESSION['fldbillingid'] = $userid;
                        $_SESSION['flduserimage'] = $_SESSION['fldtestimonialsimage'] = $userimage;
                        $_SESSION['flduserfirstname'] = $_SESSION['fldbillingfirstname'] = $_SESSION['fldtestimonialsfirstname'] = $userfirstname;
                        $_SESSION['flduserlastname'] = $_SESSION['fldbillinglastname'] = $_SESSION['fldtestimonialslastname'] = $userlastname;
                        $_SESSION['flduserstreetaddress'] = $_SESSION['fldbillingstreetaddress'] = $userstreetaddress;
                        $_SESSION['flduserlocalarea'] = $_SESSION['fldbillinglocalarea'] = $userlocalarea;
                        $_SESSION['fldusercity'] = $_SESSION['fldbillingcity'] = $usercity;
                        $_SESSION['flduserzone'] = $_SESSION['fldbillingzone'] = $userzone;
                        $_SESSION['fldusercountry'] = $_SESSION['fldbillingcountry'] = $_SESSION['fldtestimonialscountry'] = $usercountry;
                        $_SESSION['flduserpostalcode'] = $_SESSION['fldbillingpostalcode'] = $userpostalcode;
                        $_SESSION['flduseremail'] = $_SESSION['fldbillingemail'] = $_SESSION['fldtestimonialsemail'] = $useremail;
                        $_SESSION['flduserphonenumber'] = $_SESSION['fldbillingphonenumber'] = $userphonenumber;
                        $_SESSION['logged_in'] = true;

                        // Send Email To User
                        $to = $useremail;
                        $subject = "Successful Registration";
                        $message = "Hello $userfirstname,\n\nYou have successfully registered.\n\nBest regards,\nNewstuffSA Team";
                        // Additional headers for better email security
                        $headers = array(
                            'From: info@fcsholdix.co.za',
                            'X-Mailer: PHP/' . phpversion(),
                            'MIME-Version: 1.0',
                            'Content-Type: text/plain; charset=UTF-8'
                        );
                        $headers = implode("\r\n", $headers);
                        
                        if(mail($to, $subject, $message, $headers)){
                            // Email sent successfully. Go To Account Page.
                            unset($_SESSION['fldverifyotpcode']);
                            header('location: ../dashboard.php?success=You Registered Succesfully.');
                            exit;
                        } else {
                            // Email sending failed
                            unset($_SESSION['fldverifyotpcode']);
                            header('location: ../dashboard.php?error=You Registered Succesfully. Failed Sending Registration Email.');
                            exit;
                        }
                    } else {
                        // Email Not Found
                        header('location: ../registrationverification.php?error=Email Not Found!&flduserfirstname='.$userfirstname.'&flduserlastname='.$userlastname.'&fldusercountry='.$usercountry.'&flduserzone='.$userzone.'&fldusercity='.$usercity.'&flduserlocalarea='.$userlocalarea.'&flduserstreetaddress='.$userstreetaddress.'&flduserpostalcode='.$userpostalcode.'&flduseremail='.$useremail.'&flduserphonenumber='.$userphonenumber.'&flduserpassword='.$userpassword);
                        exit;
                    }
                } else{
                    header('location: ../registrationverification.php?error=Something Went Wrong, Try Again!!&flduserfirstname='.$userfirstname.'&flduserlastname='.$userlastname.'&fldusercountry='.$usercountry.'&flduserzone='.$userzone.'&fldusercity='.$usercity.'&flduserlocalarea='.$userlocalarea.'&flduserstreetaddress='.$userstreetaddress.'&flduserpostalcode='.$userpostalcode.'&flduseremail='.$useremail.'&flduserphonenumber='.$userphonenumber.'&flduserpassword='.$userpassword);
                    exit;
                }
            } else{//billing details could not be added
                header('location: ../registrationverification.php?error=Could Not Create An Account At The Moment&flduserfirstname='.$userfirstname.'&flduserlastname='.$userlastname.'&fldusercountry='.$usercountry.'&flduserzone='.$userzone.'&fldusercity='.$usercity.'&flduserlocalarea='.$userlocalarea.'&flduserstreetaddress='.$userstreetaddress.'&flduserpostalcode='.$userpostalcode.'&flduseremail='.$useremail.'&flduserphonenumber='.$userphonenumber.'&flduserpassword='.$userpassword);
                exit;
            }
        }
    } else{
        header('location: ../registrationverification.php?error=OTP Code Is Incorrect!&flduserfirstname='.$userfirstname.'&flduserlastname='.$userlastname.'&fldusercountry='.$usercountry.'&flduserzone='.$userzone.'&fldusercity='.$usercity.'&flduserlocalarea='.$userlocalarea.'&flduserstreetaddress='.$userstreetaddress.'&flduserpostalcode='.$userpostalcode.'&flduseremail='.$useremail.'&flduserphonenumber='.$userphonenumber.'&flduserpassword='.$userpassword);
        exit;
    }
}