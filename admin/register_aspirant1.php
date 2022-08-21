<?php
	include '../class_lib/functions.php';

	// if (!isset($_SESSION['extension_agent_id']) && !isset($_SESSION['admin'])) {
	// 	header("location:../index.php");
	// }
	// if (!isset($_SESSION['extension_agent_id'])) {
	// 	$admin=$_SESSION['admin'];
	// }else{
	// 	$agent_id=$_SESSION['extension_agent_id'];
	// }

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


<div class="row">
	<div class="col-md-12">
		<h2 class="text-center features-text" style="color">Registration Form</h2>
	</div>
	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST" enctype="multipart/form-data">
	<div class="col-md-12" id="formfont">
		<div class="col-md-1"></div>

		<div class="col-md-10">
			<div class="col-md-12">
				<div style="text-align:center;"><i>All fields marked with the&nbsp;<em style="color:red;" >*</em>&nbsp; symbol are compulsory fields</i></div><br/>
				<h3  style="text-align:center; font-size:30px;">Personal Information</h3>
				<div class="row" style="color:red; text-align: centre; font-size: 20px; margin-bottom:10px;"><?php echo $error; ?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<label>Picture:&nbsp;<em style="color:red;" >*</em>&nbsp;</label>
						<input type="file" name="picture" value="">
				</div>
				<div class="col-md-8"></div>
			</div>
			<br/><br/>
			<div class="row">
				<div class="col-md-6">
					<label>Surname:&nbsp;<em style="color:red;" >*</em>&nbsp;</label>
						<input type="text" name="surname" value="<?php echo !empty($_POST['surname']) ? $_POST['surname'] : ""; ?>" Placeholder="surname" class="form-control">
				</div>
				<div class="col-md-6">
					<label>Other Names:&nbsp;<em style="color:red;" >*</em>&nbsp;</label>
						<input type="text" name="othername" value="<?php echo !empty($_POST['othername']) ? $_POST['othername'] : ""; ?>" Placeholder="othernames" class="form-control"><br/>
				</div>
			</div>
			
			<br/><br/>
			
			<div class="col-md-12">
				<h3  style="text-align:center; font-size:30px;">Contact information</h3><br/>
			</div>
			
			<div class="row">
				<div class="col-md-6">
					<label>Address:&nbsp;<em style="color:red;" >*</em>&nbsp;</label>
						<textarea cols="20" rows="6" name="address" value="<?php echo !empty($_POST['address']) ? $_POST['address'] : ""; ?>" Placeholder="address"  class="form-control"><?php echo !empty($_POST['address']) ? $_POST['address'] : ""; ?></textarea>
				</div>
				<div class="col-md-6">
					<div class="row" style="margin:0px 2px 0px 2px;">
						<label>Phone Number:&nbsp;<em style="color:red;" >*</em>&nbsp;</label>
						<input type="text" name="number" value="<?php echo !empty($_POST['number']) ? $_POST['number'] : ""; ?>" Placeholder="Phone Number" class="form-control"><br/>
					</div>							
				</div>
			</div>
			<br/><br/>

			<div class="col-md-12">
				<h3  style="text-align:center; font-size:30px;">General information</h3><br/>
			</div>
			<br/><br/>
			<div class="row">
				<div class="col-md-6">
					<label>Membership Number:</label>
						<input type="text" name="membership_number" value="<?php echo !empty($_POST['membership_number']) ? $_POST['membership_number'] : ""; ?>" Placeholder="Membership number" class="form-control">
				</div>
				<div class="col-md-6">
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
			<br/><br/>

			<div class="row">
				<div class="col-md-6">
					<label>Course of Study:</label>
						<input type="text" name="course" value="<?php echo !empty($_POST['course']) ? $_POST['course'] : ""; ?>" Placeholder="Course of Study" class="form-control">
				</div>
				<div class="col-md-6">
					<label>Institution of Study:</label>
						<input type="text" name="institution" value="<?php echo !empty($_POST['institution']) ? $_POST['institution'] : ""; ?>" Placeholder="Institution of Study" class="form-control">
				</div>						
			</div>

			<br/><br/>
			<div class="row">
				<div class="col-md-6">
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
			</div>

			<br/><br/>
			<div class="row">
				<div class="col-md-6">
					<label>Aspiration Reasons:&nbsp;<em style="color:red;" >*</em>&nbsp;</label>
						<textarea cols="20" rows="6" name="reasons" value="<?php echo !empty($_POST['reasons']) ? $_POST['reasons'] : ""; ?>" Placeholder="Aspiration reasons"  class="form-control"><?php echo !empty($_POST['reasons']) ? $_POST['reasons'] : ""; ?></textarea>
					<label>Possible Impacts:&nbsp;<em style="color:red;" >*</em>&nbsp;</label>
						<textarea cols="20" rows="6" name="impacts" value="<?php echo !empty($_POST['impacts']) ? $_POST['impacts'] : ""; ?>" Placeholder="Possible impacts"  class="form-control"><?php echo !empty($_POST['impacts']) ? $_POST['impacts'] : ""; ?></textarea>
				</div>
			</div>
			<br/><br/>
			<div class="row">
				<div class="col-md-3">
					<input id="submit" type="submit" name="submit" value="Submit" class="btn btn-primary">
				</div>
				<div class="col-md-9"></div>
			</div>
			
		</div>

		<div class="col-md-1"></div>
			
	</div>
	</form>		
</div>