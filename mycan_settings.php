<!DOCTYPE html>
<?php
  session_start();
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
      .job_cover {
        border: 1px solid transparent;
        position: absolute;
        width: 82%;
        height: 587px;
        margin-top: 0px;
        margin-left: -1px;
      }
      /*[ blueprint ]*/
      .top_boxOne {
        border: 1px solid transparent;
        box-shadow: 6px 6px 8px 0 rgba(0,0,0,.3);
        background-color: dodgerblue;
        border-radius: 3px;
        width: 120px;
        height: 60px;
        line-height: 60px;
        margin-top: -460px;
        margin-left: 10px;
        color: #fff;
        font-family: Bookman Old Style;
        font-size: 20px;
        text-align: center;
      }
      .boxOne {
        border: 1px solid transparent;
        box-shadow: 0px 0px 5px 1px rgba(0,0,0,.3);
        border-radius: 2px;
        background-color: #fff;
        width: 498px;
        height: 433px;
        margin-top: 0px;
        margin-left: 0px;
      }
      #form {
        border: 1px solid transparent;
        background-color: transparent;
        width: 100%;
        margin-top: 30px;
        margin-left: 0px;
        padding-top: 15px;
        padding-left: 10px;
        padding-right: 10px;
      }
      .job_body {
        border: 1px solid transparent;
      }
      .box {
        width: 100%;
        height: 52px;
        border: 1px solid transparent;
        background-color: transparent;
        padding-left: 10px;
      }
      .job_body input {
        border: none;
        border-bottom: 1px solid #aaa;
        box-sizing: border-box;
        width: 95%;
        margin-top: 17px;
        padding-bottom: 4px;
        outline: none;
        color: rgba(0,0,0,.7);
        background: transparent;
        font-family: Bahnschrift;
        font-size: 16px;
      }
      .inputWithIcon {
        position: relative;
      }
      .inputWithIcon input {
        padding-left: 40px;
      }
      .inputWithIcon i {
        position: absolute;
        top: 8px;
        left: 0;
        padding-top: 0px;
        padding-left: 8px;
        padding-bottom: 9px;
        padding-right: 8px;
        font-size: 17px;
      }
      .inputWithIcon.inputIconBg i {
        background-color: transparent;
        color: rgba(0,0,0,.7);
        padding-top: 11px;
        padding-left: 5px;
        padding-bottom: 10px;
        padding-right: 25px;
        border-radius: 5px 0 0 5px;
      }
      .finalise {
        width: 95%;
        height: 50px;
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
        height: 33px;
        width: 20%;
        margin-top: 10px;
        padding-top: 3px;
      }
      .finalise .submit:hover {
        cursor: pointer;
        background: dodgerblue;
        opacity: .8;
      }
      .top_boxTwo {
        border: 1px solid transparent;
        box-shadow: 6px 6px 8px 0 rgba(0,0,0,.3);
        background-color: dodgerblue;
        border-radius: 3px;
        width: 120px;
        height: 60px;
        line-height: 60px;
        margin-top: -190px;
        margin-left: 10px;
        color: #fff;
        font-family: Bookman Old Style;
        font-size: 20px;
        text-align: center;
      }
      .boxTwo {
        border: 1px solid transparent;
        box-shadow: 0px 0px 5px 1px rgba(0,0,0,.3);
        border-radius: 2px;
        background-color: #fff;
        width: 398px;
        height: 163px;
        margin-top: 0px;
        margin-left: 0px;
      }
      .cardphoto {
        width: 70px;
        height: 70px;
        border: 1px solid transparent;
        margin-top: 40px;
        margin-left: 25px;
        margin-bottom: 8px;
      }
      .cardphoto img {
        width: 100%;
        height: 100%;
        border-radius: 50%;
      }
      .cardname {
        width: 165px;
        height: 25px;
        line-height: 25px;
        border: 1px solid transparent;
        text-align: left;
        margin-top: -70px;
        margin-left: 120px;
        padding-left: 8px;
        color: rgba(0,0,0,.8);
        letter-spacing: 0px;
        font-family: Bookman Old Style;
        font-size: 20px;
      }
      .cardcompany {
        width: 165px;
        height: 25px;
        line-height: 25px;
        border: 1px solid transparent;
        text-align: left;
        margin-top: 5px;
        margin-left: 120px;
        padding-left: 8px;
        color: rgba(0,0,0,.8);
        letter-spacing: 0px;
        font-family: Bookman Old Style;
        font-size: 20px;
      }
      #forImg{
        border: 1px solid transparent;
        height: 36px;
        margin-top: 16px;
        padding-left: 10px;
      }
      label {
        border-color: transparent;
        font-size: 16px;
        letter-spacing: 1px;
        height: 34px;
        width: 130px;
        margin-top: 0px;
        font-family: Book Antiqua;
        padding-top: 5px;
        margin-right: 20px;
      }
      #update_profile {
        text-align: center;
        cursor: pointer;
        border-radius: 3px;
        border: none;
        background-color: rgba(0,0,0,.7);
        color: #fff;
        float: left;
      }
      input[type="file"] {
        display: none;
      }
      #forImg .push {
        width: 84px;
        height: 34px;
        border: 1px solid transparent;
        background-color: transparent;margin-left: 150px;
      }
      #forImg .push .submit {
        background: dodgerblue;
        border-color: transparent;
        border-radius: 3px;
        color: #fff;
        font-size: 16px;
        letter-spacing: 2px;
        height: 32px;
        width: 82px;
        margin-top: -1px;
        padding-top: 4px;
      }
      #forImg .push .submit:hover {
        cursor: pointer;
        background: dodgerblue;
        opacity: .8;
      }
      .top_boxThree {
        border: 1px solid transparent;
        box-shadow: 6px 6px 8px 0 rgba(0,0,0,.3);
        background-color: dodgerblue;
        border-radius: 3px;
        width: 120px;
        height: 60px;
        line-height: 60px;
        margin-top: -245px;
        margin-left: 10px;
        color: #fff;
        font-family: Bookman Old Style;
        font-size: 20px;
        text-align: center;
      }
      .boxThree {
        border: 1px solid transparent;
        box-shadow: 0px 0px 5px 1px rgba(0,0,0,.3);
        border-radius: 2px;
        background-color: #fff;
        width: 398px;
        height: 218px;
        margin-top: 0px;
        margin-left: 0px;
        padding-top: 10px;
      }
      #forPwd {
        border: 1px solid transparent;
        background-color: transparent;
        width: 100%;
        margin-top: 20px;
        margin-left: 0px;
        padding-top: 0px;
        padding-left: 10px;
        padding-right: 10px;
      }
      #forPwd .job_body {
        border: 1px solid transparent;
      }
      #forPwd .box {
        width: 100%;
        height: 43px;
        border: 1px solid transparent;
        background-color: transparent;
        padding-left: 10px;
      }
      #forPwd .job_body input {
        border: none;
        border-bottom: 1px solid #aaa;
        box-sizing: border-box;
        width: 95%;
        margin-top: 13px;
        outline: none;
        color: rgba(0,0,0,.7);
        background: transparent;
        font-family: Bahnschrift;
        font-size: 16px;
      }
      #forPwd .inputWithIcon {
        position: relative;
      }
      #forPwd .inputWithIcon input {
        padding-left: 40px;
      }
      #forPwd .inputWithIcon i {
        position: absolute;
        top: 8px;
        left: 0;
        padding-top: 0px;
        padding-left: 8px;
        padding-bottom: 9px;
        padding-right: 8px;
        font-size: 17px;
      }
      #forPwd .inputWithIcon.inputIconBg i {
        background-color: transparent;
        color: rgba(0,0,0,.7);
        padding-top: 6px;
        padding-left: 8px;
        padding-bottom: 10px;
        padding-right: 25px;
        border-radius: 5px 0 0 5px;
      }
      #forPwd .finalise {
        width: 95%;
        height: 51px;
        border: 1px solid transparent;
        background-color: transparent;
        padding-left: 10px;
      }
      #forPwd .finalise .submit {
        background: dodgerblue;
        border-color: transparent;
        border-radius: 3px;
        color: #fff;
        font-size: 16px;
        letter-spacing: 2px;
        height: 32px;
        width: 82px;
        margin-top: 10px;
        padding-top: 4px;
      }
      #forPwd .finalise .submit:hover {
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
            <div class="job_cover">
              <!-- [ blueprint ] -->
              <?php
                $user     = $_SESSION['user_email'];
                $get_user = "SELECT * FROM candidate WHERE user_email='$user'";
                $run_user = mysqli_query($con, $get_user);
                $row      = mysqli_fetch_array($run_user);

                $user_firstname  = $row['user_firstname'];
                $user_lastname   = $row['user_lastname'];
                $user_name       = $row['user_name'];
                $user_phone      = $row['user_phonenumber'];
                $user_email      = $row['user_email'];
                $user_proffesion = $row['user_proffesion'];
                $user_profile    = $row['user_profile'];
              ?>

              <div style="border:1px solid transparent;width:500px;height:435px;
              margin-top:86px;margin-left:70px;">
                <?php
                  if (isset($_POST['all'])) {
                    $first      = htmlentities($_POST['f_name']);
                    $last       = htmlentities($_POST['l_name']);
                    $user_name  = htmlentities($_POST['u_name']);
                    $phone      = htmlentities($_POST['phone']);
                    $email      = htmlentities($_POST['email']);
                    $proffesion = htmlentities($_POST['proffesion']);

                    $update = "UPDATE candidate SET user_firstname='$first',
                    user_lastname='$last',user_name='$user_name', 
                    user_phonenumber='$phone', user_email='$email', 
                    user_proffesion='$proffesion' WHERE user_email='$user'";
                    $runSuccessful    = mysqli_query($con, $update);

                    /*=============== [ universal updater ] ===============*/
                    function universalUPDT() {
                      include ("includes/db.include.php");

                      $newUser    = $_GET["token"];
                      $getNewUser = "SELECT * FROM candidate WHERE token='$newUser'";
                      $resNewUser = mysqli_query($con, $getNewUser);

                      if(mysqli_num_rows($resNewUser) == False) { 
                        // leave blank
                      }
                      else {
                        $main     = mysqli_fetch_assoc($resNewUser); 
                        $mainMail = $main['user_email'];
                      }

                      $forProfile = $_GET["token"];
                      $resProfile = "SELECT * FROM canprofile WHERE token='$forProfile'";
                      $runProfile = mysqli_query($con, $resProfile);

                      if(mysqli_num_rows($runProfile) == False) { 
                        // leave blank
                      }
                      else {
                        $sub      = mysqli_fetch_assoc($runProfile); 
                        $oldEmail = $sub['email']; 

                        if($mainMail == $oldEmail) {
                          // leave blank
                        }
                        else {
                          $mytoken  = $_GET["token"];
                          $resToken = "SELECT * FROM canprofile WHERE token='$mytoken'";
                          $tokenSQL = mysqli_query($con, $resToken);

                          // assign parent names with new names 
                          $newMail = $mainMail;

                          // updating child directory with new names
                          $update  ="UPDATE canprofile SET email='$newMail' 
                          WHERE token='$mytoken'";
                          $runUPDT = mysqli_query($con, $update);

                          $newUserTwo   =$_GET["token"];
                          $getNewUserTwo="SELECT * FROM candidate WHERE token='$newUserTwo'";
                          $resNewUserTwo=mysqli_query($con, $getNewUserTwo);

                          if(mysqli_num_rows($resNewUserTwo) == False) { 
                            // leave blank
                          }
                          else {
                            $mainTwo     = mysqli_fetch_assoc($resNewUserTwo); 
                            $mainMailTwo = $mainTwo['user_email'];
                          }

                          $forJob = $_GET["token"];
                          $resJob = "SELECT * FROM canapplyjob WHERE can_token='$forJob'";
                          $runJob = mysqli_query($con, $resJob);

                          if(mysqli_num_rows($runJob) == False) { 
                            // leave blank
                          }
                          else {
                            $subTwo      = mysqli_fetch_assoc($runJob); 
                            $oldEmailTwo = $subTwo['can_email']; 

                            if($mainMailTwo == $oldEmailTwo) {
                              // leave blank
                            }
                            else {
                              $mytokenTwo  = $_GET["token"];
                              $resTokenTwo = "SELECT * FROM canapplyjob WHERE 
                              can_token='$mytokenTwo'";
                              $tokenSQLTwo = mysqli_query($con, $resTokenTwo);

                              // assign parent names with new names 
                              $newMailTwo = $mainMailTwo;

                              // updating child directory with new names
                              $updateTwo ="UPDATE canapplyjob SET can_email='$newMailTwo' 
                              WHERE can_token='$mytokenTwo'";
                              $runUPDTTwo = mysqli_query($con, $updateTwo);

                            }
                          }
                        }
                      }
                    } 

                    if ($runSuccessful) {
                      // apply the universal updater
                      universalUPDT();

                      // updating the status
                      $Offline = "UPDATE candidate SET log_in='Offline' WHERE user_email='$email' ";
                      $update_msg = mysqli_query($con, $Offline);

                      echo "<script>window.open('includes/logout.include.php', '_self')</script>";
                    }

                  }
                ?>

                <div class="boxOne">
                  <form action="" method="post" autocomplete="off" id="form">
                    <div class="job_body">
                      <div class="box">
                        <div class="inputWithIcon inputIconBg"> 
                          <input type="text" name="f_name"  
                          value="<?php echo $user_firstname ?>">
                          <i class="fa fa-user fa-lg fa-fw" aria-hidden="true"
                          style="margin-top:2px"></i>
                        </div>
                      </div>

                      <div class="box">
                        <div class="inputWithIcon inputIconBg"> 
                          <input type="text" name="l_name"  
                          value="<?php echo $user_lastname ?>">
                          <i class="fa fa-user fa-lg fa-fw" aria-hidden="true"
                          style="margin-top:2px"></i>
                        </div>
                      </div>

                      <div class="box">
                        <div class="inputWithIcon inputIconBg">
                          <input type="text" name="u_name" 
                          value="<?php echo $user_name ?>">
                          <i class="fa fa-address-book fa-lg fa-fw" aria-hidden="true"
                          style="margin-top:2px"></i>
                        </div>
                      </div>

                      <div class="box">
                        <div class="inputWithIcon inputIconBg">
                          <input type="text" name="phone" 
                          value="<?php echo '0'.$user_phone ?>">
                          <i class="fa fa-phone fa-lg fa-fw" aria-hidden="true"></i>
                        </div>
                      </div>

                      <div class="box">
                        <div class="inputWithIcon inputIconBg">
                          <input type="text" name="email" 
                          value="<?php echo $user_email ?>">
                          <i class="fa fa-envelope-o fa-lg fa-fw" aria-hidden="true"
                          style="margin-top:2px"></i>
                        </div>
                      </div>

                      <div class="box">
                        <div class="inputWithIcon inputIconBg">
                          <input type="text" name="proffesion" 
                          value="<?php echo $user_proffesion ?>">
                          <i class="fa fa-map-marker fa-lg fa-fw" aria-hidden="true"
                          style="margin-top:2px"></i>
                        </div>
                      </div>

                      <div class="finalise">
                        <input type="submit" class="form-control submit" 
                        name="all" value="update">  
                      </div>
                    </div>
                  </form>
                </div>
                <div class="top_boxOne">Account</div>
              </div>

              <div style="border:1px solid transparent;width:400px;height:165px;
              margin-top:-435px;margin-right:70px;float:right;">
                <?php 
                  if(isset($_POST['profilepic'])) {
                    $file = $_FILES['u_image'];
          
                    $fileName    =  $_FILES['u_image']['name'];
                    $fileTmpName =  $_FILES['u_image']['tmp_name'];
                    $fileSize    =  $_FILES['u_image']['size'];
                    $fileError   =  $_FILES['u_image']['error'];
                    $fileType    =  $_FILES['u_image']['type'];
                  
                    $fileExt       =  explode('.', $fileName);
                    $fileActualExt =  strtolower(end($fileExt));
                  
                    $allowed = array('jpg', 'jpeg', 'png', 'jfif');
      
                    if(in_array($fileActualExt, $allowed)) {
                      if($fileError === 0) {
                        if($fileSize < 10000000) {
                          $fileNameNew = uniqid('', true).".".$fileActualExt;
                          $fileDestination = 'JobSite-Profiles/'.$fileNameNew;
                          unlink($user_profile);
                          move_uploaded_file($fileTmpName, $fileDestination);

                          $update = "UPDATE candidate SET user_profile=
                          '$fileDestination' WHERE user_email='$user'";
                          $run    = mysqli_query($con, $update);

                          if ($run) {
                            echo "<script>alert('Your Profile Updated successfully')</script>";
                            echo "<script>window.open('mycan_settings.php?token=$token', '_self')</script>";
                            exit();
                          }
                        }
                        else {
                          echo "<script>alert('Your file is too big')</script>";
                          echo "<script>window.open('mycan_settings.php?token=$token', '_self')</script>";
                          exit();
                        }
                      }
                      else {
                        echo "<script>alert('There was an error uploading your file')</script>";
                        echo "<script>window.open('mycan_settings.php?token=$token', '_self')</script>";
                        exit();
                      }
                    }
                    else {
                      echo "<script>alert('You cannot upload files of this type')</script>";
                      echo "<script>window.open('mycan_settings.php?token=$token', '_self')</script>";
                      exit();
                    }
                  }
                ?>

                <div class="boxTwo">
                  <div class='cardphoto'><img src='<?php echo $user_profile;?>'></div>
                  <div class='cardname'>
                    <?php echo $user_firstname.' '.$user_lastname; ?></div>
                  <div class='cardcompany'>
                    <?php echo $user_proffesion; ?>
                  </div>

                  <form action="" method='post' enctype='multipart/form-data' id="forImg">
                    <label id='update_profile'>
                      select profile
                      <input type='file' name='u_image' size='60'>
                    </label>

                    <div class="push">
                      <input type="submit" class="form-control submit" 
                      name="profilepic" value="update">  
                    </div>
                  </form>
                </div>
                <div class="top_boxTwo">Photo</div>
              </div>

              <div style="border:1px solid transparent;width:400px;height:220px;
              margin-top:-220px;margin-right:70px;float:right;">
                <?php 
                  if(isset($_POST['forpassword'])) {
                    include("includes/db.include.php");

                    $c_pass = htmlentities($_POST['user_pass']);
                    $pass1  = htmlentities($_POST['u_pass1']);
                    $pass2  = htmlentities($_POST['u_pass2']);

                    if(empty($c_pass) || empty($pass1) || empty($pass2)) {
                      echo "<script>alert('Please complete the form')</script>";
                      echo "<script>window.open('mycan_settings.php?token=$token', '_self')</script>";
                      exit();
                    } 
                    else {
                      $password_hash = $row['user_pass'];
                  
                      if(password_verify($c_pass, $password_hash)) {
                        if ($pass1 === $pass2) {
                          if(strlen($pass1) > 9) {
                            $user_recovery = $row['user_name'];

                            $encript_pwd = password_hash($pass1, PASSWORD_BCRYPT);
                            $update_pass = "UPDATE candidate SET user_pass=
                            '$encript_pwd' WHERE user_name='$user_recovery'";
                            $run_pass    = mysqli_query($con, $update_pass);

                            if ($run_pass) {
                              $Offline = "UPDATE candidate SET log_in='Offline' WHERE 
                              user_name='".$user_recovery."' ";
                              $update_msg = mysqli_query($con, $Offline);
                              echo "<script>window.open('includes/logout.include.php', '_self')</script>";
                            }
                          }
                          else {
                            echo "<script>alert('Password should be of 9 character atleast')</script>";
                            echo "<script>window.open('mycan_settings.php?token=$token', '_self')</script>";
                            exit();
                          }
                        }
                        else {
                          echo "<script>alert('Password do not match')</script>";
                          echo "<script>window.open('mycan_settings.php?token=$token', '_self')</script>";
                          exit();
                        }
                      }
                      else {
                        echo "<script>alert('Invalid Password')</script>";
                        echo "<script>window.open('mycan_settings.php?token=$token', '_self')</script>";
                        exit();
                      }
                    }
                  }
                ?>

                <div class="boxThree">
                  <form action="" method="post" id="forPwd">
                    <div class="job_body">
                      <div class="box">
                        <div class="inputWithIcon inputIconBg"> 
                          <input type="password" name="user_pass" 
                          placeholder="Current Password">
                          <i class="fa fa-lock fa-lg fa-fw" aria-hidden="true"
                          style="margin-top:2px"></i>
                        </div>
                      </div>

                      <div class="box">
                        <div class="inputWithIcon inputIconBg"> 
                          <input type="password" name="u_pass1" 
                          placeholder="New Password">
                          <i class="fa fa-lock fa-lg fa-fw" aria-hidden="true"
                          style="margin-top:2px"></i>
                        </div>
                      </div>

                      <div class="box">
                        <div class="inputWithIcon inputIconBg">
                          <input type="password" name="u_pass2" 
                          placeholder="Confirm Password">
                          <i class="fa fa-lock fa-lg fa-fw" aria-hidden="true"
                          style="margin-top:2px"></i>
                        </div>
                      </div>

                      <div class="finalise">
                        <input type="submit" class="form-control submit" 
                        name="forpassword" value="change">  
                      </div>
                    </div>
                  </form>
                </div>
                <div class="top_boxThree">Password</div>
              </div>
              <!-- [ blueprint ] -->
            </div>
          </div>
        </div>
      </section>

    </body>
  </html>
<?php } ?>
