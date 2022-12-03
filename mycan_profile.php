<?php
  session_start();

  if(isset($_POST['save']))
  {
    include ("includes/db.include.php");

    $file        =  $_FILES['avatar'];
    $fileName    =  $_FILES['avatar']['name'];
    $fileTmpName =  $_FILES['avatar']['tmp_name'];
    $fileSize    =  $_FILES['avatar']['size'];
    $fileError   =  $_FILES['avatar']['error'];
    $fileType    =  $_FILES['avatar']['type'];
  
    $fileExt       =  explode('.', $fileName);
    $fileActualExt =  strtolower(end($fileExt));
  
    $allowed = array('jpg', 'jpeg', 'png', 'jfif');
      
    if(in_array($fileActualExt, $allowed)) 
    {
      if($fileError === 0) 
      {
        if($fileSize < 10000000) 
        { 
          $fileNameNew = uniqid('', true).".".$fileActualExt;
          $fileDestination = 'canprofile/'.$fileNameNew;
          move_uploaded_file($fileTmpName, $fileDestination);

          $prof_title=htmlentities(mysqli_real_escape_string($con, $_POST['prof_title']));
          $fullname=htmlentities(mysqli_real_escape_string($con, $_POST['fullname']));
          $age=htmlentities(mysqli_real_escape_string($con, $_POST['age']));
          $gender=htmlentities(mysqli_real_escape_string($con, $_POST['gender']));
          $phone=htmlentities(mysqli_real_escape_string($con, $_POST['phone']));
          $alt_phone=htmlentities(mysqli_real_escape_string($con, $_POST['alt_phone']));
          $email=htmlentities(mysqli_real_escape_string($con, $_POST['email']));
          $p_box=htmlentities(mysqli_real_escape_string($con, $_POST['p_box']));
          $study=htmlentities(mysqli_real_escape_string($con, $_POST['study']));
          $interested=htmlentities(mysqli_real_escape_string($con, $_POST['interested']));
          $xp=htmlentities(mysqli_real_escape_string($con, $_POST['xp']));
          $token   = $_POST['token'];

          if(empty($prof_title) || empty($fullname) || empty($age) || empty($gender) 
            || empty($phone) || empty($alt_phone) || empty($email) || empty($p_box) 
            || empty($study) || empty($interested) || empty($xp))
          {
            echo "<script>alert('Profile Empty')</script>";
            echo "<script>window.open('mycan_profile.php?token=$token', '_self')</script>";
            exit();
          }
          else
          {
            if (!preg_match("/^[a-z A-Z]*$/", $fullname))
            {
              echo "<script>alert('Profile Error')</script>";
              echo "<script>window.open('mycan_profile.php?token=$token', 
              '_self')</script>";
              exit();
            }
            else 
            {
              if(!filter_var($email, FILTER_VALIDATE_EMAIL))
              {
                echo "<script>alert('Profile Error')</script>";
                echo "<script>window.open('mycan_profile.php?token=$token', '_self')</script>";
                exit();
              } 
              else
              {
                $sql = "SELECT * FROM canprofile WHERE fullname='$fullname' OR 
                phone='$phone' OR email='$email' OR token='$token'";
                $result = mysqli_query($con, $sql);
                $resultCheck = mysqli_num_rows($result);

                if($resultCheck > 0)
                { 
                  echo "<script>alert('Profile Cridentials already in use')</script>";
                  echo "<script>window.open('mycan_profile.php?token=$token', '_self')</script>";
                  exit();   
                }
                else 
                {
                  $sqlquery = "INSERT INTO canprofile(photo,prof_title,fullname,
                  age,gender,phone,alt_phone,email,p_box,study,interested,xp,token)
                  VALUES('$fileDestination','$prof_title','$fullname',
                  '$age','$gender','$phone','$alt_phone','$email','$p_box','$study',
                  '$interested','$xp','$token')";
                  $verifyquery = mysqli_query($con, $sqlquery);

                  if ($verifyquery) 
                  {
                    echo "<script>alert('Thank you for filling your Profile form.')</script>";
                    echo "<script>window.open('mycan_profile.php?token=$token', '_self')</script>";
                    exit();
                  }
                }
              }
            }
          }          
        }
        else {
          echo "<script>alert('Your Profile Photo is too big')</script>";
          echo "<script>window.open('mycan_profile.php?token=$token', '_self')</script>";
          exit();
        }
      }
      else {
        echo "<script>alert('There was an error with your profile photo')</script>";
        echo "<script>window.open('mycan_profile.php?token=$token', '_self')</script>";
        exit();
      }
    }
    else {
      echo "<script>alert('You cannot save an empty profile, please complete filling the form')</script>";
      echo "<script>window.open('mycan_profile.php?token=$token', '_self')</script>";
      exit();
    }
  }
?>



