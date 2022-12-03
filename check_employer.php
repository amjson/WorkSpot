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

  $forJob = $_GET["token"];
  $resJob = "SELECT * FROM empostjob WHERE reg_token='$forJob'";
  $runJob = mysqli_query($con, $resJob);

  if(mysqli_num_rows($runJob) == False) { 
    // leave blank
  }
  else {
    $sub      = mysqli_fetch_assoc($runJob); 
    $oldEmail = $sub['email']; 

    if($mainMail == $oldEmail) {
      // leave blank
    }
    else {
      $mytoken  = $_GET["token"];
      $resToken = "SELECT * FROM empostjob WHERE reg_token='$mytoken'";
      $tokenSQL = mysqli_query($con, $resToken);

      // assign parent names with new names 
      $newMail = $mainMail;

      // updating child directory with new names
      $update  ="UPDATE empostjob SET email='$newMail' 
      WHERE reg_token='$mytoken'";
      $runUPDT = mysqli_query($con, $update);
    }
  }


  /*****************************/
  if ($run) {
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

        if ($runUPDT) {
          $Offline = "UPDATE candidate SET log_in='Offline' WHERE 
          user_email='$email' ";
          $update_msg = mysqli_query($con, $Offline);
          
          echo "<script>window.open('includes/logout.include.php', '_self')</script>";
        } 
      }
    }
  }
?>