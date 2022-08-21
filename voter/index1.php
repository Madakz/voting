<?php
	include "../class_lib/functions.php";

	echo $_SESSION['voter_id'] ." ". $_SESSION['surname'] . " ". $_SESSION['othername'];
	$rofosa_inst= new Rofosa;

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

			$parliaments=$_POST['parliament'];		//passes the parliament array to parliaments			

			$parliament_e = '';
			foreach ($parliaments as $parliament) {
				$parliament_e .= $parliament. ",";		//concantenating the ids ofaspirants elected
			}

			$parliament_e = substr($parliament_e, 0, 8);   //this gets the string from index 0-7

			
			$aspirant_elect=explode(",", $parliament_e);	//split the array to get individual id on index 0,1,2

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
?>

welcome and vote

<a href="../logout.php">logout</a>
<br/><br/>


	<?php
		// if (!isset($_SESSION['extension_agent_id']) && !isset($_SESSION['admin'])) {
		// 	header("location:../index.php");
		// }
		// if (!isset($_SESSION['extension_agent_id'])) {
		// 	$admin=$_SESSION['admin'];
		// }else{
		// 	$agent_id=$_SESSION['extension_agent_id'];
		// }

		$sn=1;
		$parliament_count = 1;

	?>

	<div class="row" style="color:red; text-align: centre; font-size: 20px; margin-bottom:10px;"><?php echo $error; ?></div>

	<form method="POST" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
			<!-- DIRECTORrrrrrrrrrrrrrrrrrr -->

			<?php
				$director = $rofosa_inst->getPosition('director');
				$director  = $director['name'];	
				

				echo '<br/>'.strtoupper($director).'<br/>';

				$aspirants = $rofosa_inst->viewAllAspirantsAndPosition($director);
				foreach ($aspirants as $aspirant) {
			?>
				<input type="radio" name="director" value="<?php echo $aspirant['id']; ?>" ><?php echo $aspirant['surname'] . ' ' . $aspirant['othername'];?>
				<img src="../uploads/<?php echo $aspirant['picture']; ?>" style="height: 100px; width: 100px;">
				<br/><br/>
			<?php

					$sn++;
				}
				
			?>

			<!-- DIRECTORrrrrrrrrrrrrrrrrrrrrr -->



			<!-- DEPUTY DIRECTORrrrrrrrrrrrrrrrr -->

			<?php
				$deputy_director = $rofosa_inst->getPosition('deputy director');
				$deputy_director  = $deputy_director['name'];	
				

				echo '<br/>'.strtoupper($deputy_director).'<br/>';
				$d_aspirants = $rofosa_inst->viewAllAspirantsAndPosition($deputy_director);
				foreach ($d_aspirants as $aspirant) {
			?>
				<input type="radio" name="deputy_director" value="<?php echo $aspirant['id']; ?>" ><?php echo $aspirant['surname'] . ' ' . $aspirant['othername'];?>
				<img src="../uploads/<?php echo $aspirant['picture']; ?>" style="height: 100px; width: 100px;">
				<br/><br/>
			<?php

					$sn++;
				}
				
			?>

			<!-- DEPUTY DIRECTORrrrrrrrrrrrrrrrr -->



			<!-- SECRETARYyyyyyyyyyyyyyyyyyyyyy -->

			<?php
				$secretary = $rofosa_inst->getPosition('secretary');
				$secretary  = $secretary['name'];	
				

				echo '<br/>'.strtoupper($secretary).'<br/>';
				$sec_aspirants = $rofosa_inst->viewAllAspirantsAndPosition($secretary);
				foreach ($sec_aspirants as $aspirant) {
			?>
				<input type="radio" name="secretary" value="<?php echo $aspirant['id']; ?>" ><?php echo $aspirant['surname'] . ' ' . $aspirant['othername'];?>
				<img src="../uploads/<?php echo $aspirant['picture']; ?>" style="height: 100px; width: 100px;">
				<br/><br/>
			<?php

					$sn++;
				}
				
			?>

			<!-- SECRETARYyyyyyyyyyyyyyyyyyyyyy -->



			<!-- FINANCEeeeeeeeeeeeeeeeee -->

			<?php
				$d_finance = $rofosa_inst->getPosition('director of finance');
				$d_finance  = $d_finance['name'];	
				

				echo '<br/>'.strtoupper($d_finance).'<br/>';
				$fin_aspirants = $rofosa_inst->viewAllAspirantsAndPosition($d_finance);
				foreach ($fin_aspirants as $aspirant) {
			?>
				<input type="radio" name="d_finance" value="<?php echo $aspirant['id']; ?>" ><?php echo $aspirant['surname'] . ' ' . $aspirant['othername'];?>
				<img src="../uploads/<?php echo $aspirant['picture']; ?>" style="height: 100px; width: 100px;">
				<br/><br/>
			<?php

					$sn++;
				}
				
			?>

			<!-- FINANCEeeeeeeeeeeeeeeeee -->



			<!-- TREASURERrrrrrrrrrrrrrrrrrrrrr -->

			<?php
				$treasurer = $rofosa_inst->getPosition('treasurer');
				$treasurer  = $treasurer['name'];	
				

				echo '<br/>'.strtoupper($treasurer).'<br/>';
				$treasurer_aspirants = $rofosa_inst->viewAllAspirantsAndPosition($treasurer);
				foreach ($treasurer_aspirants as $aspirant) {
			?>
				<input type="radio" name="treasurer" value="<?php echo $aspirant['id']; ?>" ><?php echo $aspirant['surname'] . ' ' . $aspirant['othername'];?>
				<img src="../uploads/<?php echo $aspirant['picture']; ?>" style="height: 100px; width: 100px;">
				<br/><br/>
			<?php

					$sn++;
				}
				
			?>

			<!-- TREASURERrrrrrrrrrrrrrrrrrrrrr -->



			<!-- EDUCATIONnnnnnnnnnnnnnnnnnnnnnn -->

			<?php
				$d_education = $rofosa_inst->getPosition('director of education');
				$d_education  = $d_education['name'];	
				

				echo '<br/>'.strtoupper($d_education).'<br/>';
				$edu_aspirants = $rofosa_inst->viewAllAspirantsAndPosition($d_education);
				foreach ($edu_aspirants as $aspirant) {
			?>
				<input type="radio" name="d_education" value="<?php echo $aspirant['id']; ?>" ><?php echo $aspirant['surname'] . ' ' . $aspirant['othername'];?>
				<img src="../uploads/<?php echo $aspirant['picture']; ?>" style="height: 100px; width: 100px;">
				<br/><br/>
			<?php

					$sn++;
				}
				
			?>

			<!-- EDUCATIONnnnnnnnnnnnnnnnnnnnnnn -->



			<!-- PROGRAMmmmmmmmmmmmmmmmmmmmmmmmmm -->

			<?php
				$d_program = $rofosa_inst->getPosition('director of program');
				$d_program  = $d_program['name'];	
				

				echo '<br/>'.strtoupper($d_program).'<br/>';
				$program_aspirants = $rofosa_inst->viewAllAspirantsAndPosition($d_program);
				foreach ($program_aspirants as $aspirant) {
			?>
				<input type="radio" name="d_program" value="<?php echo $aspirant['id']; ?>" ><?php echo $aspirant['surname'] . ' ' . $aspirant['othername'];?>
				<img src="../uploads/<?php echo $aspirant['picture']; ?>" style="height: 100px; width: 100px;">
				<br/><br/>
			<?php

					$sn++;
				}
				
			?>

			<!-- PROGRAMmmmmmmmmmmmmmmmmmmmmmmmmm -->



			<!-- WELFAREeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee -->

			<?php
				$d_welfare = $rofosa_inst->getPosition('director of welfare');
				$d_welfare  = $d_welfare['name'];	
				

				echo '<br/>'.strtoupper($d_welfare).'<br/>';
				$welfare_aspirants = $rofosa_inst->viewAllAspirantsAndPosition($d_welfare);
				foreach ($welfare_aspirants as $aspirant) {
			?>
				<input type="radio" name="d_welfare" value="<?php echo $aspirant['id']; ?>" ><?php echo $aspirant['surname'] . ' ' . $aspirant['othername'];?>
				<img src="../uploads/<?php echo $aspirant['picture']; ?>" style="height: 100px; width: 100px;">
				<br/><br/>
			<?php

					$sn++;
				}
				
			?>

			<!-- WELFAREeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee -->



			<!-- PROVOSTtttttttttttttttttttttttttttttttttt -->

			<?php
				$provost = $rofosa_inst->getPosition('provost');
				$provost  = $provost['name'];	
				

				echo '<br/>'.strtoupper($provost).'<br/>';
				$pro_aspirants = $rofosa_inst->viewAllAspirantsAndPosition($provost);
				foreach ($pro_aspirants as $aspirant) {
			?>
				<input type="radio" name="provost" value="<?php echo $aspirant['id']; ?>" ><?php echo $aspirant['surname'] . ' ' . $aspirant['othername'];?>
				<img src="../uploads/<?php echo $aspirant['picture']; ?>" style="height: 100px; width: 100px;">
				<br/><br/>
			<?php

					$sn++;
				}
				
			?>

			<!-- PROVOSTtttttttttttttttttttttttttttttttttt -->



			<!-- AUDITORrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrr -->

			<?php
				$auditor = $rofosa_inst->getPosition('auditor general');
				$auditor  = $auditor['name'];	
				

				echo '<br/>'.strtoupper($auditor).'<br/>';
				$auditor_aspirants = $rofosa_inst->viewAllAspirantsAndPosition($auditor);
				foreach ($auditor_aspirants as $aspirant) {
			?>
				<input type="radio" name="auditor" value="<?php echo $aspirant['id']; ?>" ><?php echo $aspirant['surname'] . ' ' . $aspirant['othername'];?>
				<img src="../uploads/<?php echo $aspirant['picture']; ?>" style="height: 100px; width: 100px;">
				<br/><br/>
			<?php

					$sn++;
				}
				
			?>

			<!-- AUDITORrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrr -->



			<!-- PARLIAMENTttttttttttttttttttttttttttttttttt -->

			<?php
				$parliament = $rofosa_inst->getPosition('parliament');
				$parliament  = $parliament['name'];	
				

				echo '<br/>'.strtoupper($parliament).'<br/>';
				$parliament_aspirants = $rofosa_inst->viewAllAspirantsAndPosition($parliament);
				foreach ($parliament_aspirants as $aspirant) {
			?>
				<input type="checkbox" name="parliament[<?php echo $parliament_count; ?>]" value="<?php echo $aspirant['id']; ?>" ><?php echo $aspirant['surname'] . ' ' . $aspirant['othername'];?>
				<img src="../uploads/<?php echo $aspirant['picture']; ?>" style="height: 100px; width: 100px;">
				<br/><br/>
			<?php

					$parliament_count++;
				}
				
			?>

			<!-- PARLIAMENTttttttttttttttttttttttttttttttttt -->

			<input type="hidden" name="voter" value="<?php echo $_SESSION['voter_id']; ?>">


			<input id="submit" type="submit" name="vote" value="Submit Ballot Paper" Placeholder="" class="btn btn-warning">
	</form>