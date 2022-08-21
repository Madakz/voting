<?php
  include '../class_lib/functions.php';

  if (!isset($_SESSION['admin'])) {
     header("location:../index.php");
  }

  $rofosa_inst= new Rofosa;

  $error="";
  if (isset($_POST['submit'])) {
    $fileExtension = strrchr($_FILES['picture']['name'], ".");
    $surname=strip_tags(trim($_POST['surname']));
    $othername=strip_tags(trim($_POST['othername']));
    $membership_number=strip_tags($_POST['membership_number']);
    $address=strip_tags($_POST['address']);
    $course=strip_tags($_POST['course']);
    $institution=strip_tags($_POST['institution']);
    $reasons=strip_tags($_POST['reasons']);
    $impacts=strip_tags($_POST['impacts']);

    // die($_POST['form_price']);

    // $reg_time=date('d m Y h:i:s');


        if(empty($impacts)){
          $error = "please enter the Possible impacts";
        }
        if(empty($reasons)){
          $error = "please enter your Aspiration Reasons";
        }
        if(empty($_POST['position'])){
          $error = "please select the position";
        }else{
          $position=strip_tags($_POST['position']);
        }
        if(empty($_POST['form_price'])){
          $error = "please select the form price";
        }else{
          $form_price=strip_tags($_POST['form_price']);
        }
        $number=strip_tags($_POST['number']);
        if(empty($number) || !preg_match("/^[0-9]\d{10}$/",$number)){
          $error = "please enter a valid phone number";
        }
        if(empty($address)){
          $error = "please enter your Address";
        }
        if(empty($othername)){
          $error = "please enter your othernames";
        }
        if(empty($surname)){
          $error = "please enter your Surname";
        }
        if($_FILES['picture']['size']== 0){
          $error = "please select a picture";
        }
        if (empty($error)) 
          {
            $validExtensions = array('.jpg', '.jpeg', '.gif', '.png');
          // get extension of the uploaded file
          $fileExtension = strrchr($_FILES['picture']['name'], ".");
          // get the extension of the file to be uploaded
          // check if file Extension is on the list of allowed ones
          if (in_array($fileExtension, $validExtensions)) 
          {
              
          $newName = time() . '_' . $_FILES['picture']['name'];
                $destination = '../uploads/' . $newName;
          if (move_uploaded_file($_FILES['picture']['tmp_name'], $destination))
          {
            $rofosa_inst->save($surname, $othername, $newName, $address, $number, $form_price, $course, $institution, $position, $reasons, $impacts, $membership_number);
            echo "<script>alert('Aspirant succesfully added');</script>";
            }
          }
      }
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
            <img class="img-responsive" src="../images/rfc2.jpg" alt="logo" style="height: 80px; width: 80px; padding: 0px; margin: 0px;">        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">                 
            <li class="scroll active"><a href="register_aspirant.php">Register Aspirant</a></li>
            <!-- <li class="scroll"><a href="#services">View All Aspirant</a></li>  -->
            <li class="scroll"><a href="results.php">Electon Results</a></li>                     
            <li class="scroll"><a href="#">Aspirants</a></li>
            <li class="scroll"><a href="../logout.php">Logout</a></li>
            <!-- <li class="scroll"><a href="#team">Team</a></li>
            <li class="scroll"><a href="#blog">Blog</a></li>
            <li class="scroll"><a href="#contact">Contact</a></li> -->       
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
            <h2>REGISTER ASPIRANT</h2>
            <div style="text-align:center; font-size: 15px;"><i>All fields marked with the&nbsp;<em style="color:red;" >*</em>&nbsp; symbol are compulsory fields</i></div><br/>
          </div>
        </div>
        <div class="contact-form wow fadeIn" data-wow-duration="1000ms" data-wow-delay="600ms">
          <div class="row">
          	<div class="col-sm-3"></div>
            <div class="col-sm-6">
              <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST" enctype="multipart/form-data" id="main-contact-form" name="contact-form">
                <h3  style="text-align:center; font-size:30px;">Personal Information</h3>
                <div class="row" style="color:red; text-align: centre; font-size: 20px; margin-bottom:10px;"><?php echo $error; ?>
        </div>
                <div class="row  wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Surname:&nbsp;<em style="color:red;" >*</em>&nbsp;</label>
                        <input type="text" name="surname" value="<?php echo !empty($_POST['surname']) ? $_POST['surname'] : ""; ?>" Placeholder="surname" class="form-control" required="required">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Other Names:&nbsp;<em style="color:red;" >*</em>&nbsp;</label>
                        <input type="text" name="othername" value="<?php echo !empty($_POST['othername']) ? $_POST['othername'] : ""; ?>" Placeholder="othernames" class="form-control" required="required"><br/>
                    </div>
                  </div>
                </div>
                <div class="row  wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Picture:&nbsp;<em style="color:red;" >*</em>&nbsp;</label>
                        <input type="file" name="picture" value="" class="form-control">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Phone Number:&nbsp;<em style="color:red;" >*</em>&nbsp;</label>
                        <input type="text" name="number" value="<?php echo !empty($_POST['number']) ? $_POST['number'] : ""; ?>" Placeholder="Phone Number" class="form-control" required="required"><br/>
                    </div>
                  </div>                  
                </div>
                <div class="form-group">
                  <label>Address:&nbsp;<em style="color:red;" >*</em>&nbsp;</label>
                  <textarea rows="4" name="address" value="<?php echo !empty($_POST['address']) ? $_POST['address'] : ""; ?>" Placeholder="address" required="required" class="form-control"><?php echo !empty($_POST['address']) ? $_POST['address'] : ""; ?></textarea>
                </div>
                <div class="col-md-12">
                  <h3  style="text-align:center; font-size:30px;">General information</h3><br/>
                </div>
                <div class="row  wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Membership Number:</label>
                        <input type="text" name="membership_number" value="<?php echo !empty($_POST['membership_number']) ? $_POST['membership_number'] : ""; ?>" Placeholder="Membership number" class="form-control">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Form Price:&nbsp;<em style="color:red;" >*</em>&nbsp;</label>
                        <select name="form_price" id="form_price" class="form-control" value="<?php echo !empty($_POST['form_price']) ? $_POST['form_price'] : ""; ?>">
                          <option value="">select amount</option>
                          <option value="4000">4000</option>
                          <option value="3500">3500</option>
                          <option value="3000">3000</option>
                          <option value="2500">2500</option>
                        </select> 
                    </div>
                  </div>
                </div>
                <div class="row  wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Course of Study:</label>
                        <input type="text" name="course" value="<?php echo !empty($_POST['course']) ? $_POST['course'] : ""; ?>" Placeholder="Course of Study" class="form-control">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Institution of Study:</label>
                      <input type="text" name="institution" value="<?php echo !empty($_POST['institution']) ? $_POST['institution'] : ""; ?>" Placeholder="Institution of Study" class="form-control">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label>Aspiring Position:&nbsp;<em style="color:red;" >*</em>&nbsp;</label>
                    <?php
                      $positions = $rofosa_inst->getAllPosition();
                    ?>
                    <select name="position" id="position" class="form-control" value="<?php echo !empty($_POST['position']) ? $_POST['position'] : ""; ?>">
                      <option value="">select position</option>
                      <?php
                        foreach ($positions as $position) {
                          $post = ucfirst($position['name']);
                      ?>
                          <option value="<?php echo $position['name']; ?>"><?php echo $post; ?></option>
                      <?php
                        }
                      ?>
                    </select> 
                </div>
                <div class="form-group">
                  <label>Aspiration Reasons:&nbsp;<em style="color:red;" >*</em>&nbsp;</label>
                    <textarea rows="4" name="reasons" value="<?php echo !empty($_POST['reasons']) ? $_POST['reasons'] : ""; ?>" Placeholder="Aspiration reasons"  class="form-control"><?php echo !empty($_POST['reasons']) ? $_POST['reasons'] : ""; ?></textarea>
                </div>   
                <div class="form-group">
                  <label>Possible Impacts:&nbsp;<em style="color:red;" >*</em>&nbsp;</label>
                    <textarea cols="20" rows="6" name="impacts" value="<?php echo !empty($_POST['impacts']) ? $_POST['impacts'] : ""; ?>" Placeholder="Possible impacts"  class="form-control"><?php echo !empty($_POST['impacts']) ? $_POST['impacts'] : ""; ?></textarea>
                </div>                     
                <div class="form-group">
                	<input type="submit" name="submit" value="Register Now	" class="form-control btn-submit" />
                </div>
              </form>   
            </div>
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

  <script type="text/javascript" src="../js/jquery.js"></script>
  <script type="text/javascript" src="../js/bootstrap.min.js"></script>
  <script type="text/javascript" src="../http://maps.google.com/maps/api/js?sensor=true"></script>
  <script type="text/javascript" src="../js/jquery.inview.min.js"></script>
  <script type="text/javascript" src="../js/wow.min.js"></script>
  <script type="text/javascript" src="../js/mousescroll.js"></script>
  <script type="text/javascript" src="../js/smoothscroll.js"></script>
  <script type="text/javascript" src="../js/jquery.countTo.js"></script>
  <script type="text/javascript" src="../js/lightbox.min.js"></script>
  <script type="text/javascript" src="../js/main.js"></script>

</body>
</html>