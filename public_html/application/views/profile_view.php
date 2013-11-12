<? 
	include('header_app.php');

	$system_status = $_SESSION['system_status'];
	$daily_log_array = $_SESSION['daily_log_array'];
	$daily_log_time_array = $_SESSION['daily_log_time_array'];
	$sys_stat = $_SESSION['sys_stat'];
	$sys_temp = $_SESSION['sys_temp'];
    $date = date("m/d/y");


 	  $devices_registered = $_SESSION['devices_registered'];

	if($_SESSION['devices_registered'] == 0){

		$device_array = array();
		$device_names = array();
		$device_names_size = 0;

	}
	else{
	    
	    $device_array = $_SESSION['device_array'];
	    $device_names = $_SESSION['device_name_array'];
	    $device_array_size = sizeof($device_array);
	    $device_names_size = sizeof($device_names);
	    //need to add error handling for system temperature
	}
?>




  <body>

    <div class="container">
   



   	<div id="sidebar" >
   		  <!-- This will need to be dynamic from the controller --> 
          <ul>
          	<span style="font-family:'Source Sans Pro',sans-serif;">
            
          	<?
          	if($device_names_size != 0){

          		for($i=0;$i<$device_names_size;$i=$i+1){

          				echo "<li><a  href=\"#\" class=\"device_select\">".$device_names[$i]."</a></li>";
          		}
          	}
          	?>

              <li><a href="#" data-toggle="modal"data-target="#myModal">+</a></li>				<!--modal popup to add device -->
              <li><a href="#"  id="snapshot_select">Snapshot</a></li>				<!--modal popup to add device -->
              <li><a href="#"  id="graph_select">Graph Logs</a></li>				<!--modal popup to add device -->
              <li><a href="#"  id="timeline_select">Timeline</a></li>				<!--modal popup to add device -->

              <li><a href="logout">Sign Out</a></li></span>
          </ul>
      </div>
    
    



      <div class="main-content">
          <div class="swipe-area"></div>
          <a href="#" data-toggle=".container" id="sidebar-toggle">
              <span class="bar"></span>
              <span class="bar"></span>
              <span class="bar"></span>
          </a>
         


         <? if($devices_registered  <= 0){?>
        <!--  <section style="background-image:url(../../img/nullwallpaper.jpg); height: 1200px; width:100%; margin-top:-10px; border: solid 1px black; ">
          -->
          <section style="min-width:1000px;background-color:gray; height: 1200px; width:110%; margin-top:-10px; border: solid 1px black; ">

          <div style="margin-top:300px; margin-left:350px; margin-right:auto;">
		  <h1 style=" text-shadow: 0px 2px 3px #666;"> You haven't registered a device yet! :/ </h1>
		  <button class="btn btn-inverse btn-lg" data-toggle="modal" data-target="#myModal">Register a Device</button>
          <div class="content" style="display:none;">
        
         <?}else{?>


         <section style="background-image:url(../../img/bg5.jpg);  width:100%; margin-top:-10px; margin-left:20px;border: solid 1px black; ">
          
          <!--<section style="background-color:rgba(22,160,133,1); height: 1200px; width:100%; margin-top:-10px; border: solid 1px black;">
			-->
          <section style="background-color:rgba(0,0,0,0.6); height: 1200px; width:100%; margin-top:-10px; border: solid 1px black;">

          <div class="content" style="min-width:900px;">

         <? }?>


         <!-- Timeline --> 
         <div id="timeline_section" class ="row-fluid" align="center" style="min-width 800px;margin-top:0px; padding:5px; margin-left:52px;">
				  

				  <div class="span11" style="min-width:800px;padding:40px; padding-top:10px;background-color:rgba(255,255,255,1);height:500px; border: 1px solid #D0D0D0; -webkit-box-shadow: 0 0 8px #D0D0D0;"> 

				  <h1 id="timeline_title"style="text-align:left;font-family: 'Source Sans pro', sans-serif; font-weight:700; color:black;">Timeline<a class="btn " style="background:none;"id="timeline_refresh_button"><i class="icon-refresh "></i></a></h1>






				  </div>

         </div>




              <div id="main_profile"class="row-fluid" align="center" style=" min-width:1300px;margin-top:0px;padding:5px; margin-left:52px; ">
				 
				  <div class="span7" id="dashboard" style="min-width:800px;padding:40px; padding-top:10px;background-color:rgba(255,255,255,1);height:500px; border: 1px solid #D0D0D0; -webkit-box-shadow: 0 0 8px #D0D0D0;"> 
					

					<div style="float:right; width:400px;" id="donut"><canvas id="doughnut" height="350" width="350" ></canvas>
					</div>

						  <div class="thumbnail" id="thumbnail_section" style="float:right; width:400px;">
					                  <img src="../../img/bg11.jpg" alt="">
					                  <div class="caption">
					                    <h3 style="font-family:'Source Sans Pro',sans-serif; font-weight:700; color:black;">Recent Snapshot</h3>
					                    <p style="font-family:'Source Sans Pro',sans-serif;">This snapshot was taken 10 minutes ago.</p>
					                    <p><a href="#" class="btn btn-primary">Take&nbsp;<i class="icon-camera icon-white"></i></a> <a href="#" class="btn">Save&nbsp;<i class="icon-folder-open icon-white"></i></a></p>
					                  </div>
					              </div>



							<h1 id="hub_title"style="text-align:left;font-family: 'Source Sans pro', sans-serif; font-weight:700; color:black;">Dashboard  <a class="btn " style="background:none;"id="refresh_button"><i class="icon-refresh "></i></a></h1>
							<div style="text-align:left;">
							
							<? if($sys_stat == 1){?>    
							<h4 style="font-family: 'Abel', sans-serif;"> System Status: <span id="system_status_text"style="color:red;">Armed</span></h4>
							<input type="submit" class="btn btn-large btn-danger" id="arm_button" value="<?echo $system_status;?>"/>
						  	<canvas id="spinner" style="display:none; margin:auto;"></canvas>


							<?}else if($sys_stat == 0){?>
							<h4 style="font-family: 'Abel', sans-serif;"> System Status: <span id="system_status_text"style="color:green;">Unarmed</span></h4>
							<input type="submit" id="arm_button" class=" btn btn-success" value="<?echo $system_status;?>"/>
						  	<canvas id="spinner" style="display:none; margin:auto;"></canvas>


							<?}else{?>
							 <h4 style="font-family: 'Abel', sans-serif;"> System Status: <span id="system_status_text"style="color:gray;">Offline</span></h4>
							 <input type="submit" id="arm_button" class=" btn btn-inverse" value="<?echo $system_status;?>"/>
						  	<canvas id="spinner" style="display:none; margin:auto;"></canvas>
							<?}?>

				              <!--<div class="btn-toolbar" style="margin-top:25px;">
				                <div class="btn-group">
				                  <a class="btn btn-primary" href="#fakelink"><span class="fui-time"></span></a>
				                  <a class="btn btn-primary" href="#fakelink"><span class="fui-photo"></span></a>
				                  <a class="btn btn-primary active" href="#fakelink"><span class="fui-heart"></span></a>
				                  <a class="btn btn-primary" href="#fakelink"><span class="fui-eye"></span></a>
				                </div>
				              </div> --><!-- /toolbar -->
							
				          


				            <div style="margin-top:-10px">
							<h2 id="dash0"style="font-family: 'Open Sans', sans-serif; font-weight:300; color:white; text-align:left;"> What's going on at home?</h2>
							<br>
							<h4  style="font-family: 'Open Sans', sans-serif; font-weight:300; color:gray; text-align:left;" id="dash1"> <span style="color:black">Nancy</span> is here feeding the dog.</h4>
							<h4 id="dash2" style="font-family: 'Open Sans', sans-serif; font-weight:300; color:gray; text-align:left;"> Looks like <span style="color:black;">Nancy</span> just left.</h4>
							<h4 id="dash3" style="font-family: 'Open Sans', sans-serif; font-weight:300; color:gray; text-align:left;"><span style="color:black">Mark</span> is home from school.</h4>
							<h4 id="dash3" style="font-family: 'Open Sans', sans-serif; font-weight:300; color:gray; text-align:left;">Devices Registered: <? echo $devices_registered;?></h4>
							</div>
							</div> 
							

          			
							<br>


			
					</div><!-- end dashboard -->




					<div class="span4"  id="summary" align="left" style="min-width:400px;background-color:white; padding-left:0px; padding-top:15px; padding-left:15px;border: 1px solid #D0D0D0; -webkit-box-shadow: 0 0 8px #D0D0D0; height:500px; ">
						<!--<h3 style="font-family: 'Abel', sans-serif;">Settings for <? echo $date; ?></h3>-->
						

						<ul style="list-style-type:none; font-family: 'Source Sans Pro', sans-serif; font-weight:700; font-size:20px;" >
							<li>
						<h3 style="font-family: 'Source Sans Pro', sans-serif; font-weight:700; color:black;">Your Friends</h3><br>


							</li>
							<li>
								<a href="#" style="text-decoration:none; color:#95a5a6;font-family: 'Source Sans Pro', sans-serif; font-weight:700; font-size:24px;">
									<img src="../../img/garvin.jpg" style=" background-color:#218359;height:65px; border-radius: 550px;-webkit-border-radius: 250px;-moz-border-radius: 250px;"> &nbsp; &nbsp;Garvin
								</a>  
						
							</li>

							<br><br>
							
							<li>
								<a href="#" style="text-decoration:none; color:#95a5a6;font-family: 'Source Sans Pro', sans-serif; font-weight:700;font-size:24px;">
									<img src="../../img/anthony.jpg" style="background-color:#00AF64; height:65px; border-radius: 550px;-webkit-border-radius: 250px;-moz-border-radius: 250px;"> &nbsp; &nbsp;Anthony
								</a>
							</li>

							<li style="margin-top:30px;"><br>
								<button class="btn btn-large btn-primary" type="button" data-toggle="modal"data-target="#friendModal">Add a Friend <i class="icon-plus icon-white"></i></button>
							</li>

						</ul>

						<!--
						<ul id="update" style="overflow:hidden;font-family: 'Abel', sans-serif; margin-bottom:40px; width:400px; text-align:left; margin-top:0px;list-style-type:none; font-size:18px;height:200px;">
						<?	
							$length = sizeof($daily_log_array);


							for($i = 0 ; $i < $length ; $i = $i + 1){
								echo "<li style=\"font-family:'Open Sans',sans-serif; font-weight:300; color:black; \">";
								echo $daily_log_array[$i]." "; echo "<span style=\"color:red;\">".$daily_log_time_array[$i]."</span><br>";
								echo "</li>";
								echo "<br>";
												}			
						?>
						</ul>-->
					
