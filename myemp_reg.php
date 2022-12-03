<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/credential.php';

session_start();

/*************************************/
if(isset($_POST['register']))
{
  include("includes/db.include.php");
  
  $fullname = htmlentities(mysqli_real_escape_string($con, $_POST['user_fullname']));
  $company  = htmlentities(mysqli_real_escape_string($con, $_POST['user_company']));
  $username = htmlentities(mysqli_real_escape_string($con, $_POST['user_name']));
  $phone    = htmlentities(mysqli_real_escape_string($con, $_POST['user_phonenumber']));
  $email    = htmlentities(mysqli_real_escape_string($con, $_POST['user_email']));
  $location = htmlentities(mysqli_real_escape_string($con, $_POST['user_location']));
  $password = htmlentities(mysqli_real_escape_string($con, $_POST['user_password']));
  $confirm  = htmlentities(mysqli_real_escape_string($con, $_POST['confirm_pass']));
  $rand     = rand(1, 2);
 
  /*check for empty field*/
  if(empty($fullname) || empty($company) || empty($username) || empty($phone) || 
  empty($email) || empty($location) || empty($password) || empty($confirm))
  {
    header("Location: myemp_reg.php?signup%empty");
    exit();
  }
  else
  {
    /*check if input characters are valid*/
    if (!preg_match("/^[a-z A-Z]*$/", $fullname))
    {
      header("Location: myemp_reg.php?signup%error");
      exit(); 
    }
    else 
    {
      /*check if email is valid*/
      if(!filter_var($email, FILTER_VALIDATE_EMAIL))
      {
        header("Location: myemp_reg.php?signup%error");
        exit(); 
      } 
      else
      {
        $sql = "SELECT * FROM employer WHERE user_company='$company' 
        OR user_name='$username' OR user_phonenumber='$phone' OR user_email='$email'";
        $result = mysqli_query($con, $sql);
        $resultCheck = mysqli_num_rows($result);

        if($resultCheck > 0)
        {
          header("Location: myemp_reg.php?signup%credentials%taken");
          exit();     
        }
        else 
        {
          if($rand == 1){
              $profile_pic = "photos/placeholder.jpg";
          }else if($rand == 2){
              $profile_pic = "photos/placeholder.jpg";
          }

          if($password === $confirm)
          {
            if(strlen($password) < 9)
            {
                header("Location: myemp_reg.php?signup%atleast%9%characters%password");
                exit();
            }
            else
            {
              //hashing the password
              $hashedPass = password_hash($password, PASSWORD_BCRYPT);

              // create a one time token 
              $token = uniqid(True);

              /*insert the user into the database*/
              $sqlquery = "INSERT INTO employer(user_fullname,user_company,user_name,
              user_phonenumber,user_email,user_location,acc_verify,token,user_pass,
              user_profile,date_created)
              VALUES('$fullname','$company','$username','$phone','$email','$location',
              '1','$token','$hashedPass','$profile_pic',now())";

              $verifyquery = mysqli_query($con, $sqlquery);

              // verify the user email
              if ($verifyquery) 
              {
                $mailTo = htmlentities(mysqli_real_escape_string($con, $_POST['user_email']));
                
                $mail   = new PHPMailer(true);
                try  
                {
                  //Server settings
                  $mail->isSMTP();                                            
                  $mail->Host       = 'smtp.gmail.com';  
                  $mail->SMTPAuth   = true;                                   
                  $mail->Username   = EMAIL;                     
                  $mail->Password   = PASS;                             
                  $mail->SMTPSecure = 'tls';                   
                  $mail->Port       = 587;                                    

                  //Recipients
                  $mail->setFrom(EMAIL, 'Job Site');
                  $mail->addAddress($mailTo);                   
                  $mail->addReplyTo('no-reply@gmail.com', 'No Reply');   

                  // Content
                  $url = "http://" . $_SERVER["HTTP_HOST"] . dirname($_SERVER["PHP_SELF"]) . "/includes/verify_emp.php?token=$token";

                  $mail->isHTML(true);                                  
                  $mail->Subject = 'E-mail verification from Job Site';
                  $mail->Body    = "<h4 align=left>
                                      Job Site has send you an E-mail Verification if you 
                                      are the one registering with us if not ignore this
                                      message
                                      <br>
                                      To Register with us : Verify your E-mail below
                                      <br>
                                      Link : click <a href='$url'>Job Site</a> to do so
                                    </h4>";
                  $mail->send();
                  echo "<script>alert('Thank you for Registering with us. We have sent a verification E-mail to the address provided')</script>";
                  echo "<script>window.open('index.php', '_self')</script>";
                  exit();
                } 
                catch (Exception $e)
                {
                  echo "<script>alert('Registered Successfully.')</script>";
                  echo "<script>window.open('myemp_log.php', '_self')</script>";
                  exit();
                }  
                exit();
              }
            }
          }
          else 
          {
            echo "<script>window.open('myemp_reg.php?signup%error', '_self')</script>";
          }
        }
      }
    }
  }
}
?>

