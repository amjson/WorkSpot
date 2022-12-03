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
      /*[ blueprint ]*/
      .job_page {
        border: 1px solid transparent;
        box-shadow: 0px 0px 5px 1px rgba(0,0,0,.3);
        background-color: #fff;
        width: 60%;
        height: 525px;
        margin-top: 30px;
        margin-left: 220px;
      }
      .raw {
        color:rgba(0,0,0,.7);
        font-family:Bahnschrift;
        font-size:16px;
      }
      .raw td i {
        font-size:15px;
      }
      #form {
        border: 1px solid transparent;
        background-color: transparent;
        width: 100%;
        height: 400px;
      }
      .job_header {
        margin-top: -400px;
        border: 1px solid transparent;
        height: 74px;
      }
      .comp_photo {
        border: 1px solid transparent;
        width: 60%;
        height: 72px;
        float: left;
      }
      .comp_photo div {
        width: 70px;
        height: 70px;
        border:1px solid transparent;
        border-radius: 50%;
        float: left;
      }
      .comp_photo div img {
        width: 105%;
        height: 105%;
        margin-top: -1px;
        margin-left: -1px;
        border-radius: 50%;
      }
      .comp_photo h6 {
        border: 1px solid transparent;
        margin-top: 0px;
        width: 78%;
        height: 70px; 
        float: left;
      }
      .comp_photo h6 input {
        border: none;
        font-family: Bahnschrift;
        font-size: 16px;
        color: rgba(0,0,0,.8);
        margin-top: -5px;
        padding-top: 4px;
        padding-left: 20px;
        padding-bottom: 8px;
        height: 22px;
        width: 100%;
        letter-spacing: 1px;
        box-sizing: border-box;
        outline: none;
        background: transparent;
      }
      .job_body {
        border: 1px solid transparent;
        height: 356px;
        margin-top: 0px;
      }
      .left {
        float: left;
        width: 50%;
        height: 70px;
        border: 1px solid transparent;
        background-color: transparent;
        padding-left: 10px;
      }
      .right {
        float: right;
        width: 50%;
        height: 70px;
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
        margin-top: 15px;
        padding-bottom: 26px;
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
              <?php
                include ("includes/db.include.php");
                $showRecordPerPage = 5;
                
                if(isset($_GET['page']) && !empty($_GET['page'])) {
                  $currentPage = $_GET['page'];
                }
                else {
                  $currentPage = 1;
                }
                
                $startFrom   = ($currentPage * $showRecordPerPage) - $showRecordPerPage;
                $totalEmpSQL   = "SELECT * FROM empostjob";
                $allEmpResult  = mysqli_query($con, $totalEmpSQL);
                $totalEmployee = mysqli_num_rows($allEmpResult);
                $lastPage      = ceil($totalEmployee/$showRecordPerPage);

                $firstPage = 1;
                $nextPage = $currentPage + 1;
                $previousPage = $currentPage - 1;

                $getSQL = "SELECT id,photo,comp_name,location,email,phone,title,
                type,xp,ends,info,requirement,reg_token FROM empostjob LIMIT 
                $startFrom, $showRecordPerPage ";
                $runSQL = mysqli_query($con, $getSQL);
              ?>

              <table class="table"> 
                <tbody>
                  <?php
                    while($job = mysqli_fetch_array($runSQL)) { ?>

                    <tr class="raw"> 
                      <td>
                        <i class="fa fa-briefcase fa-lg fa-fw" 
                        aria-hidden="true"></i>
                        &nbsp&nbsp<?php echo $job['title'];?> <br>
                        <i class="fa fa-clock-o fa-lg fa-fw" aria-hidden="true" 
                        style="padding-top:10px;"></i>
                        &nbsp&nbsp<?php echo $job['type'];?>
                      </td>

                      <td>
                        <i class="fa fa-id-card fa-lg fa-fw" aria-hidden="true"></i>
                        &nbsp&nbsp<?php echo $job['xp'];?>
                      </td>

                      <td>
                        <i class="fa fa-map-marker fa-lg fa-fw" 
                        aria-hidden="true"></i>
                        &nbsp&nbsp<?php echo $job['location'];?> <br>
                        <i class="fa fa-phone fa-lg fa-fw" aria-hidden="true"
                        style="padding-top:10px;"></i>
                        &nbsp&nbsp<?php echo '0'.$job['phone'];?>    <br>
                        <i class="fa fa-envelope-o fa-lg fa-fw" aria-hidden="true"
                        style="padding-top:10px;"></i>
                        &nbsp&nbsp<?php echo $job['email'];?>
                      </td>

                      <td style="text-align:center;">
                        <a href="<?php echo $job['id'];?>" type="button" 
                        class="btn btn-success" data-toggle="modal" 
                        data-target="#select<?php echo $job['id'];?>"
                        style="margin-top:20px;">view</a>
                      </td>
                    </tr>

                    <div id="select<?php echo $job['id'];?>" class="modal fade" 
                    role="dialog">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">
                            &times;</button>
                            <h4 class="modal-title">View This Job</h4>
                          </div>

                          <div class="modal-body">
                            <form action="" method="POST" id="form" 
                            enctype="multipart/form-data" autocomplete="off">
                              <div class="job_header">
                                <div class="comp_photo">
                                  <div>
                                    <img src="<?php echo $job['photo'];?>">
                                  </div>

                                  <h6>
                                    <input value="<?php echo $job['comp_name'];?>" 
                                    style="margin-top:-3px;"> <br>
                                    <input value="<?php echo$job['location'];?>"><br>
                                    <input value="<?php echo$job['email'];?>"> <br>
                                    <input value="<?php echo '0'.$job['phone'];?>" 
                                    style="padding-top:10px;">
                                  </h6>
                                </div>
                              </div>

                              <div class="job_body">
                                <div class="left">
                                  <div class="inputWithIcon inputIconBg"> 
                                    <input value="<?php echo $job['title'];?>">
                                    <i class="fa fa-briefcase fa-lg fa-fw" 
                                    aria-hidden="true"></i>
                                  </div>
                                </div>

                                <div class="right">
                                  <div class="inputWithIcon inputIconBg">
                                    <input value="<?php echo $job['type'];?>">
                                    <i class="fa fa-clock-o fa-lg fa-fw" 
                                    aria-hidden="true"></i>
                                  </div>
                                </div>

                                <div class="left">
                                  <div class="inputWithIcon inputIconBg"> 
                                    <input value="<?php echo $job['xp'];?>">
                                    <i class="fa fa-id-card fa-lg fa-fw" 
                                    aria-hidden="true" style="margin-top:2px;"></i>
                                  </div>
                                </div>

                                <div class="right">
                                  <div class="inputWithIcon inputIconBg"> 
                                    <input value="Deadline is <?php echo $job['ends'];?>">
                                    <i class="fa fa-calendar fa-lg fa-fw" 
                                    aria-hidden="true"></i>
                                  </div>
                                </div>

                                <div class="tell">
                                  <textarea><?php echo $job['info'];?></textarea>
                                </div>

                                <div class="tell" style="margin-top:15px;">
                                  <textarea><?php echo $job['requirement'];?>
                                  </textarea>
                                </div>
                              </div>

                              <div class="finalise">
                                <a href="<?php echo $job['id'];?>" type="button" 
                                class="btn btn-primary form-control submit" data-toggle="modal" 
                                data-target="#apply<?php echo $job['id'];?>"
                                style="margin-top:20px;">Apply</a>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- [ fetching applicants info ] -->
                    <?php
                      $user        = $_SESSION['user_email'];
                      $get_profile = "SELECT * FROM canprofile WHERE email='$user'";
                      $run_profile = mysqli_query($con, $get_profile);
                      $row         = mysqli_fetch_array($run_profile);

                      $photo      = $row['photo'];
                      $prof_title = $row['prof_title'];
                      $fullname   = $row['fullname'];
                      $age        = $row['age'];
                      $phone      = $row['phone'];
                      $email      = $row['email'];
                      $gender     = $row['gender'];
                      $xp         = $row['xp'];
                      $study      = $row['study'];
                      $myTkn      = $row['token'];
                    ?>

                    <div id="apply<?php echo $job['id'];?>" class="modal fade" 
                    role="dialog">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">
                            &times;</button>
                            <h4 class="modal-title">Apply for this Job</h4>
                          </div>

                          <div class="modal-body">
                            <?php
                              if(isset($_POST['jobapplication'])) {
                                include ("includes/db.include.php");

                                $comp_name  = htmlentities(mysqli_real_escape_string($con, 
                                  $_POST['comp_name']));
                                $emp_mail   = htmlentities(mysqli_real_escape_string($con, 
                                  $_POST['emp_mail']));
                                $emp_phone  = htmlentities(mysqli_real_escape_string($con, 
                                  $_POST['emp_phone']));
                                $photo      = htmlentities(mysqli_real_escape_string($con, 
                                  $_POST['photo']));
                                $can_name   = htmlentities(mysqli_real_escape_string($con, 
                                  $_POST['can_name']));
                                $can_title  = htmlentities(mysqli_real_escape_string($con, 
                                  $_POST['can_title']));
                                $can_email  = htmlentities(mysqli_real_escape_string($con, 
                                  $_POST['can_email']));
                                $can_phone  = htmlentities(mysqli_real_escape_string($con, 
                                  $_POST['can_phone']));
                                $can_gender = htmlentities(mysqli_real_escape_string($con, 
                                  $_POST['can_gender']));
                                $can_age    = htmlentities(mysqli_real_escape_string($con, 
                                  $_POST['can_age']));
                                $can_xp     = htmlentities(mysqli_real_escape_string($con, 
                                  $_POST['can_xp']));
                                $can_study  = htmlentities(mysqli_real_escape_string($con, 
                                  $_POST['can_study']));
                                $about      = htmlentities(mysqli_real_escape_string($con, 
                                  $_POST['about']));
                                $emp_token  = $_POST['reg_token'];
                                $can_token  = $_POST['mytoken'];

                                if(empty($photo) || empty($can_name) || empty($can_title) ||
                                empty($can_email) || empty($can_phone) || empty($can_gender)
                                || empty($can_age) || empty($can_xp) || empty($can_study) ||
                                empty($about)) 
                                {
                                  echo "<script>alert('There was an error with your form submition. Confirm if you have completed your profile form else try again')</script>";
                                  echo "<script>window.open('mycan_vaccancy.php?token=$token', '_self')</script>";
                                  exit();
                                }
                                else {
                                  $sqlquery = "INSERT INTO canapplyjob(comp_name,emp_mail,
                                  emp_phone,emp_token,photo,can_name,can_title,can_email,
                                  can_phone,can_gender,can_age,can_xp,can_study,about,
                                  can_token,uploaded) VALUES('$comp_name','$emp_mail',
                                  '$emp_phone','$emp_token','$photo','$can_name',
                                  '$can_title','$can_email','$can_phone','$can_gender',
                                  '$can_age','$can_xp','$can_study','$about','$can_token',
                                  now())";

                                  $verifyquery = mysqli_query($con, $sqlquery);

                                  if ($verifyquery) 
                                  {
                                    echo "<script>alert('Your application form has been sent successfully')</script>";
                                    echo "<script>window.open('mycan_applications.php?token=$token', '_self')</script>";
                                    exit();
                                  }
                                } 
                              }
                            ?>

                            <form action="" method="POST" enctype="multipart/form-data"
                            id="form" autocomplete="off">
                              <div class="job_header">
                                <div class="comp_photo">
                                  <div>
                                    <img src="<?php echo $job['photo'];?>">
                                  </div>

                                  <h6>
                                    <input value="<?php echo $job['comp_name'];?>" 
                                    name="comp_name" style="margin-top:-3px;"><br>
                                    <input value="<?php echo$job['location'];?>"><br>
                                    <input value="<?php echo $job['email'];?>" 
                                    name="emp_mail"> <br>
                                    <input value="<?php echo '0'.$job['phone'];?>" 
                                    name="emp_phone" style="padding-top:10px;">
                                  </h6>
                                </div>

                                <input value="<?php echo $job['reg_token']; ?>"
                                name="reg_token" type="hidden">
                                <input value="<?php echo $myTkn; ?>"
                                name="mytoken" type="hidden">
                              </div>

                              <div class="job_body">
                                <input type="hidden" name="photo" 
                                value="<?php echo $photo; ?>">

                                <div class="left">
                                  <div class="inputWithIcon inputIconBg"> 
                                    <input name="can_name" type="text" 
                                    value="<?php echo $fullname;?>">
                                    <i class="fa fa-user fa-lg fa-fw" 
                                    aria-hidden="true"></i>
                                  </div>
                                </div>

                                <div class="right">
                                  <div class="inputWithIcon inputIconBg">
                                    <input name="can_title" type="text"  
                                    value="<?php echo $prof_title;?>">
                                    <i class="fa fa-id-card fa-lg fa-fw" 
                                    aria-hidden="true" style="margin-top:2px;"></i>
                                  </div>
                                </div>

                                <div class="left">
                                  <div class="inputWithIcon inputIconBg"> 
                                    <input name="can_email" type="text" 
                                    value="<?php echo $email;?>">
                                    <i class="fa fa-envelope-o fa-lg fa-fw" 
                                    aria-hidden="true" style="margin-top:2px;"></i>
                                  </div>
                                </div>

                                <div class="right">
                                  <div class="inputWithIcon inputIconBg"> 
                                    <input name="can_phone" type="text" 
                                    value="<?php echo '0'.$phone;?>">
                                    <i class="fa fa-phone fa-lg fa-fw" 
                                    aria-hidden="true"></i>
                                  </div>
                                </div>

                                <div class="left">
                                  <div class="inputWithIcon inputIconBg"> 
                                    <input name="can_gender" type="text" 
                                    value="<?php echo $gender;?>">
                                    <i class="fa fa-venus fa-lg fa-fw" 
                                    aria-hidden="true"></i>
                                  </div>
                                </div>

                                <div class="right">
                                  <div class="inputWithIcon inputIconBg"> 
                                    <input name="can_age" type="text" 
                                    value="<?php echo $age;?>">
                                    <i class="fa fa-sort-amount-desc fa-lg fa-fw" 
                                    aria-hidden="true"></i>
                                  </div>
                                </div>

                                <div class="left">
                                  <div class="inputWithIcon inputIconBg"> 
                                    <input name="can_xp" type="text" 
                                    value="<?php echo $xp.' of xp';?>">
                                    <i class="fa fa-bar-chart-o fa-lg fa-fw" 
                                    aria-hidden="true"></i>
                                  </div>
                                </div>

                                <div class="right">
                                  <div class="inputWithIcon inputIconBg"> 
                                    <input name="can_study" type="text" 
                                    value="<?php echo $study;?>">
                                    <i class="fa fa-file-text-o fa-lg fa-fw" 
                                    aria-hidden="true"></i>
                                  </div>
                                </div>

                                <div class="tell">
                                  <textarea name="about" placeholder="About my self" 
                                  row="8" ></textarea>
                                </div>
                              </div>

                              <div class="finalise">
                                <input type="submit" class="form-control submit" 
                                name="jobapplication" value="submit">
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php } ?>
                </tbody>
              </table>

              <div aria-label="Page navigation" style="border:1px solid transparent;
                height:38px;margin-top:20px;">
                <ul class="pagination" style="border:1px solid transparent;
                margin-top:0px;">
                  <?php if($currentPage != $firstPage) { ?>
                    <li class="page-item">
                      <a class="page-link" href="?page=<?php echo $firstPage ?>" 
                      tabindex="-1" aria-label="Previous">
                        <span aria-hidden="true">First</span>
                      </a>
                    </li>
                  <?php } ?>
                  
                  <?php if($currentPage >= 2) { ?>
                    <li class="page-item">
                      <a class="page-link" href="?page=<?php echo $previousPage ?>">
                        <?php echo $previousPage ?>
                      </a>
                    </li>
                  <?php } ?>

                  <li class="page-item active">
                    <a class="page-link" href="?page=<?php echo $currentPage ?>">
                      <?php echo $currentPage ?>
                    </a>
                  </li>

                  <?php if($currentPage != $lastPage) { ?>
                    <li class="page-item">
                      <a class="page-link" href="?page=<?php echo $nextPage ?>">
                        <?php echo $nextPage ?> 
                      </a>
                    </li>

                    <li class="page-item">
                      <a class="page-link" href="?page=<?php echo $lastPage ?>" 
                      aria-label="Next">
                        <span aria-hidden="true">Last</span>
                      </a>
                    </li>
                  <?php } ?>
                </ul>
              </div>
            
            </div>
            <!-- [ blueprint ] -->
          </div>
        </div>
      </section>

    </body>
  </html>
<?php } ?>
