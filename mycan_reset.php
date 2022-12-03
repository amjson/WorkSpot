<?php
  include("includes/db.include.php");

  if (!isset($_GET["token"])) 
  {
    exit("Page not found");
  }

  $token     = $_GET["token"];
  $user_email = "SELECT user_email FROM can_request WHERE user_token = '$token' ";
  $run_email  = mysqli_query($con, $user_email);


  if (mysqli_num_rows($run_email) == 0) 
  {
    exit("Page not found");
  }

  if (isset($_POST["password"])) 
  {
    $user_pass = $_POST["password"];

    if(strlen($user_pass) < 9)
    {
      echo "<script>alert('minimum characters should be 9')</script>";
    }
    else
    {
      $hashedPwd = password_hash($user_pass, PASSWORD_BCRYPT);

      $row   = mysqli_fetch_array($run_email);
      $email = $row["user_email"];

      $query = "UPDATE candidate SET user_pass='$hashedPwd' WHERE user_email='$email'";
      $run_query = mysqli_query($con, $query);


      if ($run_query) 
      {
        $Del_request = "DELETE FROM can_request WHERE user_token = '$token' ";
        $run_Del     = mysqli_query($con, $Del_request);
        echo "<script>alert('You Updated Your Password Successfully')</script>";
        exit();
      }
      else
      {
        echo "<script>alert('An Error Occured')</script>";
        exit();
      }
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
          <h1>Welcome to Work Spot</h1>
          <h2>Create a new password</h2>
        </div>

        <form action="" method="POST" autocomplete="off" class="sign">
          <div class="banner-body">
            <div class="instruction">
              <p>
                You will now be using the new password that you are 
                going to create 
              </p>
            </div>

            <div class="middle top">
              <div class="inputWithIcon inputIconBg"> 
                <input type="password" name="password" placeholder="New Password">
                <i class="fa fa-lock fa-lg fa-fw" aria-hidden="true"></i>
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
      
