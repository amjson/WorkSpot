<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="This is an online web app for job application">
    <meta name="keywords" content="">
    <meta name="authour" content="Joeson Misiani">
    <title>Work Spot - home</title>

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
    *{
      margin: 0px;
      padding: 0px;
      box-sizing: border-box;
    }
    body
    {
      border: 1px solid transparent;
      width:100%;
      height: 8vh;
      background-size: cover;
      background-attachment: fixed;
      /*background-image: url("photos/img8.jpg");*/
      background-image: linear-gradient(rgba(0,0,0,0.75),rgba(0,0,0,0.75)), 
      url("photos/img8.jpg");
      overflow: hidden;
    }  
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
    .pro_bar {
      border-radius: 0px;
      border: 1px solid transparent;
      width: 100%;
      height: 105px;
      background: transparent;
    }
    .left_side_bar {
      border: 1px solid transparent;
      margin-left: 250px;
      height: 42px;
      width: 130px;
      margin-top: 60px;
      float: left;
      padding-left: 0px;
    }
    .left_side_bar .forlogo {
      width:128px;
      height: 40px;
      border:1px solid transparent;
      float:left;
    }
    .left_side_bar .forlogo img {
      margin-top: -4px;
      width:125px;
      height: 45px;
    }
    .right_side_bar {
      border: 1px solid transparent;
      margin-left: 400px;
      height: 42px;
      width: 268px;
      margin-top: 60px;
      float: left;
      padding-left: 0px;
    }
    .right_side_bar .menu{
      /*font-family: 'H', 'Trebuchet MS', Helvetica;*/
      font-family: 'Trebuchet MS';
      font-size: 23px;
      border:1px solid transparent;
      float: left;
      height: 40px;
      line-height: 40px;
      margin-top: 0px;
      padding-left: 15px;
      padding-right: 15px;
    }
    .right_side_bar .menu a{
      color: #fff;
    }
    .right_side_bar .menu a:hover{
      color: dodgerblue;
      text-decoration: none; 
      -webkit-transition:color .3s linear;
      -o-transition:color .3s linear;
      transition:color .3s linear;
      outline:0; 
    }
  </style>
  
  <body>
    <section>
      <nav class="navbar navbar-expand-lg pro_bar">
        <ul class="left_side_bar">
          <div class="forlogo">
            <a href="">
              <li><img src="photos/WorkSpot Logo.png"></li>
            </a>
          </div>
        </ul>

        <ul class="right_side_bar">
          <li class='menu'>
            <a href="myemp_log.php">Employer</a>
          </li>

          <li class='menu'>
            <a href="mycan_log.php">Candidate</a>
          </li>
        </ul>
      </nav>
    </section>
  </body>
</html>
