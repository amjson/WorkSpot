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
        width: 80%;
      }
      .comp_photo {
        border: 1px solid transparent;
        width: 100%;
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
        border: 1px solid transparent;
        font-family: Bahnschrift;
        font-size: 17px;
        color: rgba(0,0,0,.8);
        margin-top: 0px;
        padding-left: 20px;
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
        height: 125px;
        border: 1px solid transparent;
        background-color: transparent;
        padding-left: 10px;
      }
      .tell textarea {
        border: 1px solid transparent;
        border-bottom: 1px solid #aaa;
        box-sizing: border-box;
        width: 98%;
        height: 118px;
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
              $get_user     = "SELECT * FROM employer WHERE user_email='$user'";
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
                    <a class='dropdown-item locate' href='myemp_profile.php?token=$token'>
                      Profile
                    </a><br>
                    <a class='dropdown-item locate' href='myemp_settings.php?token=$token'>
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
                $get_user  = "SELECT * FROM employer WHERE user_email='$user'";
                $run_user  = mysqli_query($con, $get_user);
                $row       = mysqli_fetch_array($run_user);
                $my_name   = $row['user_name'];
                
                $Offline    = "UPDATE employer SET log_in='Offline' WHERE 
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
                $get_user = "SELECT * FROM employer WHERE user_email='$user'";
                $run_user = mysqli_query($con, $get_user);
                $row      = mysqli_fetch_array($run_user);
                $user_company  = $row['user_company'];
                $user_fullname = $row['user_fullname'];

                echo "<div class='myphoto'><img src='$user_profile'></div>";
                echo "<div class='fullname'>$user_fullname</div>";
                echo "<div class='username'>$user_company</div>";
              ?>
            </div>

            <div class="bottom-layer">
                            <ul>
                <?php
                  $user      = $_SESSION['user_email'];
                  $get_user  = "SELECT * FROM employer WHERE user_email='$user'";
                  $run_user  = mysqli_query($con, $get_user);
                  $row       = mysqli_fetch_array($run_user);
                  $user_name = $row['user_name'];
                  $token     = $row['token'];

                  echo 
                  "
                  <li class='bar'>
                    <i class='fa fa-desktop fa-lg fa-fw' aria-hidden='true'></i>
                    <a href='myemployer.php?user_name=$user_name'>Home</a>
                  </li>
                  ";

                  echo 
                  "
                  <li class='bar'>
                    <i class='fa fa-book fa-lg fa-fw' aria-hidden='true'></i>
                    <a href='myemp_profile.php?token=$token'>Profile</a>
                  </li>
                  ";

                  echo 
                  "
                  <li class='bar'>
                    <i class='fa fa-upload fa-lg fa-fw' aria-hidden='true'></i>
                    <a href='myemp_upload.php?token=$token'>Upload</a>
                  </li>
                  ";

                  echo 
                  "
                  <li class='bar'>
                    <i class='fa fa-briefcase fa-lg fa-fw' aria-hidden='true'></i>
                    <a href='myemp_vaccancy.php?token=$token'>Vacancies</a>
                  </li>
                  ";

                  echo 
                  "
                  <li class='bar'>
                    <i class='fa fa-group fa-lg fa-fw' aria-hidden='true'></i>
                    <a href='myemp_candidate.php?token=$token'>Candidates</a>
                  </li>
                  ";

                  echo 
                  "
                  <li class='bar'>
                    <i class='fa fa-calendar fa-lg fa-fw' aria-hidden='true'></i>
                    <a href='myemp_calendar.php'>Callendar</a>
                  </li>
                  ";

                  echo 
                  "
                  <li class='bar'>
                    <i class='fa fa-wrench fa-lg fa-fw' aria-hidden='true'></i>
                    <a href='myemp_settings.php?token=$token'>Settings</a>
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
                $confirm = $_SESSION['user_email'];
                $uploder = "SELECT * FROM canapplyjob WHERE emp_mail='".$confirm."' ";
                $confirm_uploder = mysqli_query($con, $uploder);
              ?>

              <?php if(mysqli_num_rows($confirm_uploder) == 0) { ?>
                <h4 style="height:28px;width:100%;text-align:center;font-size:20px;
                border: 1px solid transparent;margin-top:230px;
                font-family:Comic Sans MS;">
                  You have no job applications concerning your vaccancies
                </h4>
              <?php } else { ?>

                <?php
                  include ("includes/db.include.php");

                  $showRecordPerPage = 5;

                  if(isset($_GET['page']) && !empty($_GET['page'])) {
                    $currentPage = $_GET['page'];
                  }
                  else {
                    $currentPage = 1;
                  }
                  
                  $startFrom = ($currentPage * $showRecordPerPage) - $showRecordPerPage;
                  $user          = $_SESSION['user_email'];
                  $totalEmpSQL="SELECT * FROM canapplyjob WHERE emp_mail='".$confirm."'";
                  $allEmpResult  = mysqli_query($con, $totalEmpSQL);
                  $totalEmployee = mysqli_num_rows($allEmpResult);
                  $lastPage      = ceil($totalEmployee/$showRecordPerPage);

                  $firstPage     = 1;
                  $nextPage      = $currentPage + 1;
                  $previousPage  = $currentPage - 1;

                  $getSQL = "SELECT id,emp_mail,photo,can_name,can_title,can_email,
                  can_phone,can_gender,can_age,can_xp,can_study,about FROM canapplyjob
                  WHERE emp_mail='$user' LIMIT $startFrom, $showRecordPerPage ";
                  $runSQL = mysqli_query($con, $getSQL);
                ?>

                <table class="table">                  
                  <tbody>
                    <?php
                      while($job = mysqli_fetch_array($runSQL)){
                      ?>

                      <tr class="raw"> 
                        <td>
                          <i class="fa fa-user fa-lg fa-fw" aria-hidden="true"></i>
                          &nbsp&nbsp<?php echo $job['can_name'];?> <br>
                          <i class="fa fa-id-card fa-lg fa-fw" aria-hidden="true" 
                          style="padding-top:10px;"></i>
                          &nbsp&nbsp<?php echo $job['can_title'];?>
                        </td>

                        <td>
                          <i class="fa fa-file-text-o fa-lg fa-fw" 
                          aria-hidden="true"></i>
                          &nbsp&nbsp<?php echo $job['can_study'];?> <br>
                          <i class="fa fa-bar-chart-o fa-lg fa-fw" aria-hidden="true" 
                          style="padding-top:10px;"></i>
                          &nbsp&nbsp<?php echo $job['can_xp'];?>
                        </td>

                        <td>
                          <i class="fa fa-sort-amount-desc fa-lg fa-fw" 
                          aria-hidden="true"></i>
                          &nbsp&nbsp<?php echo $job['can_age'];?> <br>
                          <i class="fa fa-phone fa-lg fa-fw" aria-hidden="true"
                          style="padding-top:10px;"></i>
                          &nbsp&nbsp<?php echo '0'.$job['can_phone'];?>    <br>
                          <i class="fa fa-envelope-o fa-lg fa-fw" aria-hidden="true"
                          style="padding-top:10px;"></i>
                          &nbsp&nbsp<?php echo $job['can_email'];?>
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
                              <button type="button" class="close" 
                              data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">View This Candidate</h4>
                            </div>

                            <div class="modal-body">
                              <form enctype="multipart/form-data" id="form">
                                <div class="job_header">
                                  <div class="comp_photo">
                                    <div>
                                      <img src="<?php echo $job['photo'];?>">
                                    </div>

                                    <h6>
                                      <input value="<?php echo $job['can_name'];?>"> <br>
                                      <input value="<?php echo $job['can_email'];?>"><br>
                                      <input value="<?php echo '0'.$job['can_phone'];?>"
                                      style="margin-top:2px;">
                                    </h6>
                                  </div>
                                </div>

                                <div class="job_body">
                                  <div class="left">
                                    <div class="inputWithIcon inputIconBg"> 
                                      <input value="<?php echo $job['can_name'];?>">
                                      <i class="fa fa-user fa-lg fa-fw" 
                                      aria-hidden="true"></i>
                                    </div>
                                  </div>

                                  <div class="right">
                                    <div class="inputWithIcon inputIconBg">
                                      <input value="<?php echo $job['can_title'];?>">
                                      <i class="fa fa-id-card fa-lg fa-fw" 
                                      aria-hidden="true" style="margin-top:2px;"></i>
                                    </div>
                                  </div>

                                  <div class="left">
                                    <div class="inputWithIcon inputIconBg"> 
                                      <input value="<?php echo $job['can_gender'];?>">
                                      <i class="fa fa-venus fa-lg fa-fw" 
                                      aria-hidden="true"></i>
                                    </div>
                                  </div>

                                  <div class="right">
                                    <div class="inputWithIcon inputIconBg"> 
                                      <input value="<?php echo $job['can_age'];?>">
                                      <i class="fa fa-sort-amount-desc fa-lg fa-fw" 
                                      aria-hidden="true"></i>
                                    </div>
                                  </div>

                                  <div class="left">
                                    <div class="inputWithIcon inputIconBg"> 
                                      <input value="<?php echo $job['can_xp'];?>">
                                      <i class="fa fa-bar-chart-o fa-lg fa-fw" 
                                      aria-hidden="true"></i>
                                    </div>
                                  </div>

                                  <div class="right">
                                    <div class="inputWithIcon inputIconBg"> 
                                      <input value="<?php echo $job['can_study'];?>">
                                      <i class="fa fa-file-text-o fa-lg fa-fw" 
                                      aria-hidden="true"></i>
                                    </div>
                                  </div>

                                  <div class="tell">
                                    <textarea>
                                      <?php echo $job['about'];?>
                                    </textarea>
                                  </div>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    <?php } ?>
                  </tbody>
                </table>

                <?php
                  $allApplication  = $_SESSION['user_email'];
                  $countAll = "SELECT * FROM canapplyjob WHERE emp_mail='$allApplication'";
                  $countSQL = mysqli_query($con, $countAll);
                ?>

                <?php if(mysqli_num_rows($countSQL) < 6) { ?>
                  <div aria-label="Page navigation" style="display:none !important;"></div>
                <?php } else { ?>
                  <div aria-label="Page navigation" style="height:38px;margin-top:20px;border:1px solid transparent;">
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
                <?php } ?>
              <?php } ?>
            </div>
            <!-- [ blueprint ] -->

            <!-- [ AUTO UPDATE USER INFORMATION FROM PARENT TO CHILD DIRECTORY ] -->
            <?php
              $newUser    = $_GET["token"];
              $getNewUser = "SELECT * FROM employer WHERE token='$newUser'";
              $resNewUser = mysqli_query($con, $getNewUser);

              if(mysqli_num_rows($resNewUser) == False) { 
                // leave blank
              }
              else {
                $main     = mysqli_fetch_assoc($resNewUser); 
                $mainMail = $main['user_email'];
              }

              $forCan = $_GET["token"];
              $resCan = "SELECT * FROM canapplyjob WHERE emp_token='$forCan'";
              $runCan = mysqli_query($con, $resCan);

              if(mysqli_num_rows($runCan) == False) { 
                // leave blank
              }
              else {
                $sub      = mysqli_fetch_assoc($runCan); 
                $oldEmail = $sub['email']; 

                if($mainMail == $oldEmail) {
                  // leave blank
                }
                else {
                  $mytoken  = $_GET["token"];
                  $resToken = "SELECT * FROM canapplyjob WHERE emp_token='$mytoken'";
                  $tokenSQL = mysqli_query($con, $resToken);

                  // assign parent names with new names 
                  $newMail = $mainMail;

                  // updating child directory with new names
                  $update  ="UPDATE canapplyjob SET emp_mail='$newMail' 
                  WHERE emp_token='$mytoken'";
                  $runUPDT = mysqli_query($con, $update);
                }
              }
            ?>
          </div>
        </div>
      </section>

    </body>
  </html>
<?php } ?>