<!DOCTYPE html>
<?php
  include ("includes/db.include.php");

  if (!isset($_SESSION['user_email'])) {
    header("Location: index.php");
    exit();
  }
  else { ?>
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
      li {
        list-style: none;
      }
      body {
        margin:0;
        padding:0;
        border:0;
        outline:0;
        background-color: #ccc;
        overflow: hidden;
      }
      
      /**[ start nav bar ]**/
      .pro_bar {
        /*box-shadow: none;*/
        box-shadow: 0px 0px 5px 1px rgba(0,0,0,.3);
        border-radius: 0px;
        border: 1px solid transparent;
        height: 80px !important;
        background: #fff;
        /*background: #f5f5f5;*/
      }
      .left_side_bar {
        border: 1px solid transparent;
        margin-left: 65px;
        padding-left: 0px;
        height: 70px;
        width: 130px;
        margin-top: 4px;
        float: left;
        padding-top: 15px;
      }
      .left_side_bar .forlogo {
        width:128px;
        height: 40px;
        border:1px solid transparent;
      }
      .left_side_bar .forlogo img {
        margin-top: -4px;
        width:125px;
        height: 45px;
      }
      .right_side_bar {
        border: 1px solid transparent;
        margin-left: 755px;
        height: 70px;
        margin-top: 4px;
        padding-left: 0px;
        float: left;
      }
      .right_side_bar .my_img {
        border: 1px solid transparent;
        width: 60px;
        float: left;
        height: 49px;
        margin-top: 10px;
      }
      .right_side_bar .my_img .forprofile {
        width: 50px;
        height: 50px;
        border:1px solid #aaa;
        border-radius: 50%;
        margin-top: -1px;
        margin-left: 4px;
      }
      .right_side_bar .my_img .forprofile img {
        margin-top: -1px;
        margin-left: -1px;
        width: 50px;
        height: 50px;
        border-radius: 50%;
      }
      .right_side_bar .uname{
        font-family: Bookman Old Style;
        font-size: 18px;
        border:1px solid transparent;
        float: left;
        height: 49px;
        line-height: 49px;
        margin-top: 10px;
        padding-left: 7px;
      }
      .right_side_bar .caret {
        border:1px solid transparent;
        height: 49px;
        width: 20px;
        margin-top: 10px;
        margin-left: 3px;
        float: left;
        font-family: Bookman Old Style;
        font-size: 20px;
        padding-top: 12px;
        padding-left: 7px;
      }
      .right_side_bar .caret a {
        margin-left: -14px;
        color: rgba(0,0,0,.7);
        cursor: pointer;
      }
      .right_side_bar .caret .drop_me_down {
        margin-left: -130px;
        padding-left: 30px;
        box-shadow: 0px 0px 5px 1px rgba(0,0,0,.3);
      }
      .right_side_bar .caret .drop_me_down .locate {
        font-family: Bookman Old Style;
        font-size: 17px;
      }
      .right_side_bar .caret .drop_me_down .locate:hover {
        background: none;
        box-shadow: none;
        color: dodgerblue;
        font-family: Bookman Old Style;
        font-size: 17px;
      }
      .form_exit {
        border-top: 1px solid #ccc;margin-left: -30px;
      }
      .form_exit input {
        font-family: Bookman Old Style;
        font-size: 17px;
        border: none;
        box-sizing: border-box;
        outline: none;
        background: transparent;
        cursor: pointer;
        color: rgba(0,0,0,.7);
        padding-left: 16px;
      }
      .form_exit input:hover {
        color: dodgerblue;
        background: none;
        box-shadow: none;
        text-decoration: none; 
        -webkit-transition:color .3s linear;
        -o-transition:color .3s linear;
        transition:color .3s linear;
        outline:0; 
      }
      /**[ finish nav bar ]**/

      .layers {
        margin-top: 0px;
        margin-left: 0px;
        width: 100%;
        height: 586px;
        background-color: transparent;
        border: none;
      }
      /*****[start layer two]*****/  
      .layertwo {
        float: left;
        margin-top: -20px;
        width: 18%;
        height: 587px;
        background-color: #fff;
        border: 1px solid transparent;
        border-top: 1px solid #aaa;
        box-shadow: 0px 0px 5px 1px rgba(0,0,0,.3);
      }
      .top-layer {
        border: 1px solid transparent;
        width: 100%;
        height: 126px;
        background-color: #fff;
        border-bottom: 1px solid #ccc;
        padding-top: 14px;
      }
      .myphoto {
        width: 65px;
        height: 65px;
        border: 1px solid transparent;
        margin-top: 15px;
        margin-left: 10px;
        margin-bottom: 5px;
      }
      .myphoto img {
        width: 100%;
        height: 100%;
        border-radius: 50%;
      }
      .fullname {
        width: 165px;
        height: 25px;
        line-height: 25px;
        border: 1px solid transparent;
        text-align: left;
        margin-top: -64px;
        margin-left: 75px;
        padding-left: 8px;
        color: rgba(0,0,0,.8);
        letter-spacing: 0px;
        font-family: Bookman Old Style;
        font-size: 15px;
      }
      .username {
        width: 165px;
        height: 25px;
        line-height: 25px;
        border: 1px solid transparent;
        text-align: left;
        margin-top: 5px;
        margin-left: 75px;
        padding-left: 8px;
        color: rgba(0,0,0,.8);
        letter-spacing: 0px;
        font-family: Bookman Old Style;
        font-size: 15px;
      }
      .bottom-layer {
        border: 1px solid transparent;
        width: 100%;
        background-color: transparent;
        margin-top: 20px;
      }
      .bottom-layer ul {
        border: 1px solid transparent;
        width: 100%;
        margin-left: 0px;
        padding-left: 0px;
      }
      .bar {
        border: 1px solid transparent;
        width: 100%;
        height: 40px;
        margin-top: 8px;
        margin-left: 0px;
        background-color: transparent;
        padding-top: 12px;
      }
      .bar i { 
        padding-left: 20px;
        font-size: 20px; 
      }
      .bar a {
        font-family: Bookman Old Style;
        font-size: 17px;
        border:1px solid transparent;
        color: rgba(0,0,0,.8);
        margin-left: 30px;
      }
      .bar a:hover {
        color: dodgerblue; 
        -webkit-transition:color .2s linear;
        -o-transition:color .2s linear;
        transition:color .2s linear;
        outline:0; 
      }
      /*****[finish layer two]*****/  

      /*****[start layer three]*****/
      .layerthree {
        border: 1px solid transparent;
        float: right;
        margin-top: -20px;
        margin-right: 0px;
        width: 82%;
        height: 587px;
        background-color: transparent;
      }
      /*[ blueprint ]*/
      .job_page {
        border: 1px solid transparent;
        box-shadow: 0px 0px 5px 1px rgba(0,0,0,.3);
        background-color: #fff;
        width: 60%;
        height: 525px;
        margin-top: 30px;
        margin-left: 220px;
        overflow: hidden;
      }
      .job_inner {
        border: 1px solid transparent;
        background-color: transparent;
        width: 103%;
        height: 100%;
        margin-top: 0px;
        margin-left: 0px;
        overflow-y: scroll;
      }
      #form {
        border: 1px solid transparent;
        background-color: transparent;
        width: 100%;
        margin-top: 0px;
        margin-left: 0px;
        padding-top: 10px;
        padding-left: 10px;
        padding-right: 10px;
      }
      .comp_photo {
        border: 1px solid transparent;
        width: 250px;
        height: 72px;
      }
      .comp_photo div {
        width: 70px;
        height: 70px;
        border:1px solid #aaa;
        border-radius: 50%;
        float: left;
      }
      .comp_photo label {
        font-size: 14px;
        padding: 3px;
        margin-top: 4px;
        margin-left: -5px;
      }
      .comp_photo #update_profile {
        text-align: center;
        cursor: pointer;
        border-radius: 50%;
        border: none;
        background-color: rgba(0,0,0,.8);
        color: #fff;
        opacity: 0.7;
      }
      .comp_photo #update_profile:hover {
        background-color: rgba(0,0,0,.8);
        opacity: 0.9;
      }
      .comp_photo input[type="file"] {
        display: none;
      }
      .comp_photo div img {
        border-radius: 50%;
        width: 100%;
        height: 100%;
        margin-top: -35px;
      }
      .comp_photo div h5 {
        border:1px solid transparent;
        width: 90px;
        height: 24px;
        margin-top: -70px;
        margin-left: 529px;
        color: rgba(0,0,0,.7);
        font-family: Comic Sans MS;
        font-size: 20px;
        letter-spacing: 1px;
      }
      .comp_photo div h5 .icon {
        border:1px solid transparent;
        margin-left: 5px;
        color: rgba(0,0,0,.6);
        font-family: Comic Sans MS;
        position: relative;
        font-size: 18px;
        cursor: pointer;
      }
      .comp_photo div h5 .icon:hover {
        color: rgba(0,0,0,.8);
        -webkit-transition:color .1s linear;
        -o-transition:color .1s linear;
        transition:color .1s linear;
      }
      .job_body {
        border: 1px solid transparent;
      }
      .box_top {
        width: 60%;
        height: 50px;
        border: 1px solid transparent;
        background-color: transparent;
        margin-top: -52px;
        margin-right: 16px;
        padding-left: 10px;
        float: right;
      }
      .box {
        width: 100%;
        height: 50px;
        border: 1px solid transparent;
        background-color: transparent;
        padding-left: 10px;
      }
      .title {
        width: 100%;
        height: 35px;
        border: 1px solid transparent;
        background-color: transparent;
        margin-top: 30px;
        padding-left: 10px;
      }
      .title h4 {
        border: none;
        border-bottom: 1px solid #aaa;
        box-sizing: border-box;
        width: 95%;
        padding-bottom: 3px;
        outline: none;
        color: rgba(0,0,0,.7);
        background: transparent;
        font-family: Bahnschrift;
        font-size: 16px;
      }
      .box_one {
        width: 100%;
        height: 50px;
        border: 1px solid transparent;
        background-color: transparent;
        padding-left: 10px;
      }
      .box_two {
        width: 100%;
        height: 50px;
        border: 1px solid transparent;
        background-color: transparent;
        padding-left: 10px;
      }
      .job_body input {
        border: none;
        border-bottom: 1px solid #aaa;
        box-sizing: border-box;
        width: 95%;
        margin-top: 21px;
        padding-bottom: 5px;
        outline: none;
        color: rgba(0,0,0,.7);
        background: transparent;
        font-family: Bahnschrift;
        font-size: 16px;
      }
      .job_body select {
        border: 1px solid transparent;
        border-bottom: 1px solid #aaa;
        box-sizing: border-box;
        width: 95%;
        margin-top: 21px;
        padding-bottom: 10px;
        outline: none;
        color: rgba(0,0,0,.7);
        background: transparent;
        font-family: Bahnschrift;
        font-size: 16px;
      }
      .job_body input:focus {
        transition: .3s;
        border-bottom-color: dodgerblue;
      }
      .job_body select:focus {
        transition: .3s;
        border-bottom-color: dodgerblue;
      }
      .inputWithIcon {
        position: relative;
      }
      .inputWithIcon input {
        padding-left: 35px;
      }
      .inputWithIcon select {
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
      .inputWithIcon.inputIconBg select:focus + i {
        transition: .3s;
        color: rgba(0,0,0,.7);
      }
      .tell {
        float: right;
        width: 100%;
        height: 75px;
        border: 1px solid transparent;
        background-color: transparent;
        padding-left: 10px;
      }
      .tell textarea {
        border: none;
        border-bottom: 1px solid #aaa;
        box-sizing: border-box;
        width: 98%;
        margin-top: 5px;
        padding-bottom: 20px;
        outline: none;
        color: rgba(0,0,0,.7);
        background: transparent;
        font-family: Bahnschrift;
        font-size: 16px;
      }
      .tell textarea:focus {
        transition: .3s;
        border-bottom-color: dodgerblue;
      } 
      .finalise {
        width: 100%;
        height: 70px;
        border: 1px solid transparent;
        background-color: transparent;
        padding-left: 10px;
      }
      .finalise .submit {
        background: dodgerblue;
        border-color: transparent;
        border-radius: 3px;
        color: #fff;
        font-size: 16px;
        letter-spacing: 2px;
        height: 30px;
        width: 20%;
        margin-top: 20px;
      }
      .finalise .submit:hover {
        cursor: pointer;
        background: dodgerblue;
        opacity: .8;
      }
      /*[ blueprint ]*/
      /*****[finish layer three]*****/
    </style>
  
    <body>
      <section>
        <nav class="navbar navbar-expand-lg pro_bar">
          <ul class="left_side_bar">
            <div class="forlogo">
              <a href="">
                <li><img src="photos/WorkSpot Logo 2.png"></li>
              </a>
            </div>
          </ul>

          <ul class="right_side_bar">
            <?php
              $user         = $_SESSION['user_email'];
              $get_user     = "SELECT * FROM candidate WHERE user_email='$user'";
              $run_user     = mysqli_query($con, $get_user);
              $row          = mysqli_fetch_array($run_user);
              $user_name    = $row['user_name'];
              $user_profile = $row['user_profile'];
              $token        = $row['token'];

              echo 
              "
                <li class='my_img'>
                  <div class='forprofile'><img src='$user_profile'></div>
                </li>

                <li class='uname'>
                  $user_name
                </li>

                <li class='nav-item dropdown caret'>
                  <a class='nav-link' id='navbarDropdownProfile' data-toggle='dropdown'
                  aria-haspopup='true' aria-expanded='false'>
                    <i class='fa fa-caret-down fa-lg fa-fw' aria-hidden='true'></i>
                  </a>

                  <div class='dropdown-menu dropdown-menu-right drop_me_down' 
                  aria-labelledby='navbarDropdownProfile'>
                    <a class='dropdown-item locate' href='mycan_profile.php?token=$token'>
                      Profile
                    </a><br>
                    <a class='dropdown-item locate' href='mycan_settings.php?token=$token'>
                      Settings
                    </a><br>
                    <div class='dropdown-divider'></div>
                    <div class='dropdown-item locate form_exit'>
                      <form action='' method='post'>
                        <input type='submit' name='exit' value='Logout'>
                      </form>
                    </div>
                  </div>
                </li>
              ";

              if(isset($_POST['exit']))
              {
                $user      = $_SESSION['user_email'];
                $get_user  = "SELECT * FROM candidate WHERE user_email='$user'";
                $run_user  = mysqli_query($con, $get_user);
                $row       = mysqli_fetch_array($run_user);
                $my_name   = $row['user_name'];
                
                $Offline    = "UPDATE candidate SET log_in='Offline' WHERE 
                user_name='".$my_name."' ";
                $update_msg = mysqli_query($con, $Offline);
                
                echo"<script>window.open('includes/logout.include.php', '_self')</script>";
              }
            ?>
          </ul>
        </nav>
      </section>

      <section>
        <div class="layers">
          <div class="layertwo">
            <div class="top-layer">
              <?php
                $user     = $_SESSION['user_email'];
                $get_user = "SELECT * FROM candidate WHERE user_email='$user'";
                $run_user = mysqli_query($con, $get_user);
                $row      = mysqli_fetch_array($run_user);
                $profile    = $row['user_profile'];
                $firstname  = $row['user_firstname'];
                $lastname   = $row['user_lastname'];
                $proffesion = $row['user_proffesion'];

                echo "<div class='myphoto'><img src='$profile'></div>";
                echo "<div class='fullname'>$firstname $lastname</div>";
                echo "<div class='username'>$proffesion</div>";
              ?>
            </div>

            <div class="bottom-layer">
              <ul>
                <?php
                  $user      = $_SESSION['user_email'];
                  $get_user  = "SELECT * FROM candidate WHERE user_email='$user'";
                  $run_user  = mysqli_query($con, $get_user);
                  $row       = mysqli_fetch_array($run_user);
                  $user_name = $row['user_name'];
                  $token     = $row['token'];

                  echo 
                  "
                  <li class='bar'>
                    <i class='fa fa-desktop fa-lg fa-fw' aria-hidden='true'></i>
                    <a href='mycandidate.php?user_name=$user_name'>Home</a>
                  </li>
                  ";

                  echo 
                  "
                  <li class='bar'>
                    <i class='fa fa-book fa-lg fa-fw' aria-hidden='true'></i>
                    <a href='mycan_profile.php?token=$token'>Profile</a>
                  </li>
                  ";

                  echo 
                  "
                  <li class='bar'>
                    <i class='fa fa-search fa-lg fa-fw' aria-hidden='true'></i>
                    <a href='mycan_vaccancy.php?token=$token'>Vacancies</a>
                  </li>
                  ";

                  echo 
                  "
                  <li class='bar'>
                    <i class='fa fa-tags fa-lg fa-fw' aria-hidden='true'></i>
                    <a href='mycan_applications.php?token=$token'>Applications</a>
                  </li>
                  ";

                  echo 
                  "
                  <li class='bar'>
                    <i class='fa fa-calendar fa-lg fa-fw' aria-hidden='true'></i>
                    <a href='mycan_callendar.php'>Callendar</a>
                  </li>
                  ";

                  echo 
                  "
                  <li class='bar'>
                    <i class='fa fa-wrench fa-lg fa-fw' aria-hidden='true'></i>
                    <a href='mycan_settings.php?token=$token'>Settings</a>
                  </li>
                  ";
                ?>
              </ul>
            </div>
          </div>

          <div class="layerthree">
            <!-- [ blueprint ] -->
            <div class="job_page">
              <div class="job_inner">
                <!-- [ fetching user info from profile form ] -->
                <?php
                  $user        = $_SESSION['user_email'];
                  $get_profile = "SELECT * FROM canprofile WHERE email='$user'";
                  $run_profile = mysqli_query($con, $get_profile);
                  $row      = mysqli_fetch_array($run_profile);

                  $photo      = $row['photo'];
                  $prof_title = $row['prof_title'];
                  $fullname   = $row['fullname'];
                  $age        = $row['age'];
                  $gender     = $row['gender'];
                  $phone      = $row['phone'];
                  $alt_phone  = $row['alt_phone'];
                  $email      = $row['email'];
                  $p_box      = $row['p_box'];
                  $study      = $row['study'];
                  $interested = $row['interested'];
                  $xp         = $row['xp'];
                ?>

                <form action="" method="POST" enctype="multipart/form-data" 
                id="form" autocomplete="off" style="padding-top:35px;">
                  <!-- include the token in reg form -->
                  <?php
                    $user     = $_SESSION['user_email'];
                    $get_user = "SELECT * FROM candidate WHERE user_email='$user'";
                    $run_user = mysqli_query($con, $get_user);
                    $row      = mysqli_fetch_array($run_user);

                    $email    = $row['user_email'];
                    $token    = $row['token'];
                  ?>  
                  <input type="hidden" name="token" value="<?php echo $token; ?>">

                  <div class="comp_photo">
                    <div>
                      <?php
                        $user    = $_SESSION['user_email'];
                        $my_user="SELECT * FROM canprofile WHERE email='".$user."'";
                        $query   = mysqli_query($con, $my_user);
                      ?>

                      <?php if(mysqli_num_rows($query) > 0) { 
                        $row   = mysqli_fetch_assoc($query);
                        $photo = $row['photo']; ?>
                        <img src="<?php echo $photo; ?>" style="margin-top:0px;">

                        <h5>
                          Edit
                          <a class="icon" data-toggle="modal" data-target="#myModal">
                          <i class="fa fa-pencil-square-o fa-lg fa-fw" aria-hidden="true">
                          </i>
                        </a>
                        </h5>
                        
                      <?php } else { ?>
                        <label id='update_profile'>
                          <i class="fa fa-camera fa-lg fa-fw" aria-hidden="true"></i>
                          <input type='file' name='avatar'>
                        </label>
                        <img src="photos/default.jpeg">
                      <?php } ?>                       
                    </div>
                  </div>
                    
                  <div class="job_body">
                    <div class="box_top">
                      <div class="inputWithIcon inputIconBg"> 
                        <input type="text" name="prof_title" placeholder="Proffessional Title" value="<?php echo $prof_title ?>">
                        <i class="fa fa-briefcase fa-lg fa-fw" aria-hidden="true"
                        style="margin-top:2px"></i>
                      </div>
                    </div>

                    <div class="box">
                      <div class="inputWithIcon inputIconBg"> 
                        <input type="text" name="fullname" placeholder="Full Name" 
                        value="<?php echo $fullname ?>">
                        <i class="fa fa-user fa-lg fa-fw" aria-hidden="true"
                        style="margin-top:2px"></i>
                      </div>
                    </div>

                    <div class="box">
                      <div class="inputWithIcon inputIconBg"> 
                        <input type="text" name="age" placeholder="Age" 
                        value="<?php echo $age ?>">
                        <i class="fa fa-sort-amount-desc fa-lg fa-fw" aria-hidden="true"
                        style="margin-top:2px"></i>
                      </div>
                    </div>

                    <div class="box">
                      <div class="inputWithIcon inputIconBg"> 
                        <input type="text" name="gender" placeholder="Gender" 
                        value="<?php echo $gender ?>">
                        <i class="fa fa-venus fa-lg fa-fw" aria-hidden="true"
                        style="margin-top:2px"></i>
                      </div>
                    </div>

                    <div class="title"><h4>CONTACTS</h4></div>

                    <div class="box_one">
                      <div class="inputWithIcon inputIconBg">
                        <input type="text" name="phone" placeholder="Phonenumber"
                        value="<?php echo '0'.$phone ?>">
                        <i class="fa fa-phone fa-lg fa-fw" aria-hidden="true"></i>
                      </div>
                    </div>

                    <div class="box_one">
                      <div class="inputWithIcon inputIconBg">
                        <input type="text" name="alt_phone" placeholder="Alternative Phonenumber" value="<?php echo '0'.$alt_phone ?>">
                        <i class="fa fa-phone fa-lg fa-fw" aria-hidden="true"></i>
                      </div>
                    </div>

                    <div class="box_one">
                      <div class="inputWithIcon inputIconBg">
                        <input type="text" name="email" value="<?php echo$email ?>">
                        <i class="fa fa-envelope-o fa-lg fa-fw" aria-hidden="true"
                        style="margin-top:2px"></i>
                      </div>
                    </div>

                    <div class="box_one">
                      <div class="inputWithIcon inputIconBg">
                        <input type="text" name="p_box" placeholder="P.O Box number"
                        value="<?php echo $p_box ?>">
                        <i class="fa fa-folder-o fa-lg fa-fw" aria-hidden="true"></i>
                      </div>
                    </div>

                    <div class="title"><h4>APPLICANT</h4></div>

                    <div class="box_two">
                      <div class="inputWithIcon inputIconBg">
                        <input type="text" name="study" placeholder="Course Study"
                        value="<?php echo $study ?>">
                        <i class="fa fa-file-text-o fa-lg fa-fw" aria-hidden="true"></i>
                      </div>
                    </div>

                    <div class="box_two">
                      <div class="inputWithIcon inputIconBg">
                        <input type="text" name="interested" placeholder="Field of Interest"
                        value="<?php echo $interested ?>">
                        <i class="fa fa-gears fa-lg fa-fw" aria-hidden="true"></i>
                      </div>
                    </div>

                    <div class="box_two">
                      <div class="inputWithIcon inputIconBg">
                        <input type="text" name="xp" placeholder="Years of Experience"
                        value="<?php echo $xp ?>">
                        <i class="fa fa-bar-chart-o fa-lg fa-fw" aria-hidden="true"
                        style="margin-top:2px"></i>
                      </div>
                    </div>

                    <div class="finalise">
                      <?php
                        $user    = $_SESSION['user_email'];
                        $my_user="SELECT * FROM canprofile WHERE email='".$user."'";
                        $query   = mysqli_query($con, $my_user);
                      ?>

                      <?php if(mysqli_num_rows($query) > 0) { ?>
                        <input type="hidden" value="save">
                      <?php } else { ?>
                        <input type="submit" class="form-control submit" 
                        name="save" value="save">
                      <?php } ?>  
                    </div>
                  </div>
                </form>
              </div>
            </div>

            <!-- Modal -->
            <div id="myModal" class="modal fade" role="dialog">
              <div class="modal-dialog">
                <!-- Modal header -->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                      &times;
                    </button>
                    <h4 class="modal-title">Edit your profile</h4>
                  </div>

                  <!-- Modal body -->
                  <div class="modal-body">
                    <form action="" method="POST" enctype="multipart/form-data" 
                    id="form" autocomplete="off">
                      <!-- [ fetching user info from profile form ] -->
                      <?php
                        $user        = $_SESSION['user_email'];
                        $get_profile="SELECT * FROM canprofile WHERE email='$user'";
                        $run_profile= mysqli_query($con, $get_profile);
                        $row      = mysqli_fetch_array($run_profile);                    

                        $photo      = $row['photo'];
                        $prof_title = $row['prof_title'];
                        $fullname   = $row['fullname'];
                        $age        = $row['age'];
                        $phone      = $row['phone'];
                        $alt_phone  = $row['alt_phone'];
                        $email      = $row['email'];
                        $p_box      = $row['p_box'];
                        $study      = $row['study'];
                        $interested = $row['interested'];
                        $xp         = $row['xp'];
                        $token     = $row['token'];
                      ?> 
                    
                      <input type="hidden" name="token" value="<?php echo$token;?>">

                      <div class="comp_photo">
                        <div>
                          <label id='update_profile'>
                            <i class="fa fa-camera fa-lg fa-fw" aria-hidden="true"></i>
                            <input type="hidden" name="oldimage" 
                            value="<?= $photo; ?>">
                            <input type='file' name='avatar'>
                          </label>
                          <img src="<?= $photo; ?>">                  
                        </div>
                      </div>
                  
                      <div class="job_body">
                        <div class="box_top">
                          <div class="inputWithIcon inputIconBg"> 
                            <input type="text" name="prof_title" 
                            value="<?= $prof_title ?>">
                            <i class="fa fa-globe fa-lg fa-fw" aria-hidden="true"
                            style="margin-top:2px"></i>
                          </div>
                        </div>

                        <div class="box">
                          <div class="inputWithIcon inputIconBg"> 
                            <input type="text" name="fullname" 
                            value="<?= $fullname ?>">
                            <i class="fa fa-user fa-lg fa-fw" aria-hidden="true"
                            style="margin-top:2px"></i>
                          </div>
                        </div>

                        <div class="box">
                          <div class="inputWithIcon inputIconBg"> 
                            <input type="text" name="age" value="<?= $age ?>">
                            <i class="fa fa-sort-amount-desc fa-lg fa-fw" aria-hidden="true" style="margin-top:2px"></i>
                          </div>
                        </div>

                        <div class="title"><h4>CONTACTS</h4></div>

                        <div class="box_one">
                          <div class="inputWithIcon inputIconBg">
                            <input type="text" name="phone" value="<?= $phone ?>">
                            <i class="fa fa-phone fa-lg fa-fw" 
                            aria-hidden="true"></i>
                          </div>
                        </div>

                        <div class="box_one">
                          <div class="inputWithIcon inputIconBg">
                            <input type="text" name="alt_phone" 
                            value="<?= $alt_phone ?>">
                            <i class="fa fa-phone fa-lg fa-fw" 
                            aria-hidden="true"></i>
                          </div>
                        </div>

                        <div class="box_one">
                          <div class="inputWithIcon inputIconBg">
                            <input type="text" name="email" value="<?= $email ?>">
                            <i class="fa fa-envelope-o fa-lg fa-fw" 
                            aria-hidden="true" style="margin-top:2px"></i>
                          </div>
                        </div>

                        <div class="box_one">
                          <div class="inputWithIcon inputIconBg">
                            <input type="text" name="p_box" value="<?= $p_box ?>">
                            <i class="fa fa-folder-o fa-lg fa-fw" 
                            aria-hidden="true"></i>
                          </div>
                        </div>

                        <div class="title"><h4>APPLICANT</h4></div>

                        <div class="box_two">
                          <div class="inputWithIcon inputIconBg">
                            <input type="text" name="study" value="<?= $study ?>">
                            <i class="fa fa-file-text-o fa-lg fa-fw" 
                            aria-hidden="true"></i>
                          </div>
                        </div>

                        <div class="box_two">
                          <div class="inputWithIcon inputIconBg">
                            <input type="text" name="interested" 
                            value="<?= $interested ?>">
                            <i class="fa fa-gears fa-lg fa-fw" 
                            aria-hidden="true"></i>
                          </div>
                        </div>

                        <div class="box_two">
                          <div class="inputWithIcon inputIconBg">
                            <input type="text" name="xp" value="<?= $xp ?>">
                            <i class="fa fa-bar-chart-o fa-lg fa-fw" 
                            aria-hidden="true"
                            style="margin-top:2px"></i>
                          </div>
                        </div>

                        <div class="finalise">
                          <input type="submit" class="form-control submit" 
                          name="change" value="update"> 
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>

            <?php
              if(isset($_POST['change']))
              {     
                $oldimage   = $_POST['oldimage'];
                $token      = $_POST['token'];
                $prof_title = $_POST['prof_title'];
                $fullname   = $_POST['fullname'];
                $age        = $_POST['age'];
                $phone      = $_POST['phone'];
                $alt_phone  = $_POST['alt_phone'];
                $p_box      = $_POST['p_box'];
                $study      = $_POST['study'];
                $interested = $_POST['interested'];
                $xp         = $_POST['xp'];

                /******************************************/
                $file        =  $_FILES['avatar'];
                $fileName    =  $_FILES['avatar']['name'];
                $fileTmpName =  $_FILES['avatar']['tmp_name'];
                $fileSize    =  $_FILES['avatar']['size'];
                $fileError   =  $_FILES['avatar']['error'];
                $fileType    =  $_FILES['avatar']['type'];
  
                $fileExt       =  explode('.', $fileName);
                $fileActualExt =  strtolower(end($fileExt));
  
                $allowed = array('jpg', 'jpeg', 'png', 'jfif');
    
                if(in_array($fileActualExt, $allowed)) 
                {
                  if($fileError === 0) 
                  {
                    if($fileSize < 10000000) 
                    { 
                      $fileNameNew = uniqid('', true).".".$fileActualExt;
                      $fileDestination = 'canprofile/'.$fileNameNew;
                      unlink($oldimage);
                      move_uploaded_file($fileTmpName, $fileDestination);
                    }
                    else { 
                      echo "<script>alert('Your Profile Photo is too big. Please choose another one')</script>";
                      echo "<script>window.open('mycan_profile.php?profile%error', '_self')</script>";
                      exit();
                    }
                  }
                  else {
                    echo "<script>alert('There was an error with your profile photo')</script>";
                    echo "<script>window.open('mycan_profile.php?profile%error', '_self')</script>";
                    exit();
                  }
                }

                $sqlupdt = "UPDATE canprofile SET photo='$fileDestination',
                prof_title='$prof_title',fullname='$fullname',age='$age',
                phone='$phone',alt_phone='$alt_phone',p_box='$p_box',
                study='$study',interested='$interested',xp='$xp',token='$token'
                WHERE token='$token' ";

                $resupdt = mysqli_query($con, $sqlupdt);

                if ($resupdt) {
                  $newUser    = $_GET["token"];
                  $getNewUser = "SELECT * FROM canprofile WHERE token='$newUser'";
                  $resNewUser = mysqli_query($con, $getNewUser);

                  if(mysqli_num_rows($resNewUser) == False) { 
                    // leave blank
                  }
                  else {
                    $main      = mysqli_fetch_assoc($resNewUser); 
                    $mainPhoto = $main['photo']; 
                    $mainAge   = $main['age'];
                    $mainXp    = $main['xp'];
                    $mainPhone = $main['phone'];
                  }

                  $forJob = $_SESSION['user_email'];
                  $resJob = "SELECT * FROM canapplyjob WHERE can_email='$forJob'";
                  $runJob = mysqli_query($con, $resJob);

                  if(mysqli_num_rows($runJob) == False) { 
                    // leave blank
                  }
                  else {
                    $sub      = mysqli_fetch_assoc($runJob);
                    $oldPhoto = $sub['photo']; 
                    $oldAge   = $sub['can_age'];
                    $oldXp    = $sub['can_xp'];
                    $oldPhone = $sub['can_phone']; 

                    if($mainPhoto == $oldPhoto && $mainAge == $oldAge && 
                    $mainXp == $oldXp && $mainPhone == $oldPhone) {
                      // leave blank
                    }
                    else {
                      $userUnify = $_SESSION['user_email'];
                      $getUnify  = "SELECT * FROM canapplyjob WHERE 
                      can_email='$userUnify'";
                      $runUnify  = mysqli_query($con, $getUnify);

                      // assign parent names with new names 
                      $newphoto = $mainPhoto;
                      $newage   = $mainAge;
                      $newxp    = $mainXp;
                      $newphone = $mainPhone;

                      // updating child directory with new names
                      $update = "UPDATE canapplyjob SET photo='$newphoto',
                      can_age='$newage',can_xp='$newxp',can_phone='$newphone' 
                      WHERE can_email='$userUnify'";
                      $run_update = mysqli_query($con, $update);

                      echo "<script>alert('Thank you for updating your Profile form. In this case if you haven't selected a new photo you will need to select the old one again')</script>";
                      echo "<script>window.open('mycan_profile.php', '_self')</script>";
                      exit();
                    }
                  }
                }
                else {
                  echo "<script>alert('Unable to update your Profile form. Please check your inputs and try again')</script>";
                  echo "<script>window.open('mycan_profile.php', '_self')</script>";
                  exit();
                }     
              }
            ?>
            <!-- [ blueprint ] -->
          </div>
        </div>
      </section>
      
    </body>
  </html>
<?php } ?>
