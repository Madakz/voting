<?php
  include "class_lib/functions.php";

  if (!isset($_SESSION['surname']) && !isset($_SESSION['othername'])) {
     header("location:index.php");
  }
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Rofosa Elections</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/animate.min.css" rel="stylesheet"> 
  <link href="css/font-awesome.min.css" rel="stylesheet">
  <link href="css/lightbox.css" rel="stylesheet">
  <link href="css/main.css" rel="stylesheet">
  <link id="css-preset" href="css/presets/preset1.css" rel="stylesheet">
  <link href="css/responsive.css" rel="stylesheet">

  <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
  <![endif]-->
  
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>
  <link rel="shortcut icon" href="images/rfc2.jpg">
</head><!--/head-->

<body>

  <!--.preloader-->
  <!-- <div class="preloader"> <i class="fa fa-circle-o-notch fa-spin"></i></div> -->
  <!--/.preloader-->

  <header id="home">
    <div id="home-slider" class="carousel slide carousel-fade" data-ride="carousel">
      <div class="carousel-inner">
        <div class="item active" style="background-image: url(images/thumbs.png)">
          <div class="caption">
            <h1 class="animated fadeInLeftBig">Ballot Succesfully casted</h1>
            <h1 class="animated fadeInLeftBig"><span>Thankyou for Voting!</span></h1>
            <!-- <p class="animated fadeInRightBig">Bootstrap - Responsive Design - Retina Ready - Parallax</p> -->
            <a data-scroll class="btn btn-start animated fadeInUpBig" href="logout.php">Sign out</a>
          </div>
        </div>

    </div><!--/#home-slider-->

  </header><!--/#home-->
  <footer id="footer">
    <div class="footer-bottom">
      <div class="container">
        <div class="row">
            <div class="col-sm-5"></div>
          <div class="col-sm-3">
            <p>&copy; 2017 Madaki Fatsen.</p>
          </div>
          <div class="col-sm-4">
          </div>
        </div>
      </div>
    </div>
  </footer>

  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
  <script type="text/javascript" src="js/jquery.inview.min.js"></script>
  <script type="text/javascript" src="js/wow.min.js"></script>
  <script type="text/javascript" src="js/mousescroll.js"></script>
  <script type="text/javascript" src="js/smoothscroll.js"></script>
  <script type="text/javascript" src="js/jquery.countTo.js"></script>
  <script type="text/javascript" src="js/lightbox.min.js"></script>
  <script type="text/javascript" src="js/main.js"></script>

</body>
</html>