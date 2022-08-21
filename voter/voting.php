<?php
	include "../class_lib/functions.php";

	echo $_SESSION['voter_id'] ." ". $_SESSION['surname'] . " ". $_SESSION['othername'];

	$rofosa_inst= new Rofosa;

	if (isset($_POST['vote'])) {
		// print_r($_POST);
		// die();
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


		if(empty($director)){
        	$error = "select a director";
        }

		$parliament_e = '';
		foreach ($parliaments as $parliament) {
			$parliament_e .= $parliament. ",";		//concantenating the ids ofaspirants elected
		}

		$parliament_e = substr($parliament_e, 0, -1);   //this is to remove the comma sign at the end of the string

		
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




		print_r($aspirant_elect);
		// $parliament_elect1 = $parliament_elect[0];
		// $parliament_elect2 = $parliament_elect[1];
		// $parliament_elect3 = $parliament_elect[2];

		// echo $auditor;

		foreach ($aspirant_elect as $elected_id) {
			$aspirant_record = $rofosa_inst->findById($elected_id, 'aspirants');

			$name = $aspirant_record['surname'].' '.$aspirant_record['othername'];

			$inserted = $rofosa_inst->voteAspirant($elected_id, $name, $voter_id);
		}

		echo $inserted;

		if ($inserted) {
			header('location:../goodbye.php');
		}

	}
?>