<?php
  include "../class_lib/functions.php";

  $rofosa_inst= new Rofosa;
  if (!isset($_SESSION['admin'])) {
     header("location:../index.php");
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
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <link href="../css/animate.min.css" rel="stylesheet"> 
  <link href="../css/font-awesome.min.css" rel="stylesheet">
  <link href="../css/lightbox.css" rel="stylesheet">
  <link href="../css/main.css" rel="stylesheet">
  <link id="css-preset" href="../css/presets/preset1.css" rel="stylesheet">
  <link href="../css/responsive.css" rel="stylesheet">

  <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
  <![endif]-->
  
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>
  <link rel="shortcut icon" href="../images/rfc2.jpg">
</head><!--/head-->
<style type="text/css">
  .btn-success {
      display: block;
      width: 100%;
      margin-top: 0px;
      height: 50px;
      padding: 6px 12px;
      font-size: 14px;
      line-height: 1.42857143;
    }
    table, th, td {
      border: 1px solid grey;
      text-align: center;

    }
  </style>

<body>

  <!--.preloader-->
  <!-- <div class="preloader"> <i class="fa fa-circle-o-notch fa-spin"></i></div> -->
  <!--/.preloader-->

  <header id="home">
  	<div class="main-nav">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
            <img class="img-responsive" src="../images/rfc2.jpg" alt="logo" style="height: 80px; width: 80px; 	padding: 0px; margin: 0px;">        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">                 
            <li class="scroll"><a href="register_aspirant.php">Register Aspirant</a></li>
            <!-- <li class="scroll"><a href="#services">View All Aspirant</a></li>  -->
            <li class="scroll active"><a href="results.php">Electon Results</a></li>                     
            <li class="scroll"><a href="#">Aspirants</a></li>
            <li class="scroll"><a href="../logout.php">Logout</a></li>
            <!-- <li class="scroll"><a href="#blog">Blog</a></li>
            <li class="scroll"><a href="#contact">Contact</a></li>  -->      
          </ul>
        </div>
      </div>
    </div><!--/#main-nav-->

  </header><!--/#home-->
  <section id="contact">
    <div id="contact-us" class="parallax">
      <div class="container">
        <div class="row">
          <div class="heading text-center col-sm-8 col-sm-offset-2 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
            <h2 style="font-weight: bolder;">VIEW SELECTED ASPIRANT'S RESULT</h2>
            <div class="row">
              <div class="col-md-1"></div>
              <div class="col-md-10">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
                  <div class="row">
                    <div class="col-md-6">
                      <select name="aspirant_id" id="form_price" class="form-control" value="<?php echo !empty($_POST['form_price']) ? $_POST['form_price'] : ""; ?>">
                        <option value="">Select Aspirant name</option>
                  <?php
                          $aspirants = $rofosa_inst->viewAllAspirants();
                          foreach ($aspirants as $aspirant) {
                  ?>
                          <option value="<?php echo $aspirant['id'];?>"><?php echo $aspirant['surname'].' '.$aspirant['othername'];?> for <?php echo $aspirant['position'];?></option>
                  <?php
                          }
                  ?>

                      </select>
                    </div>
                    <div class="col-md-6">
                      <input type="submit" name="check" value="Search" class="btn-success">
                    </div>
                    
                  </div>
                </form>

                <?php 
                  if (isset($_POST['check'])) {
                    $aspirant_id = $_POST['aspirant_id'];

                    $result = $rofosa_inst->viewAspirantResult($aspirant_id);
                    $aspirant= $rofosa_inst->findById($aspirant_id, 'aspirants');

                    // echo $aspirant['surname'].' Result '. $aspirant['othername'] .' is: '.$result. ' votes';
                ?>
                  <div style="font-size: 25px; text-align: center; padding: 15px;">Search Results for <?php echo $aspirant['surname'].' '. $aspirant['othername']; ?></div>
                  <table border="1 solid green" width="100%" style="text-align: center;">
                    <thead>
                      <th>Candidate</th>
                      <th>Position</th>
                      <th>Votes</th>
                    </thead>
                    <tbody>
                      <tr>
                        <td><?php echo $aspirant['surname']. ' '. $aspirant['othername']; ?></td>
                        <td><?php echo $aspirant['position']; ?></td>
                        <td><?php echo $result; ?></td>
                      </tr>
                    </tbody>
                  </table>
                <?php
                  }
                ?>
                
              </div>
              <div class="col-md-1"></div>
            </div>
            
          </div>
        </div>

        <div class="row">
          <div class="col-sm-2"></div>
          <div class="col-sm-8"><hr></div>
          <div class="col-sm-2"></div>
        </div>

        <div class="row">
          <div class="heading text-center col-sm-8 col-sm-offset-2 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
            <h2 style="font-weight: bolder;">VIEW ALL ASPIRANTS RESULT</h2>
          </div>
        </div>
        <div class="contact-form wow fadeIn" data-wow-duration="1000ms" data-wow-delay="600ms">
          <div class="row">
          	<div class="col-sm-3"></div>
            <div class="col-sm-6">
              <!-- <form action="<?php //secho htmlspecialchars($_SERVER['PHP_SELF']);?>"  method="post">
                <input type="submit" name="viewall" value="View All Aspirant Result">
              </form> -->
              <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"  method="post">
                        
                <div class="form-group">
                	<input type="submit" name="viewall" value="Display All Candidates Result" class="form-control btn-submit" />
                  <!-- <button type="submit" class="btn-submit">Send Now</button> -->
                </div>
              </form>
              <?php   
                if (isset($_POST['viewall'])) {
              ?>
                  <div class="row" style="font-size: 25px; text-align: center; padding: 15px;">Search Results for 2017 Candidates</div>
              <?php
                }
                ?>
            </div>
              <?php
                if (isset($_POST['viewall'])) {
                  $sn = 1;
                  $aspirants = $rofosa_inst->viewAllAspirants();
                  foreach ($aspirants as $aspirant) {
                    $aspirant_id = $aspirant['id'];
                    $result = $rofosa_inst->viewAspirantResult($aspirant_id);
                    $position = $aspirant['position'];
                    $name = $aspirant['surname']. ' '. $aspirant['othername'];
                    $rofosa_inst->storeAllAspirantsResult($result, $aspirant_id, $position, $name);
                  }
                  $aspirants_results = $rofosa_inst->getFinalResults();
              ?>

                      <table border="1 solid green" width="100%" style="text-align: center;">
                        <thead>
                          <th>S/no</th>
                          <th>Candidate</th>
                          <th>Position</th>
                          <th>Votes</th>
                        </thead>
                        <tbody>
              <?php
                    foreach ($aspirants_results as $aspirant) {
              ?>
                          <tr>
                            <td><?php echo $sn; ?></td>
                            <td><?php echo $aspirant['name']; ?></td>
                            <td><?php echo $aspirant['position']; ?></td>
                            <td><?php echo $aspirant['number_of_votes']; ?></td>
                          </tr>
              <?php
                      $sn++;
                      
                    }
              ?>
                        </tbody>
                      </table>
              <?php
                }
              ?>
            <div class="col-sm-3"></div>
          </div>
        </div>
      </div>
    </div>        
  </section><!--/#contact-->

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