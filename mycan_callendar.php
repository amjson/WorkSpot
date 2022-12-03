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
      <meta name="keywords" content="WorkSpot">
      <meta name="authour" content="Joeson Misiani">
      <title>Work Spot</title>

      <!--***** Core CSS Files *****-->
      <link rel="stylesheet" href="MyCustom/bootstrap/css/bootstrap.min.css">
      <link href="MyCustom/css/ui-lightness/jquery-ui.css" rel="stylesheet">
      <link href="MyCustom/css/fullcalendar.css" rel="stylesheet">
      <link href="MyCustom/css/style.css" rel="stylesheet"> 

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
      .top_boxThree {
        border: 1px solid transparent;
        box-shadow: 6px 6px 8px 0 rgba(0,0,0,.3);
        background-color: dodgerblue;
        border-radius: 3px;
        width: 120px;
        height: 60px;
        line-height: 60px;
        margin-top: -536px;
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
        width: 518px;
        height: 505px;
        margin-top: -6px;
        margin-left: 0px;
      }
      .calendar_box {
        margin-top: 40px;
      }
      .top_boxFour {
        border: 1px solid transparent;
        box-shadow: 6px 6px 8px 0 rgba(0,0,0,.3);
        background-color: dodgerblue;
        border-radius: 3px;
        width: 120px;
        height: 60px;
        line-height: 60px;
        margin-top: -540px;
        margin-left: 10px;
        color: #fff;
        font-family: Bookman Old Style;
        font-size: 20px;
        text-align: center;
      }
      .boxFour {
        border: 1px solid transparent;
        box-shadow: 0px 0px 5px 1px rgba(0,0,0,.3);
        border-radius: 2px;
        background-color: #fff;
        width: 300px;
        height: 510px;
        margin-top: 0px;
        margin-left: 0px;
      }
      .clock {
        position: relative;
        width: 285px;
        height: 285px;
        border-radius: 50%;
        border: none;
        background-color: transparent;
        overflow: hidden;
        margin-top: 70px;
        margin-left: 6px;
      }
      .clock:after {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
      }
      .clock:before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 20px;
        height: 20px;
        background-color: black;
        border-radius: 50%;
        transform: translate(-50%, -50%);
      }
      .num {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        text-align: center;
        font-size: 2rem;
        font-weight: 700;
        padding: 11px;
      }
      .num:after {
        content: '';
        position: absolute;
        top: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 5px;
        height: 15px;
        background-color: black;
      }
      .num1 { transform: rotate(30deg); }
      .num1 div { transform: rotate(-30deg); }
      .num2 { transform: rotate(60deg); }
      .num2 div { transform: rotate(-60deg); }
      .num3 { transform: rotate(90deg); }
      .num3 div { transform: rotate(-90deg); }
      .num4 { transform: rotate(120deg); }
      .num4 div { transform: rotate(-120deg); }
      .num5 { transform: rotate(150deg); }
      .num5 div { transform: rotate(-150deg); }
      .num6 { transform: rotate(180deg); }
      .num6 div { transform: rotate(-180deg); }
      .num7 { transform: rotate(210deg); }
      .num7 div { transform: rotate(-210deg); }
      .num8 { transform: rotate(240deg); }
      .num8 div { transform: rotate(-240deg); }
      .num9 { transform: rotate(270deg); }
      .num9 div { transform: rotate(-270deg); }
      .num10 { transform: rotate(300deg); }
      .num10 div { transform: rotate(-300deg); }
      .num11 { transform: rotate(330deg); }
      .num11 div { transform: rotate(-330deg); }
      .hand {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
      }
      .hand div {
        position: absolute;
        bottom: 50%;
        left: 50%;
        transform: translateX(-50%);
        background-color: #000;
      }
      .sec {
        width: 1px;
        height: 40%;
      }
      .min {
        width: 4px;
        height: 38%;
        border-radius: 2px;
      }
      .hour {
        width: 8px;
        height: 28%;
        border-radius: 4px;
      }
      .bottom_boxFour {
        border: none;
        border-top: 1px solid #aaa;
        box-sizing: border-box;
        width: 270px;
        height: 50px;
        margin-top: 370px;
        margin-left: 15px;
        outline: none;
        color: rgba(0,0,0,.8);
        background: transparent;
        font-family: Bookman Old Style;
        font-size: 30px;
        padding-top: 26px;
        text-align: center;
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
            <div style="border:1px solid transparent;width:520px;height:512px;
            margin-top:50px;margin-left:90px;padding-top:10px;">
              <div class="boxThree">
                <div class="box calendar_box">
                  <div class="header"><h4 style="height:40px;"></h4></div>
                  <div class="content"> 
                      <div id="calendar"></div>
                  </div> 
                </div>
              </div>
              <div class="top_boxThree">Calendar</div>
            </div>

            <div style="border:1px solid transparent;width:302px;height:512px;
            margin-top:-512px;margin-right:100px;float:right;">
              <div class="boxFour">
                <div class="clock">
                  <div class="num num1"><div>1</div></div>
                  <div class="num num2"><div>2</div></div>
                  <div class="num num3"><div>3</div></div>
                  <div class="num num4"><div>4</div></div>
                  <div class="num num5"><div>5</div></div>
                  <div class="num num6"><div>6</div></div>
                  <div class="num num7"><div>7</div></div>
                  <div class="num num8"><div>8</div></div>
                  <div class="num num9"><div>9</div></div>
                  <div class="num num10"><div>10</div></div>
                  <div class="num num11"><div>11</div></div>
                  <div class="num num12"><div>12</div></div>
                  <div class="hand" id="sec"><div class="sec"></div></div>
                  <div class="hand" id="min"><div class="min"></div></div>
                  <div class="hand" id="hour"><div class="hour"></div></div>
                </div>
              </div>
              <div class="top_boxFour">Clock</div>
              <div id="MyClockDisplay" class="bottom_boxFour"></div>
            </div>
            <!-- [ blueprint ] -->
          </div>
        </div>
      </section>

      <!--============ javascript Files ============-->
      <script src="MyCustom/js/analog_clock.js"></script>
      <script src="MyCustom/js/digital_clock.js"></script>
      <script src="MyCustom/js/bootstrap-material-design.min.js"></script>
      <script src="MyCustom/js/bootstrap.min.js"></script>
      <script src="MyCustom/js/bootstrap.js"></script>
      <script src="MyCustom/js/jquery.js"></script>
      <script src="MyCustom/js/jquery.min.js"></script>
      <script src="MyCustom/js/jquery-ui.js"></script>
      <script src="MyCustom/js/jquery.calendar.js"></script>
      <script src="MyCustom/js/fullcalendar.js"></script>
      <script src="MyCustom/js/gcal.js"></script>
      <script src="MyCustom/js/custom.js"></script>
      <script src="switcher.js"></script>    
      
      <!-- call calendar plugin -->
      <script type="text/javascript">
        $().FullCalendarExt({calendarSelector: '#calendar'});
      </script>
    </body>
  </html>
<?php } ?>
