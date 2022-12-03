<?php
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;

  require 'PHPMailer/src/Exception.php';
  require 'PHPMailer/src/PHPMailer.php';
  require 'PHPMailer/src/SMTP.php';
  require 'PHPMailer/src/credential.php';

  if (isset($_POST["email"])) 
  {  
    session_start();
    include("includes/db.include.php");

    $mailTo  = $_POST["email"];

    $email_inquiry = "SELECT * FROM candidate WHERE user_email='".$mailTo."' ";
    $run_inquiry   = mysqli_query($con, $email_inquiry);

    if (mysqli_num_rows($run_inquiry) == 0) 
    {
      echo "<script>alert('Your Email is invalid')</script>";
      echo "<script>window.open('mycan_log.php', '_self')</script>";
      exit();
    }
    else
    {
      $mailTo  = $_POST["email"];
      
      // create a one time token 
      $token = uniqid(True);
      $pwd_change = "INSERT INTO can_request(user_token,user_email)
      VALUES('$token','$mailTo')";
      $run_request  = mysqli_query($con, $pwd_change);

      if (!$run_request) {
        exit("Your Password request had an Error");
      }
    
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
        $mail->setFrom(EMAIL, 'Work Spot');
        $mail->addAddress($mailTo);                   
        $mail->addReplyTo('no-reply@gmail.com', 'No Reply');   

        // Content
        $url = "http://" . $_SERVER["HTTP_HOST"] . dirname($_SERVER["PHP_SELF"]) . "/mycan_reset.php?token=$token";

        $mail->isHTML(true);                                  
        $mail->Subject = 'Work Spot send you a password reset link';
        $mail->Body    = "<h3 align=center>
                            Request : You requested a password reset<br>
                            Link : clink <a href='$url'>Reset</a> to reset your password
                          </h3>";

        $mail->send();
        echo "<script>alert('Reset Password link has been sent to your email')</script>";
        echo "<script>window.open('index.php', '_self')</script>";
        exit();
      } 
      catch (Exception $e)
      {
        echo "<script>alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}')</script>";
        echo "<script>window.open('mycan_log.php', '_self')</script>";
        exit();
      }  
      exit();
    }
  }

?>


<!DOCTYPE html>
<html>
  <head>
    <title>Work Spot</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--***** bootstrap & jquery plugins *****-->
    <link rel="stylesheet" href="MyCustom/bootstrap/css/bootstrap.min.css">
    <script src="MyCustom/js/jquery.js"></script>
    <script src="MyCustom/js/bootstrap.min.js"></script>
    
    <!--***** fontawesome css *****-->
    <link rel="stylesheet" type="text/css" 
    href="MyCustom/fontawesome-free/css/all.css">
    <link rel="stylesheet" type="text/css" 
    href="MyCustom/fontawesome-free/css/v4-shims.min.css">
 
    <!-- Favicons -->
    <link rel="icon" href="my-images/penetrator.png">
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
      transform: translateX(120%) translateY(35%);
      width: 30%;
    }
    .title {
      background: dodgerblue;
      border: 1px solid transparent;
      border-bottom: 3px solid rgba(0,0,0,.7);
      color: #fff;
      height: 80px;
      width: 100.5%;
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
      width: 100.5%;
      margin-left: -1px;
    }
    .banner-body {
      border: 1px solid transparent;
      margin-top: 10px;
      margin-bottom: 10px;
      margin-left: 15px;
      width: 93%;
    }
    .instruction {
      border: 1px solid transparent;
      width: 100%;
      height: 50px;
      margin-top: 0px;
    }
    .instruction p{
      border-bottom: 1px solid #aaa;
      color: rgba(0,0,0,.7);
      background: transparent;
      font-family: Bahnschrift;
      font-size: 16px;
      text-align: center;
      line-height: 23px;
    }
    .middle {
      border: 1px solid transparent;
      width: 100%;
      height: 50px;
      margin-top: -10px;
    }
    .top {
      border: 1px solid transparent;
      width: 100%;
      height: 50px;
      margin-top: 0px;
      margin-bottom: 7px;
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
    .sign input:focus {
      transition: .3s;
      border-bottom-color: dodgerblue;
    }
    .inputWithIcon {
      position: relative;
    }
    .inputWithIcon input {
      padding-left: 30px;
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
  </style>
  
  <body>
    <section>
      <div class="content">
        <div class="title">
          <h1>Welcome to Work spot</h1>
          <h2>Request of password reset</h2>
        </div>

        <form action="" method="POST" autocomplete="off" class="sign">
          <div class="banner-body">
            <div class="instruction">
              <p>
                Provide the E-mail you registered with and we shall send you
                the link to reset your password 
              </p>
            </div>

            <div class="middle top">
              <div class="inputWithIcon inputIconBg"> 
                <input type="email" name="email" placeholder="email">
                <i class="fa fa-envelope fa-lg fa-fw" aria-hidden="true" 
                style="margin-top:3px;"></i>
              </div>
            </div>
          </div>
          
          <button type="submit" name="reset">Reset</button>
          <br><br><br>

        </form>
      </div>
    </section>
  </body>
</html>
      
