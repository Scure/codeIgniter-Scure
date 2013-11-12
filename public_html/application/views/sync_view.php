<? include('header_app.php');
	include('profile_header.php');
	$system_status = "Arm System";
	$id1  = isset($_SESSION['id_1']) ? $_SESSION['id_1'] : '0';
	$id2 = isset($_SESSION['id_2']) ? $_SESSION['id_2'] : '0';
	$id3 = isset($_SESSION['id_3']) ? $_SESSION['id_3'] : '0';
	$id4 = isset($_SESSION['id_4']) ? $_SESSION['id_4'] : '0';



?>



<body bgcolor="#03899C" style="background-image:url('http://scure.me/img/grey.png'); background-attachment:fixed;">



<div id="container1" style="margin-top:110px; padding:15px; background-color:white;">
	<!--<h1><? echo $_SESSION['username'];?></h1><br>-->
	


	<!--<ul class="nav nav-pills">
		 
		  <li>
		    <a href="#" onclick='return welcomeFade()' style="font-family: 'Lato', sans-serif; ">Home</a>
		  </li>

		  <li ><a href="#" onclick='return settingFade()' style="font-family: 'Lato', sans-serif; ">Settings</a></li>
		  <li class="#"><a href="#" style="font-family: 'Lato', sans-serif; ">Sync Device</a></li>
	</ul>
	<p class="footer"></p>


	<br><br>-->

	<!-- System Status -->
	
	<div id="body" style="height:700px;">
			<?php echo form_open('sync');?>	
	<h1>Register your Device</h1>

		<label for="soundSetting"></label>
		<input type="text" size="5" maxlength="5" id="deviceid1" name="deviceid1" style="display:inline; text-align:center;"/> -
		<input type="text" size="5" maxlength="5" id="deviceid2" name="deviceid2" style="display:inline; text-align:center;" />
-		<input type="text" size="5" maxlength="5" id="deviceid3" name="deviceid3" style="display:inline; text-align:center;" />
-		<input type="text" size="5" maxlength="5" id="deviceid4" name="deviceid4" style="display:inline; text-align:center;"/>

		<br><br>
	<input type="submit" class="btn btn-large btn-primary" value="Save">
	<?php echo form_close(); ?>

	<? 
		if(isset($_SESSION['id_1'])){

			echo "<h3>Devices Registered</h3>";

	?>
	<p class = "footer"></p><br>
	<?
			$string_id = $id1."-".$id2."-".$id3."-".$id4;

			$string_id = strtoupper ($string_id);
			echo "<h5>".$string_id."</h5>";
		}

	?>

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

















