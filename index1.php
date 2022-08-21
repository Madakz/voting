<?php
	include "class_lib/functions.php";

?>

<div class="col-md-12">
	<div class="col-md-4"></div>
	<div class="col-md-4 logbody" style="">
		<?php
		if(isset($_POST['sub']))		//checks if the submit button has been click
		{
			$phone_number = $_POST['phone_number'];		//initialize the phone_number with phone_number collected from the form input
			$password =$_POST['password'];		//initialize the password with password collected from the form input
			$login = new Rofosa;		//creating an object of the class
		?>
		<!-- use the object to call the Login function with arguments as phone_number and password -->
		<h4 style="color:red;"><?php echo $login->login($phone_number, $password);	}?></h4>
		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
			
			<h1><b>Login</b></h1>	
			<label>Phone Number:</label><input type="text" name="phone_number" placeholder="Enter Phone number" value="" class="form-control" /><br />
			<label>Password:</label><input type="password" name="password" placeholder="Enter Password" value="" class="form-control" />
			<br />
			<input type="submit" name="sub" value="Login" class="form-control btn btn-primary" />
		</form>
	</div>
</div>