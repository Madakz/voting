<?php
  include "../class_lib/functions.php";

  $rofosa_inst= new Rofosa;
  if (!isset($_SESSION['surname']) && !isset($_SESSION['othername'])) {
       header("location:../index.php");
  }

  $error = "";
  if (isset($_POST['vote'])) {
    // print_r($_POST);
    // die();
        if(!isset($_POST['parliament'])){
          $error = "select three(3) parliament only";
        }
        if(!isset($_POST['auditor'])){
          $error = "select a auditor";
        }
        if(!isset($_POST['provost'])){
          $error = "select a provost";
        }
        if(!isset($_POST['d_welfare'])){
          $error = "select a director of welfare";
        }
        if(!isset($_POST['d_program'])){
          $error = "select a director of programs";
        }
        if(!isset($_POST['d_education'])){
          $error = "select a director of education";
        }
        if(!isset($_POST['treasurer'])){
          $error = "select a treasurer";
        }
        if(!isset($_POST['d_finance'])){
          $error = "select a director of finance";
        }
    if(!isset($_POST['secretary'])){
          $error = "select a secretary";
        }
    if(!isset($_POST['deputy_director'])){
            $error = "select a deputy director";
       }
    if(!isset($_POST['director'])){
          $error = "select a director";
        }elseif (empty($error)) {
          $director=strip_tags(trim($_POST['director']));
      $deputy_director=strip_tags(trim($_POST['deputy_director']));
      $secretary=strip_tags(trim($_POST['secretary']));
      $d_finance=strip_tags(trim($_POST['d_finance']));
      $treasurer=strip_tags(trim($_POST['treasurer']));
      $d_education=strip_tags(trim($_POST['d_education']));
      $d_program=strip_tags(trim($_POST['d_program']));
      $d_welfare=strip_tags(trim($_POST['d_welfare']));
      $provost=strip_tags(trim($_POST['provost']));
      $auditor=strip_tags(trim($_POST['auditor']));
      $voter_id=strip_tags(trim($_POST['voter']));

      $parliaments=$_POST['parliament'];    //passes the parliament array to parliaments      

      $parliament_e = '';
      foreach ($parliaments as $parliament) {
        $parliament_e .= $parliament. ",";    //concantenating the ids ofaspirants elected
      }

      $parliament_e = substr($parliament_e, 0, 8);   //this gets the string from index 0-7

      
      $aspirant_elect=explode(",", $parliament_e);  //split the array to get individual id on index 0,1,2

      $aspirant_elect []= $director;
      $aspirant_elect []= $deputy_director;
      $aspirant_elect []= $secretary;
      $aspirant_elect []= $treasurer;
      $aspirant_elect []= $d_finance;
      $aspirant_elect []= $d_education;
      $aspirant_elect []= $d_program;
      $aspirant_elect []= $d_welfare;
      $aspirant_elect []= $provost;
      $aspirant_elect []= $auditor;




      // print_r($aspirant_elect);
      // die();
      // $parliament_elect1 = $parliament_elect[0];
      // $parliament_elect2 = $parliament_elect[1];
      // $parliament_elect3 = $parliament_elect[2];

      // echo $auditor;

      foreach ($aspirant_elect as $elected_id) {
        $aspirant_record = $rofosa_inst->findById($elected_id, 'aspirants');

        $name = $aspirant_record['surname'].' '.$aspirant_record['othername'];


        $inserted = $rofosa_inst->voteAspirant($elected_id, $name, $voter_id);
        
      }

      if ($inserted) {
        header('location:../goodbye.php');
      }
    }   

  }

  $sn=1;
  $parliament_count = 1;
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
    <link id="../css-preset" href="css/presets/preset1.css" rel="stylesheet">
    <link href="../css/responsive.css" rel="stylesheet">

    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
    
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>
    <link rel="shortcut icon" href="../images/rfc2.jpg">
  </head><!--/head-->

  <style type="text/css">
    body{
      background-color: #E6E6FF;
    }
    #vote-body{
      background-image:url(../images/back.jpg);
      /*background-color: #E1E1E1;*/
      /*margin-top: 20px;  */
    }
    #ballot{
      background-color: #ffffff;
    }
    #ballot-header{
      padding-top: 10px;
    }
    #aspirant-name{
      font-size: 20px;
      padding-top: 20px
    }
    #logo-left{

    }
    #ballot-header #caption p{
      padding-top: 0px;
      margin-top: 0px;
      /*font-size: 20px;*/
      font-weight: bolder;
      text-align: center;
    }
    #logo-right{
      margin-left: x;
    }
    #paper p{
      text-align: center;
      font-weight: bold;
      margin-top: 17px;
      font-style: italic;
      font-family: sans-serif;
    }
    #aspirant-radio{
      padding-top: 5px;
    }

    .vr {
      width:1px;
      background-color:#000;
      position:absolute;
      top:0;
      bottom:0;
      left:150px;
    }
  hr {
      margin-top: 10px;
      margin-bottom: 0px;
      border: 0;
      border-top: 1px solid #6F339B;
    }
    #position-head p{
      padding-left: 20px;
      /*text-align: center;*/
      font-size: 20px;
      font-weight: bold;
      color: #0A0A2D;
    }
    #po-back{
      background-color: rgba(0, 0, 255, 0.1)
      /*background-color: hsla(120, 100%, 75%, 0.3);*/
      /*background-color: #D1D1E2;*/
      /*opacity: 0.5;
      filter: alpha(opacity=100);*/
    }


    .btn-success {
      display: block;
      width: 100%;
      margin-top: 20px;
      height: 34px;
      padding: 6px 12px;
      font-size: 14px;
      line-height: 1.42857143;
    }
  </style>

  <body>
    <div class="col-md-12" id="vote-body">
      <div class="col-md-3"></div>

      <!-- opening for main form content div -->
      <div class="col-md-6" id="ballot">
        <div style="text-align: center; background-color: #000; color:#fff; height: 20px;"><marquee> <?php echo $_SESSION['surname'] . " ". $_SESSION['othername']; ?> currently voting</marquee></div>
        <div class="row" id="ballot-header">
          <div class="col-md-2" id="logo-left"><img src="../images/slider/rfc2.jpg" style="height: 80px; width: 80px;"></div>
          <div class="col-md-8" id="caption">
            <p>ROCHAS FOUNDATION OLD STUDENTS ASSOCIATION</p><p>(ROFOSA)</p> <p>JOS BRANCH</p>
          </div>
          <div class="col-md-2" id="logo-right"><img src="../images/slider/rfc1.jpg" style="height: 80px; width: 8 0px;"></div>
        </div>
        <div class="row" id="paper"><p>~~ E-BALLOT PAPER ~~</p></div>
        <div class="row"><p style="color:red; padding: 5px;"> <b><u>>> INSTRUCTION: <<</u></b> Select <b>Only one</b> aspirant from each position by <i><b>clicking the button</b></i> closest to his/her name. The parliament position is an exception which allows for selection of <b>three (3) aspirants only.</b></p></div>

        <div class="row" style="color:red; text-align: center; font-size: 20px; margin-bottom:10px;"><?php echo $error; ?></div>
        <form method="POST" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
          <div class="row"><hr></div>


          <!-- DIRECTORrrrrrrrrrrrrrrrrrr -->
            <?php
              $director = $rofosa_inst->getPosition('director');
              $director  = $director['name'];
            ?> 
              <div class="row" id="po-back">
                <!-- <table width="100%" border="1px solid black">
                  
                </table> -->
                <div class="row" id="position-head"><p><?php echo strtoupper($director); ?></p></div>
                <?php
                  $aspirants = $rofosa_inst->viewAllAspirantsAndPosition($director);
                  foreach ($aspirants as $aspirant) {
                ?>
                    <div class="col-md-12">
                      <div class="col-md-4" id="aspirant-image">
                        <img src="../uploads/<?php echo $aspirant['picture']; ?>" style="height: 70px; width: 70px;"><hr width="1" size="500">
                        <vr />
                      </div>
                      <div class="col-md-4" id="aspirant-name">
                        <?php echo $aspirant['surname'] . ' ' . $aspirant['othername'];?>
                      </div>
                      <div class="col-md-4" id="aspirant-radio">
                        <input type="radio" name="director" value="<?php echo $aspirant['id']; ?>" class="form-control">
                      </div>
                    </div>
                <?php
                    $sn++;
                  }
                  
                ?>
              </div>
          <!-- DIRECTORrrrrrrrrrrrrrrrrrr -->

          <div class="row"><hr></div>

          <!-- DEPUTY DIRECTORrrrrrrrrrrrrrrrr -->

            <?php
              $deputy_director = $rofosa_inst->getPosition('deputy director');
              $deputy_director  = $deputy_director['name']; 
            ?>

            <div class="row" id="po-back">
              <!-- <table width="100%" border="1px solid black">
                
              </table> -->
              <div class="row" id="position-head"><p><?php echo strtoupper($deputy_director); ?></p></div>
              <?php
                $d_aspirants = $rofosa_inst->viewAllAspirantsAndPosition($deputy_director);
                foreach ($d_aspirants as $aspirant) {
              ?>
                <div class="col-md-12">
                  <div class="col-md-4" id="aspirant-image">
                    <img src="../uploads/<?php echo $aspirant['picture']; ?>" style="height: 70px; width: 70px;"><hr width="1" size="500">
                    <vr />
                  </div>
                  <div class="col-md-4" id="aspirant-name">
                    <?php echo $aspirant['surname'] . ' ' . $aspirant['othername'];?>
                  </div>
                  <div class="col-md-4" id="aspirant-radio">
                    <input type="radio" name="deputy_director" value="<?php echo $aspirant['id']; ?>" class="form-control">
                  </div>
                </div>
              <?php
                  $sn++;
                }
              ?>

            </div>
          <!-- DEPUTY DIRECTORrrrrrrrrrrrrrrrr -->

           <div class="row"><hr></div>

           <!-- SECRETARYyyyyyyyyyyyyyyyyyyyyy -->

              <?php
                $secretary = $rofosa_inst->getPosition('secretary');
                $secretary  = $secretary['name'];
              ?>

              <div class="row" id="po-back">
                <!-- <table width="100%" border="1px solid black">
                  
                </table> -->
                <div class="row" id="position-head"><p><?php echo strtoupper($secretary); ?></p></div>
                <?php
                  $sec_aspirants = $rofosa_inst->viewAllAspirantsAndPosition($secretary);
                  foreach ($sec_aspirants as $aspirant) {
                ?>
                    <div class="col-md-12">
                      <div class="col-md-4" id="aspirant-image">
                        <img src="../uploads/<?php echo $aspirant['picture']; ?>" style="height: 70px; width: 70px;"><hr width="1" size="500">
                        <vr />
                      </div>
                      <div class="col-md-4" id="aspirant-name">
                        <?php echo $aspirant['surname'] . ' ' . $aspirant['othername'];?>
                      </div>
                      <div class="col-md-4" id="aspirant-radio">
                        <input type="radio" name="secretary" value="<?php echo $aspirant['id']; ?>" class="form-control">
                      </div>
                    </div>
                <?php
                    $sn++;
                  }
                
              ?>
              </div>
            <!-- SECRETARYyyyyyyyyyyyyyyyyyyyyy -->


            <div class="row"><hr></div>

           <!-- FINANCEeeeeeeeeeeeeeeeee -->

              <?php
                $d_finance = $rofosa_inst->getPosition('director of finance');
                $d_finance  = $d_finance['name'];
              ?>

              <div class="row" id="po-back">
                <!-- <table width="100%" border="1px solid black">
                  
                </table> -->
                <div class="row" id="position-head"><p><?php echo strtoupper($d_finance); ?></p></div>
                <?php
                  $fin_aspirants = $rofosa_inst->viewAllAspirantsAndPosition($d_finance);
                  foreach ($fin_aspirants as $aspirant) {
                ?>
                    <div class="col-md-12">
                      <div class="col-md-4" id="aspirant-image">
                        <img src="../uploads/<?php echo $aspirant['picture']; ?>" style="height: 70px; width: 70px;"><hr width="1" size="500">
                        <vr />
                      </div>
                      <div class="col-md-4" id="aspirant-name">
                        <?php echo $aspirant['surname'] . ' ' . $aspirant['othername'];?>
                      </div>
                      <div class="col-md-4" id="aspirant-radio">
                        <input type="radio" name="d_finance" value="<?php echo $aspirant['id']; ?>" class="form-control">
                      </div>
                    </div>
                <?php
                    $sn++;
                  }
                
              ?>
              </div>
          <!-- FINANCEeeeeeeeeeeeeeeeee -->

          <div class="row"><hr></div>

           <!-- TREASURERrrrrrrrrrrrrrrrrrrrrr -->

              <?php
                $treasurer = $rofosa_inst->getPosition('treasurer');
                $treasurer  = $treasurer['name'];
              ?>

              <div class="row" id="po-back">
                <!-- <table width="100%" border="1px solid black">
                  
                </table> -->
                <div class="row" id="position-head"><p><?php echo strtoupper($treasurer); ?></p></div>
                <?php
                  $treasurer_aspirants = $rofosa_inst->viewAllAspirantsAndPosition($treasurer);
                  foreach ($treasurer_aspirants as $aspirant) {
                ?>
                    <div class="col-md-12">
                      <div class="col-md-4" id="aspirant-image">
                        <img src="../uploads/<?php echo $aspirant['picture']; ?>" style="height: 70px; width: 70px;"><hr width="1" size="500">
                        <vr />
                      </div>
                      <div class="col-md-4" id="aspirant-name">
                        <?php echo $aspirant['surname'] . ' ' . $aspirant['othername'];?>
                      </div>
                      <div class="col-md-4" id="aspirant-radio">
                        <input type="radio" name="treasurer" value="<?php echo $aspirant['id']; ?>" class="form-control">
                      </div>
                    </div>
                <?php
                    $sn++;
                  }
                
              ?>
              </div>
          <!-- TREASURERrrrrrrrrrrrrrrrrrrrrr -->

          <div class="row"><hr></div>

           <!-- EDUCATIONnnnnnnnnnnnnnnnnnnnnnn -->

              <?php
                $d_education = $rofosa_inst->getPosition('director of education');
                $d_education  = $d_education['name'];
              ?>

              <div class="row" id="po-back">
                <!-- <table width="100%" border="1px solid black">
                  
                </table> -->
                <div class="row" id="position-head"><p><?php echo strtoupper($d_education); ?></p></div>
                <?php
                  $edu_aspirants = $rofosa_inst->viewAllAspirantsAndPosition($d_education);
                  foreach ($edu_aspirants as $aspirant) {
                ?>
                    <div class="col-md-12">
                      <div class="col-md-4" id="aspirant-image">
                        <img src="../uploads/<?php echo $aspirant['picture']; ?>" style="height: 70px; width: 70px;"><hr width="1" size="500">
                        <vr />
                      </div>
                      <div class="col-md-4" id="aspirant-name">
                        <?php echo $aspirant['surname'] . ' ' . $aspirant['othername'];?>
                      </div>
                      <div class="col-md-4" id="aspirant-radio">
                        <input type="radio" name="d_education" value="<?php echo $aspirant['id']; ?>" class="form-control">
                      </div>
                    </div>
                <?php
                    $sn++;
                  }
                
              ?>
              </div>
          <!-- EDUCATIONnnnnnnnnnnnnnnnnnnnnnn -->

          <div class="row"><hr></div>

           <!-- PROGRAMmmmmmmmmmmmmmmmmmmmmmmmmm -->

              <?php
                $d_program = $rofosa_inst->getPosition('director of program');
                $d_program  = $d_program['name'];
              ?>

              <div class="row" id="po-back">
                <!-- <table width="100%" border="1px solid black">
                  
                </table> -->
                <div class="row" id="position-head"><p><?php echo strtoupper($d_program); ?></p></div>
                <?php
                  $program_aspirants = $rofosa_inst->viewAllAspirantsAndPosition($d_program);
                  foreach ($program_aspirants as $aspirant) {
                ?>
                    <div class="col-md-12">
                      <div class="col-md-4" id="aspirant-image">
                        <img src="../uploads/<?php echo $aspirant['picture']; ?>" style="height: 70px; width: 70px;"><hr width="1" size="500">
                        <vr />
                      </div>
                      <div class="col-md-4" id="aspirant-name">
                        <?php echo $aspirant['surname'] . ' ' . $aspirant['othername'];?>
                      </div>
                      <div class="col-md-4" id="aspirant-radio">
                        <input type="radio" name="d_program" value="<?php echo $aspirant['id']; ?>" class="form-control">
                      </div>
                    </div>
                <?php
                    $sn++;
                  }
                
              ?>
              </div>
          <!-- PROGRAMmmmmmmmmmmmmmmmmmmmmmmmmm -->

          <div class="row"><hr></div>

           <!-- WELFAREeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee -->

              <?php
                $d_welfare = $rofosa_inst->getPosition('director of welfare');
                $d_welfare  = $d_welfare['name'];
              ?>

              <div class="row" id="po-back">
                <!-- <table width="100%" border="1px solid black">
                  
                </table> -->
                <div class="row" id="position-head"><p><?php echo strtoupper($d_welfare); ?></p></div>
                <?php
                  $welfare_aspirants = $rofosa_inst->viewAllAspirantsAndPosition($d_welfare);
                  foreach ($welfare_aspirants as $aspirant) {
                ?>
                    <div class="col-md-12">
                      <div class="col-md-4" id="aspirant-image">
                        <img src="../uploads/<?php echo $aspirant['picture']; ?>" style="height: 70px; width: 70px;"><hr width="1" size="500">
                        <vr />
                      </div>
                      <div class="col-md-4" id="aspirant-name">
                        <?php echo $aspirant['surname'] . ' ' . $aspirant['othername'];?>
                      </div>
                      <div class="col-md-4" id="aspirant-radio">
                        <input type="radio" name="d_welfare" value="<?php echo $aspirant['id']; ?>" class="form-control">
                      </div>
                    </div>
                <?php
                    $sn++;
                  }
                
              ?>
              </div>
          <!-- WELFAREeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee -->


          <div class="row"><hr></div>

           <!-- PROVOSTtttttttttttttttttttttttttttttttttt -->

              <?php
                $provost = $rofosa_inst->getPosition('provost');
                $provost  = $provost['name'];
              ?>

              <div class="row" id="po-back">
                <!-- <table width="100%" border="1px solid black">
                  
                </table> -->
                <div class="row" id="position-head"><p><?php echo strtoupper($provost); ?></p></div>
                <?php
                  $pro_aspirants = $rofosa_inst->viewAllAspirantsAndPosition($provost);
                  foreach ($pro_aspirants as $aspirant) {
                ?>
                    <div class="col-md-12">
                      <div class="col-md-4" id="aspirant-image">
                        <img src="../uploads/<?php echo $aspirant['picture']; ?>" style="height: 70px; width: 70px;"><hr width="1" size="500">
                        <vr />
                      </div>
                      <div class="col-md-4" id="aspirant-name">
                        <?php echo $aspirant['surname'] . ' ' . $aspirant['othername'];?>
                      </div>
                      <div class="col-md-4" id="aspirant-radio">
                        <input type="radio" name="provost" value="<?php echo $aspirant['id']; ?>" class="form-control">
                      </div>
                    </div>
                <?php
                    $sn++;
                  }
                
              ?>
              </div>
          <!-- PROVOSTtttttttttttttttttttttttttttttttttt -->

          <div class="row"><hr></div>

           <!-- AUDITORrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrr -->

              <?php
                $auditor = $rofosa_inst->getPosition('auditor general');
                $auditor  = $auditor['name'];         
              ?>

              <div class="row" id="po-back">
                <!-- <table width="100%" border="1px solid black">
                  
                </table> -->
                <div class="row" id="position-head"><p><?php echo strtoupper($auditor); ?></p></div>
                <?php
                  $auditor_aspirants = $rofosa_inst->viewAllAspirantsAndPosition($auditor);
                  foreach ($auditor_aspirants as $aspirant) {
                ?>
                    <div class="col-md-12">
                      <div class="col-md-4" id="aspirant-image">
                        <img src="../uploads/<?php echo $aspirant['picture']; ?>" style="height: 70px; width: 70px;"><hr width="1" size="500">
                        <vr />
                      </div>
                      <div class="col-md-4" id="aspirant-name">
                        <?php echo $aspirant['surname'] . ' ' . $aspirant['othername'];?>
                      </div>
                      <div class="col-md-4" id="aspirant-radio">
                        <input type="radio" name="auditor" value="<?php echo $aspirant['id']; ?>" class="form-control">
                      </div>
                    </div>
                <?php
                    $sn++;
                  }
                
              ?>
              </div>
          <!-- AUDITORrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrr -->

          <div class="row"><hr></div>

           <!-- PARLIAMENTttttttttttttttttttttttttttttttttt -->

              <?php
                $parliament = $rofosa_inst->getPosition('parliament');
                $parliament  = $parliament['name'];         
              ?>

              <div class="row" id="po-back">
                <!-- <table width="100%" border="1px solid black">
                  
                </table> -->
                <div class="row" id="position-head"><p><?php echo strtoupper($parliament); ?></p></div>
                <?php
                  $parliament_aspirants = $rofosa_inst->viewAllAspirantsAndPosition($parliament);
                  foreach ($parliament_aspirants as $aspirant) {
                ?>
                    <div class="col-md-12">
                      <div class="col-md-4" id="aspirant-image">
                        <img src="../uploads/<?php echo $aspirant['picture']; ?>" style="height: 70px; width: 70px;"><hr width="1" size="500">
                        <vr />
                      </div>
                      <div class="col-md-4" id="aspirant-name">
                        <?php echo $aspirant['surname'] . ' ' . $aspirant['othername'];?>
                      </div>
                      <div class="col-md-4" id="aspirant-radio">
                        <input type="checkbox" name="parliament[<?php echo $parliament_count; ?>]" value="<?php echo $aspirant['id']; ?>" class="form-control">
                      </div>
                    </div>
                <?php
                    $parliament_count++;
                  }
                
              ?>
              </div>
          <!-- PARLIAMENTttttttttttttttttttttttttttttttttt -->


          <input type="hidden" name="voter" value="<?php echo $_SESSION['voter_id']; ?>">

        <div class="row"><hr></div>
        <div class="row" style="margin: 10px;">
          <input id="submit" type="submit" name="vote" value="Submit Ballot Paper" Placeholder="" class="btn-success">
        </div>
        
      </form>




        <div style="padding-left: 10px;">
          <p style="padding-bottom: 0px; margin-bottom: 0px; font-weight: bold;">Sign: </p>
          <img src="../images/sign.jpg" style="height: 25px; width: 80px">
          <p style="font-weight: bold;">RELCOM CHAIRMAN, JOS.</p>
        </div>

      </div> 
      <!-- closing for main form content div -->

      <div class="col-md-3"></div>
    </div>


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
