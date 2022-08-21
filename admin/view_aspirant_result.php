<?php
	include "class_lib/functions.php";

	$rofosa_inst= new Rofosa;

	if (isset($_POST['check'])) {
		$aspirant_id = $_POST['aspirant_id'];

		$result = $rofosa_inst->viewAspirantResult($aspirant_id);
		$aspirant= $rofosa_inst->findById($aspirant_id, 'aspirants');

		echo 'Total number of votes for '. $aspirant['surname']. ' '. $aspirant['othername'] .' is: '.$result. ' votes';
	}
?>
	<h2>View Selected Aspirants Result</h2>
	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
		<select name="aspirant_id">
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
		<input type="submit" name="check" value="View result">
	</form>


	<!-- $result = $rofosa_inst->viewAspirantResult($aspirant_id); -->

	<?php
		if (isset($_POST['viewall'])) {
			$aspirants = $rofosa_inst->viewAllAspirants();
				foreach ($aspirants as $aspirant) {
					$aspirant_id = $aspirant['id'];
					$result = $rofosa_inst->viewAspirantResult($aspirant_id);

					echo $aspirant['surname']. ' '. $aspirant['othername']. ' for position of '. $aspirant['position'].' ='. $result.'votes<br/>';
					$rofosa_inst->storeAllAspirantsResult($result, $aspirant_id);
				}
			
		}
	?>


	<h2>View All Aspirants Result</h2>
	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"  method="post">
		<input type="submit" name="viewall" value="View All Aspirant Result">
	</form>
