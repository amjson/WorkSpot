<?php
  session_start();

  if(isset($_POST['upload']))
  {
    include ("includes/db.include.php");

    $photo       = htmlentities(mysqli_real_escape_string($con, $_POST['avatar']));
    $comp_name   = htmlentities(mysqli_real_escape_string($con, $_POST['comp_name']));
    $location    = htmlentities(mysqli_real_escape_string($con, $_POST['location']));
    $email       = htmlentities(mysqli_real_escape_string($con, $_POST['email']));
    $phone       = htmlentities(mysqli_real_escape_string($con, $_POST['phone']));
    $title       = htmlentities(mysqli_real_escape_string($con, $_POST['title']));
    $type        = htmlentities(mysqli_real_escape_string($con, $_POST['type']));
    $xp          = htmlentities(mysqli_real_escape_string($con, $_POST['xp']));
    $date        = htmlentities(mysqli_real_escape_string($con, $_POST['date']));
    $info        = htmlentities(mysqli_real_escape_string($con, $_POST['info']));
    $requirement = htmlentities(mysqli_real_escape_string($con, $_POST['requirement']));
    $reg_token   = $_POST['reg_token'];

    if(empty($comp_name) || empty($location) || empty($email) || empty($phone) ||
       empty($title) || empty($type) || empty($xp) || empty($date) || empty($info) || 
       empty($requirement))
    {
      echo "<script>alert('There was an error uploading this job. Confirm if you have completed your profile form')</script>";
      echo "<script>window.open('myemp_upload.php?form%empty', '_self')</script>";
      exit();
    }
    else
    {
      if(!filter_var($email, FILTER_VALIDATE_EMAIL))
      {
        header("Location: myemp_upload.php?form%error");
        exit(); 
      } 
      else
      {
        // create a one time token
        $pro   = "webtask73"; 
        $token = md5(time().$pro);

        $sqlquery = "INSERT INTO empostjob(photo,comp_name,location,email,phone,
        title,type,xp,ends,info,requirement,token,reg_token,uploaded)
        VALUES('$photo','$comp_name','$location','$email','$phone','$title',
        '$type','$xp','$date','$info','$requirement','$token','$reg_token',now())";

        $verifyquery = mysqli_query($con, $sqlquery);

        if ($verifyquery) 
        {
          echo "<script>alert('You have created a new job vaccancy.')</script>";
          echo "<script>window.open('myemp_vaccancy.php', '_self')</script>";
          exit();
        }
      }
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
      #form {
        border: 1px solid transparent;
        background-color: transparent;
        width: 100%;
        height: 457px;
        margin-top: 0px;
        margin-left: 0px;
        padding-top: 40px;
        padding-left: 10px;
        padding-right: 10px;
      }
      .job_header {
        border: 1px solid transparent;
        height: 74px;
      }
      .comp_photo {
        border: 1px solid transparent;
        width: 52%;
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
        margin-top: 5px;
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
        height: 90px;
        border: 1px solid transparent;
        background-color: transparent;
        padding-left: 10px;
      }
      .tell textarea {
        border: none;
        border-bottom: 1px solid #aaa;
        box-sizing: border-box;
        width: 98%;
        height: 84px;
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
        float: right;
        width: 100%;
        height: 70px;
        border: 1px solid transparent;
        background-color: transparent;
        padding-left: 9px;
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
        margin-top: 30px;
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
              <form action="" method="POST" enctype="multipart/form-data" id="form" autocomplete="off">
                <div class="job_header">
                  <div class="comp_photo">
                    <?php
                      $user    = $_SESSION['user_email'];
                      $my_user = "SELECT * FROM emprofile WHERE email='".$user."' ";
                      $query   = mysqli_query($con, $my_user);
                    ?>

                    <?php if(mysqli_num_rows($query) > 0) { 
                      $row       = mysqli_fetch_assoc($query);

                      $photo     = $row['photo'];
                      $comp_name = $row['comp_name'];
                      $location  = $row['location'];
                      $phone     = $row['phone'];
                      $email     = $row['email'];
                      $token     = $row['token']; ?>

                      <div>
                        <img src="<?php echo $photo; ?>">
                        <input type='hidden' name='avatar' value="<?php echo $photo ?>">
                      </div>

                      <h6>
                        <input type="text" name="comp_name" style="margin-top:-3px;" 
                        value="<?php echo $comp_name ?>" ><br>
                        <input type="text" name="location" value="<?php echo $location ?>">  <br>
                        <input  type="text" name="email" value="<?php echo $email ?>">
                        <br>
                        <input type="text" name="phone" value="0<?php echo $phone ?>" style="padding-top:10px;">
                      </h6>
                      <input type="hidden" name="reg_token" value="<?php echo $token ?>">
                    <?php } else { ?>
                      <div>
                        <img src="photos/default.jpeg">
                      </div>

                      <h6>
                        <input placeholder="Company Name" style="margin-top:-3px;"> <br>
                        <input placeholder="Location">  <br>
                        <input placeholder="Email">     <br>
                        <input placeholder="Phone number" style="padding-top:10px;">
                      </h6>
                    <?php } ?> 

                  </div>
                </div>

                <div class="job_body">
                  <div class="left">
                    <div class="inputWithIcon inputIconBg"> 
                      <input type="text" name="title" placeholder="Job Title">
                      <i class="fa fa-briefcase fa-lg fa-fw" aria-hidden="true"></i>
                    </div>
                  </div>

                  <div class="right">
                    <div class="inputWithIcon inputIconBg"> 
                      <select type="text" name="type">
                        <option disabled="">select type of job</option>
                        <option>Full time</option>
                        <option>Part time</option>
                        <option>Temporaly</option>
                      </select>
                      <i class="fa fa-clock-o fa-lg fa-fw" aria-hidden="true"></i>
                    </div>
                  </div>

                  <div class="left">
                    <div class="inputWithIcon inputIconBg"> 
                      <select type="text" name="xp">
                        <option disabled="">select years of xp</option>
                        <option>none</option>
                        <option>6 months of xp</option>
                        <option>1 year of xp</option>
                        <option>2 years of xp</option>
                        <option>3 years of xp</option>
                        <option>4 years of xp</option>
                        <option>5 and above of xp</option>
                      </select>
                      <i class="fa fa-id-card fa-lg fa-fw" aria-hidden="true" style="margin-top:1px;"></i>
                    </div>
                  </div>

                  <div class="right">
                    <div class="inputWithIcon inputIconBg"> 
                      <input type="date" name="date" placeholder="29-05-2020">
                      <i class="fa fa-calendar fa-lg fa-fw" aria-hidden="true"></i>
                    </div>
                  </div>

                  <div class="left">
                    <div class="inputWithIcon inputIconBg"> 
                      <select type="text" name="info">
                        <option disabled="">select job category</option>
                        <option>Attachment</option>
                        <option>Internship</option>
                        <option>Employment</option>
                      </select>
                      <i class="fa fa-users fa-lg fa-fw" aria-hidden="true"></i>
                    </div>
                  </div>

                  <div class="tell">
                    <textarea name="requirement" placeholder="Job Requirement" 
                    row="8" ></textarea>
                  </div>

                  <div class="finalise">
                    <input type="submit" class="form-control submit" name="upload" 
                    value="upload">
                  </div>
                </div>
              </form>
            </div>
            <!-- [ blueprint ] -->
          </div>
        </div>
      </section>

      <script src="MyCustom/js/analog_clock.js"></script>
      <script src="MyCustom/js/digital_clock.js"></script>
    </body>
  </html>
<?php } ?>