<!DOCTYPE html>
<html>
	<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="This is an online web app for job application">
    <meta name="keywords" content="">
    <meta name="authour" content="Joeson Misiani">
    <title>Work Spot - home</title>

    <!--***** bootstrap & jquery plugins *****-->
    <link rel="stylesheet" href="MyCustom/bootstrap/css/bootstrap.min.css">
    <script src="MyCustom/js/jquery.js"></script>
    <script src="MyCustom/js/bootstrap.min.js"></script>

    <!--***** fontawesome styllings *****-->
    <link rel="stylesheet" type="text/css" 
    href="MyCustom/fontawesome-free/css/all.css">
    <link rel="stylesheet" type="text/css" 
    href="MyCustom/fontawesome-free/css/v4-shims.min.css">

    <!-- Favicons -->
    <link rel="icon" href="photos/aj.png">
  </head>

  <style>
    a, a:hover{ 
      text-decoration: none; 
      -webkit-transition:color .3s linear;
      -o-transition:color .3s linear;
      transition:color .3s linear;
      outline:0; 
    }
    body {
      margin:0;
      padding:0;
      border:0;
      outline:0;
      background-color: #ccc;
    }

    /*[ signup form ]*/
    .content {
      background: #fff;
      border: 1px solid transparent;
      border-bottom-right-radius: 4px;
      border-bottom-left-radius: 4px;
      box-shadow: 0px 0px 15px 3px rgba(0,0,0,.3);
      transform: translateX(120%) translateY(22%);
      width: 30%;
    }
    .title {
      background: dodgerblue;
      border: 1px solid transparent;
      border-bottom: 3px solid rgba(0,0,0,.7);
      color: #fff;
      height: 80px;
      width: 100.67%;
      margin-top: -1px;
      margin-left: -1px;
    }
    .title h1 {
      border: 1px solid transparent;
      margin-top: 3px;
      margin-left: 0px;
      padding-top: 13px;
      height: 45px;
      width: 99.8%;
      font-size: 20px;
      text-align: center;
      font-family: Segoe Print;
    }
    .title h2 {
      border: 1px solid transparent;
      margin-top: -25px;
      margin-left: 0px;
      padding-top: 12px;
      height: 30px;
      width: 99.8%;
      font-size: 16px;
      text-align: center;
      font-family: Segoe Print;
    }
    .sign {
      border: 1px solid transparent;
      border-bottom-right-radius: 4px;
      border-bottom-left-radius: 4px;
      background-color: transparent;
      width: 100.67%;
      margin-left: -1px;
    }
    .banner-body {
      border: 1px solid transparent;
      margin-top: 10px;
      margin-bottom: 10px;
      margin-left: 15px;
      width: 93%;
    }
    .nameOne {
      border: 1px solid transparent;
      width: 48.6%;
      height: 50px;
      float: left;
      margin-top: -10px;
    }
    .nameTwo {
      border: 1px solid transparent;
      width: 48.6%;
      height: 50px;
      margin-top: -10px;
      float: right;
    }
    .nameThree {
      border: 1px solid transparent;
      width: 48.6%;
      height: 50px;
      float: left;
      margin-top: 5px;
    }
    .nameFour {
      border: 1px solid transparent;
      width: 48.6%;
      height: 50px;
      margin-top: 5px;
      float: right;
    }
    .middleFirst {
      border: 1px solid transparent;
      width: 100%;
      height: 50px;
      margin-top: 100px;
    }
    .middleSecond {
      border: 1px solid transparent;
      width: 100%;
      height: 50px;
      margin-top: 5px;
    }
    .lastOne {
      border: 1px solid transparent;
      width: 48.6%;
      height: 50px;
      float: left;
      margin-top: 5px;
    }
    .lastTwo {
      border: 1px solid transparent;
      width: 48.6%;
      height: 50px;
      float: right;
      margin-top: 5px;
    }
    .sign input {
      border: none;
      border-bottom: 1px solid #aaa;
      box-sizing: border-box;
      width: 100%;
      margin-top: 21px;
      padding-bottom: 5px;
      outline: none;
      color: rgba(0,0,0,.7);
      background: transparent;
      font-family: Bahnschrift;
      font-size: 16px;
    }
    .sign select {
      border: 1px solid transparent;
      border-bottom: 1px solid #aaa;
      box-sizing: border-box;
      width: 100%;
      margin-top: 21px;
      padding-bottom: 5px;
      outline: none;
      color: rgba(0,0,0,.7);
      background: transparent;
      font-family: Bahnschrift;
      font-size: 16px;
    }
    .sign input:focus {
      transition: .3s;
      border-bottom-color: dodgerblue;
    }
    .sign select:focus {
      transition: .3s;
      border-bottom-color: dodgerblue;
    }
    .inputWithIcon {
      position: relative;
    }
    .inputWithIcon input {
      padding-left: 30px;
    }
    .inputWithIcon select {
      padding-left: 25px;
    }
    .inputWithIcon i {
      position: absolute;
      top: 8px;
      left: 0;
      padding-top: 0px;
      padding-left: 8px;
      padding-bottom: 9px;
      padding-right: 8px;
    }
    .inputWithIcon.inputIconBg i {
      background-color: transparent;
      color: rgba(0,0,0,.7);
      padding-top: 15px;
      padding-left: 3px;
      padding-bottom: 10px;
      padding-right: 25px;
      border-radius: 5px 0 0 5px;
    }
    .inputWithIcon.inputIconBg input:focus + i {
      transition: .3s;
      color: rgba(0,0,0,.7);
    }
    .inputWithIcon.inputIconBg select:focus + i {
      transition: .3s;
      color: rgba(0,0,0,.7);
    }
    .sign button {
      border: 1px solid transparent;
      border-radius: 4px;
      margin-top: 2px;
      margin-left: 15px;
      width: 93%;
      height: 35px;
      cursor: pointer;
      font-size: 16px;
      color: white;
      background-color: dodgerblue;
    }
    .sign button:hover {
      background-color: dodgerblue;
      opacity: 0.7;
    }
    .direction {
      font-family: Bahnschrift;
      border: 1px solid transparent;
      margin-top: -10px;
      margin-bottom: 8px;
      margin-left: 15px;
      width: 92%;
      height: 30px;
    }
    .direct_one {
      border: 1px solid transparent;
      width: 48%;
      height: 28px;
      float: left;
      margin-top: 0px;
      text-align: left;
      padding-top: 2px;
    }
    .direct_two {
      border: 1px solid transparent;
      width: 48%;
      height: 28px;
      margin-top: 0px;
      float: right;
      text-align: right;
      padding-top: 2px;
    }
    .log {
      font-size: 15px;
    }
    /*[ signup form ]*/
  </style>

	<body>
    <section>
      <div class="content">
        <div class="title">
          <h1>Welcome to Work Spot</h1>
          <h2>Create a new Account</h2>
        </div>

        <form action="" method="POST" autocomplete="off" class="sign">
          <div class="banner-body">
            <!--========== User Fullname ==========-->
            <div class="nameOne">
              <div class="inputWithIcon inputIconBg"> 
                <input type="text" name="user_fullname" placeholder="Fullname">
                <i class="fa fa-user fa-lg fa-fw" aria-hidden="true"></i>
              </div>
            </div>

            <!--========== Company name ==========-->
            <div class="nameTwo">
              <div class="inputWithIcon inputIconBg"> 
                <input type="text" name="user_company" placeholder="Company name">
                <i class="fa fa-users fa-lg fa-fw" aria-hidden="true"></i>
              </div>
            </div>

            <!--========== Company username ==========-->
            <div class="nameThree">
              <div class="inputWithIcon inputIconBg"> 
                <input type="text" name="user_name" placeholder="Username">
                <i class="fa fa-address-book fa-lg fa-fw" aria-hidden="true"></i>
              </div>
            </div>

            <!--========== Company phone ==========-->
            <div class="nameFour">
              <div class="inputWithIcon inputIconBg"> 
                <input type="text" name="user_phonenumber" placeholder="Phone number">
                <i class="fa fa-phone fa-lg fa-fw" aria-hidden="true"></i>
              </div>
            </div>

            <!--========== Company email ==========-->
            <div class="middleFirst">
              <div class="inputWithIcon inputIconBg"> 
                <input type="text" name="user_email" placeholder="someone@email.com">
                <i class="fa fa-envelope fa-lg fa-fw" aria-hidden="true" 
                style="margin-top:3px;"></i>
              </div>
            </div>

            <!--========== Company location ==========-->
            <div class="middleSecond">
              <div class="inputWithIcon inputIconBg"> 
                <input type="text" name="user_location" placeholder="Location">
                <i class="fa fa-map-marker fa-lg fa-fw" aria-hidden="true"></i>
              </div>
            </div>

            <!--========== User Password ===========-->
            <div class="lastOne">
              <div class="inputWithIcon inputIconBg"> 
                <input type="password" name="user_password" placeholder="password">
                <i class="fa fa-lock fa-lg fa-fw" aria-hidden="true"></i>
              </div>
            </div>

            <!--========== Confirm Password ===========-->
            <div class="lastTwo">
              <div class="inputWithIcon inputIconBg"> 
                <input type="password" name="confirm_pass" placeholder="confirm password">
                <i class="fa fa-lock fa-lg fa-fw" aria-hidden="true"></i>
              </div>
            </div>

            <br><br><br>
          </div>
        
          <button type="submit" name="register">Sign Up</button>
          <br><br>

          <div class="direction">
            <div class="direct_one">
              <a href="index.php" class="log">Home</a>
            </div>

            <div class="direct_two">
              <a href="myemp_log.php" class="log">Already a member</a>
            </div>
          </div>
        </form>
      </div>
    </section>
	</body>
</html>
			
