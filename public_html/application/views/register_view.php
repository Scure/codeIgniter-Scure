<? include('header.php');?>

<head>


		<meta charset="utf-8">
		<title>Register</title>
		<style>label{display:block;} .errors{color:red;}</style>

	</head>
	<body>
	<div align="center" style="margin-top:200px;">
	<h1 style="line-height:30px;">Register a new account</h1>
	<br>
	
	<?php echo form_open('register');?>	
	
<p>		<input type="text" name="first_name" id="first_name" placeholder="First Name" style="height:30px;"/></p>
<p> 	<input type="text" name="last_name" id="last_name" placeholder="Last Name" style="height:30px;"/></p>



	<p>
		
		<input type="text" name="new_email_Address" id="new_email_Address" placeholder="Enter your E-Mail" style="height:30px;"/>
	</p>
	
	<p>

		<input type="password" name="new_password" id="new_password" placeholder="Enter a password"  style="height:30px;"/>
	
	</p>
	<?php echo form_submit('submit','Register');?>
	<?php echo form_close(); ?>

	<a href="admin">Already have an account? Login.</a>
</div>


	<div class="errors" align="center">
		<?php echo validation_errors();?> 
	</div>
	</body>
	</html>