<!--
						<br><br><br><br><br><br>
						<span class="alert alert-info">Summary will update as the day goes on!</span>-->
						<br><br>

	  				</div> <!-- end span4 right side dashboard-->

    

      </div> <!-- end top row fluid -->


	<div class ="row-fluid" align="center" style="margin-left:0px; margin-bottom:40px; margin-top:20px;">
		
		<div class="span3" style=" color:white; height:220px;">				
		<h2 id="temp_level" style="font-family: 'Source Sans Pro', sans-serif; font-weight:700; ">Temperature</h2>  
		<br>
		<h1 id="temperature_value" style="font-family: 'Source Sans Pro', sans-serif;font-weight:400;font-size:80px; "><? echo "<span id=\"temp\">"; echo $sys_temp; echo "</span>";?></h1>
		</div>
		
		<div class="span3" style=" color:white; height:220px;">				
		<h2 id="sound_level" style="font-family: 'Source Sans Pro', sans-serif; font-weight:700;"> Sound</h2>	
		<br>
		<h1 id="decibel_value" style="font-family: 'Source Sans Pro', sans-serif; font-weight:400;font-size:80px;"><? echo "42 dB";?></h1>
		</div>
		
		<div class="span3" style=" color:white; height:220px;">				
		<h2 id="traffic_level" style="font-family: 'Source Sans Pro', sans-serif; font-weight:700;">Motion</h2>	
		<br>
		<h1 id="traffic_value" style="font-family: 'Source Sans Pro', sans-serif; font-weight:400;font-size:80px; "><? echo "2";?></h1>
		</div>

		<div class="span3" style=" color:white; height:220px;">				
		<h2 id="visitor_level" style="font-family: 'Source Sans Pro', sans-serif; font-weight:700;">Visitors</h2>	
		<br>
		<h1 id="visitor_value" style="font-family:  'Source Sans Pro', sans-serif; font-weight:400; font-size:80px;"><? echo "2";?></h1>
		

		</div>


	</div>
     </section><!-- end background section --> 
