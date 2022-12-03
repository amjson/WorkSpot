<?php
  include ("includes/db.include.php");

  if (!isset($_GET["token"])) 
  {
    exit("Page not found");
  }

  $token      = $_GET["token"];
  $res_token  = "SELECT acc_verify, token FROM employer WHERE acc_verify = 0 AND 
  token = '$token' LIMIT 1";
  $run_verify = mysqli_query($con, $res_token);

  if(mysqli_num_rows($run_verify) == 1)
  { 
    $query     = "UPDATE employer SET acc_verify = 1 WHERE token = '$token' LIMIT 1";
    $run_query = mysqli_query($con, $query);
    echo "<script>alert('Your Account has been verified you may now Login')</script>";
    exit();
  }
  else
  {
    exit("Page not found");
  }
?>