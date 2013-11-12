<? include('login_header.php'); ?>




		<!--<body style="background-color:#27ae60;background-image:url('http://scure.me/img/grey.png');">-->

			<div align="center" style="margin-left:auto; margin-right:auto;">
			<? /**d
				<div class="span4" align="center"style="color:black; margin-top:200px; margin-left:80px;">
					<img src="../../img/login_logo.png" style="border:2px solid white;"/>
					<h2 id="slogan"style="font-family:'Source Sans Pro',sans-serif; font-weight:300;">Let's keep an eye on things together.</h2>
				</div> **/?>
				
				<div align="center"style="background-color:#FFFFFF;margin-top:200px; width:500px; margin-left:auto; margin-right:auto; padding:30px; -webkit-box-shadow: 0 0 8px #404040; border-radius:8px;">

							<h1 style="color:#e74c3c;font-family:'Source Sans Pro', sans-serif; font-weight:200;">Login</h1><br>
							<?php echo form_open('admin');?>	


								<input type="text" name="email_Address" id="email_address" placeholder="E-mail" size="15"style=" display:block;width:300px;background-color:#F6F6F6;font-family: 'Noto Sans', sans-serif; font-weight:700;height:22px; font-size:18px; text-align:center;"/>
								<!--<?echo form_input('email_Address', '', 'id="email_address"');?>-->

							
								<input type="password" name="password" id="password" placeholder="Password" size="15"style="display:block;width:300px;background-color:#F6F6F6; font-family: 'Noto Sans', sans-serif; font-weight:700;height:22px; font-size:18px; text-align:center; "/>
								<!--<?echo form_password('password', '', 'id="password"');?>-->
							<br>
							<input type="submit" class = "btn btn-danger btn-large  input-block-level" style="width:310px;" value="Login" style=""/>

							<?php echo form_close(); ?>
							
							<a href="register" style="color:black; font-family: 'Noto Sans', sans-serif; text-decoration:none;">Register for a New Account</a>
							<br><br><br>
				</div>
			 </div>

			<div class="errors" align="center">
				<?php echo validation_errors();?> 
			</div>

</body>
</html>