</section>

    </div>














<!-- Modal -->
<div class="modal fade" id="friendModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <div align="center"><h4 class="modal-title" id="myModalLabel" style="font-family:'Source Sans Pro', sans-serif; font-weight:700;">Add a Friend</h4></div>
      </div>
      <div class="modal-body">

      		<div class="register-form" align="center">
					<?php echo form_open('welcome/addFriend');?>	

					<input type="text" name="friend_email" id="friend_email" placeholder="Search E-mail" maxlength="20"style=" display:block;width:300px;background-color:#F6F6F6;font-family: 'Noto Sans', sans-serif; font-weight:300; height:24px; font-size:18px; text-align:center;"/>
					<br>
					<input type="submit" class = "btn btn-danger btn-large  input-block-level" style="width:310px; background-color:#DF314D;" value="Add Friend" style=""/>

					<?php echo form_close(); ?>

				</div>









    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <div align="center"><h4 class="modal-title" id="myModalLabel" style="font-family:'Source Sans Pro', sans-serif; font-weight:700;">Register a New Device</h4></div>
      </div>
      <div class="modal-body">

      		<div class="register-form" align="center">
					<?php echo form_open('welcome/addNewDevice');?>	

					<input type="text" name="device_identifier" id="device_identifier" placeholder="Enter the 20-Digit Device ID" maxlength="20"style=" display:block;width:300px;background-color:#F6F6F6;font-family: 'Noto Sans', sans-serif; font-weight:300; height:24px; font-size:18px; text-align:center;"/>
					<input type="text" name="device_name" id="device_name" placeholder="Ex. Living Room" maxlength="25"style="display:block;width:300px;background-color:#F6F6F6; font-family: 'Noto Sans', sans-serif; font-weight:300;height:24px; font-size:18px; text-align:center; "/>
					<br>
					<input type="submit" class = "btn btn-danger btn-large  input-block-level" style="width:310px; background-color:#DF314D;" value="Add Device +" style=""/>

					<?php echo form_close(); ?>

				</div>









    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

  </body>
































	<script>

		var radarChartData = {
			labels : ["Motion","","Sound","","","Temperature",""],
			datasets : [
				{
					fillColor : "rgba(220,220,220,0.5)",
					strokeColor : "rgba(220,220,220,1)",
					pointColor : "rgba(220,220,220,1)",
					pointStrokeColor : "#fff",
					data : [65,59,90,81,56,55,40]
				},
				{
					fillColor : "rgba(151,187,205,0.5)",
					strokeColor : "rgba(151,187,205,1)",
					pointColor : "rgba(151,187,205,1)",
					pointStrokeColor : "#fff",
					data : [87,67,54,79,87,71,65]
				}
			]
			
		}

	var myRadar = new Chart(document.getElementById("radar").getContext("2d")).Radar(radarChartData,{scaleShowLabels : false, pointLabelFontSize : 10});
	



	var lineChartData = {
			labels : ["January","February","March","April","May","June","July"],
			datasets : [
				{
					fillColor : "rgba(220,220,220,0.5)",
					strokeColor : "rgba(220,220,220,1)",
					pointColor : "rgba(220,220,220,1)",
					pointStrokeColor : "#fff",
					data : [75,89,70,71,66,85,70]
				},
				{
					fillColor : "rgba(151,187,205,0.5)",
					strokeColor : "rgba(151,187,205,1)",
					pointColor : "rgba(151,187,205,1)",
					pointStrokeColor : "#fff",
					data : [78,68,70,79,76,87,90]
				}
			]
			
		}

	var myLine = new Chart(document.getElementById("canvas").getContext("2d")).Line(lineChartData);
	</script>
		<script>

		var doughnutData = [
				{
					value: 30,
					color:"#F7464A"
				},
				{
					value : 50,
					color : "#46BFBD"
				},
				{
					value : 100,
					color : "#FDB45C"
				},
				{
					value : 40,
					color : "#949FB1"
				},
				{
					value : 120,
					color : "#4D5360"
				}
			
			];

	var myDoughnut = new Chart(document.getElementById("doughnut").getContext("2d")).Doughnut(doughnutData);
	
	</script>

</html>




 









