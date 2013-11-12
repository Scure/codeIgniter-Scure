<? include('header_app.php');
	include('profile_header.php');
	$system_status = "Arm System";
	$soundSetting = isset($_SESSION['soundSetting']) ? $_SESSION['soundSetting'] : '0';
	$tempSetting = isset($_SESSION['tempSetting']) ? $_SESSION['tempSetting'] : '0';
	$motionSetting = isset($_SESSION['motionSetting']) ? $_SESSION['motionSetting'] : '0';


?>



<body bgcolor="#03899C" style="background-image:url('http://scure.me/img/grey.png'); background-attachment:fixed;">



<div id="container1" style="margin-top:110px; padding:15px; background-color:white;">
	<!--<h1><? echo $_SESSION['username'];?></h1><br>-->
	

	<!--
	<ul class="nav nav-pills">
		 
		  <li>
		    <a href="#" onclick='return welcomeFade()' style="font-family: 'Lato', sans-serif; font-size:24px;">Home</a>
		  </li>

		  <li class="active"><a href="#" style="font-family: 'Lato', sans-serif;">Settings</a></li>
		  <li><a href="#" onclick='return syncFade()' style="font-family: 'Lato', sans-serif; ">Sync Device</a></li>
	</ul>
	<p class="footer"></p>


	<br><br>-->






	<!-- System Status -->
	<h1>Unit Settings</h1>
	
	<div id="body" style="height:700px;">
		
	<?php echo form_open('settings/setNewSettings');?>	
		<label for="soundSetting">Audio Sensor Sensitivity</label>
		<input type="text" placeholder="Ex. 30 db" id="soundSetting" name="soundSetting" value="<?echo $soundSetting;?>"/>

		<label for="tempSetting">Temperature Sensor Sensitivity</label>
		<input type="text" placeholder="Ex. 80 F" id="soundSetting" name="tempSetting" value="<?echo $tempSetting;?>"/>
			
		<label for="motionSetting">Motion Sensor Sensitivity</label>
		<input type="text" placeholder="Ex. 1-5" id="soundSetting" name="motionSetting" value="<?echo $motionSetting;?>"/>
		<br>

		<input type="submit" class="btn btn-large btn-primary" value="Save"/>
	<?php echo form_close(); ?>
	</div>



	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
	<a href="logout" class="btn btn-large btn-primary">Logout</a>

  
</div>

<!--
	<div style="margin-left:50%; margin-top:-420px;">
		<h3>Alarm Trip Statistics</h3>
		<canvas id="radar" height="350" width="350" ></canvas>

		<h3>Average Home Temperatures</h3>
		<canvas id="canvas" height="350" width="500"></canvas>

	</div>
-->




</body>
</html>
















