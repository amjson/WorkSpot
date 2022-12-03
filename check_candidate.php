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
            header("Location: mycan_profile.php?profile%empty");
            exit();
          }
          else
          {
            if (!preg_match("/^[a-z A-Z]*$/", $fullname))
            {
              header("Location: mycan_profile.php?profile%error");
              exit(); 
            }
            else 
            {
              if(!filter_var($email, FILTER_VALIDATE_EMAIL))
              {
                header("Location: mycan_profile.php?profile%error");
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
                  header("Location:mycan_profile.php?
                    profile%cridentials%already%in%use");
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
                    echo "<script>window.open('mycan_profile.php', '_self')</script>";
                    exit();
                  }
                }
              }
            }
          }          
        }
        else {
          echo "<script>alert('Your Profile Photo is too big')</script>";
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
    else {
      echo "<script>alert('You cannot save an empty profile, please complete filling the form')</script>";
      echo "<script>window.open('mycan_profile.php?profile%error', '_self')</script>";
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
        padding-left: 5px;
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
                    <a class='dropdown-item locate' href='mycan_profile.php'>
                    Profile</a><br>
                    <a class='dropdown-item locate' href='mycan_settings.php'>
                    Settings</a><br>
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
                    <a href='mycan_profile.php'>Profile</a>
                  </li>
                  ";

                  echo 
                  "
                  <li class='bar'>
                    <i class='fa fa-search fa-lg fa-fw' aria-hidden='true'></i>
                    <a href='mycan_vaccancy.php'>Vacancies</a>
                  </li>
                  ";

                  echo 
                  "
                  <li class='bar'>
                    <i class='fa fa-tags fa-lg fa-fw' aria-hidden='true'></i>
                    <a href='mycan_applications.php'>Applications</a>
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
                    <a href='mycan_settings.php'>Settings</a>
                  </li>
                  ";

                  echo 
                  "
                  <li class='bar'>
                    <i class='fa fa-wrench fa-lg fa-fw' aria-hidden='true'></i>
                    <a href='check_candidate.php'>Confirm</a>
                  </li>
                  ";
                ?>
              </ul>
            </div>
          </div>

          <div class="layerthree">
            <div class="job_page">
              <!-- Auto update profile picture -->
              <?php
                $forUser  = $_SESSION['user_email'];
                $resUser = "SELECT * FROM canprofile WHERE email='$forUser'";
                $runUser = mysqli_query($con, $resUser);

                if(mysqli_num_rows($runUser) == True) { 
                  $main      = mysqli_fetch_assoc($runUser); 
                  $mainPhoto = $main['photo']; 
                  $mainAge   = $main['age'];
                  $mainXp    = $main['xp'];
                  $mainPhone = $main['phone']; 

                  echo $mainPhoto."<br>";
                  echo $mainAge."<br>";
                  echo $mainXp."<br>";
                  echo $mainPhone."<br><br><br>";
                }
                
                $myUpdt  = $_SESSION['user_email'];
                $getUpdt = "SELECT * FROM canapplyjob WHERE can_email='$myUpdt'";
                $runUpdt = mysqli_query($con, $getUpdt);

                if(mysqli_num_rows($runUpdt) == True) { 
                  $sub      = mysqli_fetch_assoc($runUpdt); 
                  $oldPhoto = $sub['photo']; 
                  $oldAge   = $sub['can_age'];
                  $oldXp    = $sub['can_xp'];
                  $oldPhone = $sub['can_phone'];                   
                }

                if($mainPhoto == $oldPhoto && $mainAge == $oldAge && 
                $mainXp == $oldXp && $mainPhone == $oldPhone) {
                  $confirm  = $_SESSION['user_email'];
                  $resFinal = "SELECT * FROM canapplyjob WHERE can_email='$confirm' ";
                  $runFinal = mysqli_query($con, $resFinal);
                
                  if(mysqli_num_rows($runFinal) == True) { 
                    $rowChild   = mysqli_fetch_assoc($runFinal);
                    $finalPhoto = $rowChild['photo']; 
                    $finalAge   = $rowChild['can_age'];
                    $finalXp    = $rowChild['can_xp'];
                    $finalPhone = $rowChild['can_phone']; 

                    echo $finalPhoto."<br>";
                    echo $finalAge."<br>";
                    echo $finalXp."<br>";
                    echo $finalPhone."<br>";
                  }
                }
                else {
                  $userUnify = $_SESSION['user_email'];
                  $getUnify  = "SELECT * FROM canapplyjob WHERE can_email='$userUnify'";
                  $runUnify  = mysqli_query($con, $getUnify);

                  $newphoto = $mainPhoto;
                  $newage   = $mainAge;
                  $newxp    = $mainXp;
                  $newphone = $mainPhone;

                  $update = "UPDATE canapplyjob SET photo='$newphoto',
                  can_age='$newage',can_xp='$newxp',
                  can_phone='$newphone' WHERE can_email='$userUnify'";
                  $run_update = mysqli_query($con, $update);

                  $confirm  = $_SESSION['user_email'];
                  $resFinal = "SELECT * FROM canapplyjob WHERE can_email='$confirm' ";
                  $runFinal = mysqli_query($con, $resFinal);
                
                  if(mysqli_num_rows($runFinal) == True) { 
                    $rowChild   = mysqli_fetch_assoc($runFinal);
                    $finalPhoto = $rowChild['photo']; 
                    $finalAge   = $rowChild['can_age'];
                    $finalXp    = $rowChild['can_xp'];
                    $finalPhone = $rowChild['can_phone']; 

                    echo $finalPhoto."<br>";
                    echo $finalAge."<br>";
                    echo $finalXp."<br>";
                    echo $finalPhone."<br>";
                  }
                }
              ?>
            </div>
          </div>
        </div>
      </section>
      
    </body>
  </html>
<?php } ?>
