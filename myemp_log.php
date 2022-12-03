<?php
if(isset($_POST['login']))
{
  session_start();
  include("includes/db.include.php");

  $email    =  htmlentities(mysqli_real_escape_string($con, $_POST['user_email']));
  $pass     =  htmlentities(mysqli_real_escape_string($con, $_POST['user_pass']));

  if(empty($email) || empty($pass))
  {
    header("Location: myemp_log.php?login%empty");
    exit();
  }
  else
  {
    $my_user = "SELECT * FROM employer WHERE user_email='".$email."' ";
    $query   = mysqli_query($con, $my_user);
       
    if(mysqli_num_rows($query) > 0)
    {
      $row           = mysqli_fetch_assoc($query);
      $password_hash = $row['user_pass'];
      if(password_verify($pass, $password_hash))
      {
        $email     = htmlentities(mysqli_real_escape_string($con, $_POST['user_email']));
        $get_user  = "SELECT * FROM employer WHERE user_email='".$email."' ";
        $run_user  = mysqli_query($con, $get_user);
        $row       = mysqli_fetch_array($run_user);
        $user_auth = $row['acc_verify'];
        
        if ($user_auth == 1) 
        {
          $_SESSION['user_email'] = $email;
          $online     = "UPDATE employer SET log_in='Online' WHERE user_email='".$email."' ";
          $update_msg = mysqli_query($con, $online);

          //start time
          $_SESSION['initial_time'] = time();

          $user      = $_SESSION['user_email'];
          $get_user  = "SELECT * FROM employer WHERE user_email='$user'";
          $run_user  = mysqli_query($con, $get_user);
          $row       = mysqli_fetch_array($run_user);

          $user_name = $row['user_name'];
          echo "<script>window.open('myemployer.php?user_name%$user_name', '_self')</script>";
        }
        else 
        {
          echo "<script>alert('Error. This account is not verified.')</script>";
          echo "<script>window.open('myemp_log.php', '_self')</script>";
        }
      }
      else
      {
        header("Location: myemp_log.php?login%error");
        exit();
      }
    }
    else
    {
      header("Location: myemp_log.php?login%error");
      exit();
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
    <title>Work Spot</title>

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
    .forgotPass {
      font-family: Bahnschrift;
      border: 1px solid transparent;
      margin-top: -5px;
      margin-bottom: 8px;
      margin-left: 15px;
      width: 92%;
      height: 30px;
    }
    .pwd_reset {
      border: 1px solid transparent;
      width: 48%;
      height: 28px;
      margin-top: 0px;
      float: left;
      text-align: left;
      padding-top: 2px;
    }
    /*[ signup form ]*/
  </style>
	
	<body>
    <section>
      <div class="content">
        <div class="title">
          <h1>Welcome to Work Spot</h1>
          <h2>Login to my Account</h2>
        </div>

        <form action="" method="POST" autocomplete="off" class="sign">
          <div class="banner-body">
            <!--=========== User Email ============-->
            <div class="middle">
              <div class="inputWithIcon inputIconBg"> 
                <input type="text" name="user_email" placeholder="Email">
                <i class="fa fa-envelope fa-lg fa-fw" aria-hidden="true" 
                style="margin-top:3px;"></i>
              </div>
            </div>

            <!--=========== User Password ============-->
            <div class="middle top">
              <div class="inputWithIcon inputIconBg"> 
                <input type="password" name="user_pass" placeholder="password">
                <i class="fa fa-lock fa-lg fa-fw" aria-hidden="true"></i>
              </div>
            </div>
          </div>
          
          <button type="submit" name="login">Log In</button>
          <br><br>

          <div class="direction">
            <div class="direct_one">
              <a href="index.php" class="log">Home</a>
            </div>

            <div class="direct_two">
              <a href="myemp_reg.php" class="log">Create new account</a>
            </div>
          </div>

          <div class="forgotPass">
            <div class="pwd_reset">
              <a href="myemp_request.php" class="log">Forgot Password</a>
            </div>
          </div>
        </form>
      </div>
    </section>
	</body>
</html>
			
