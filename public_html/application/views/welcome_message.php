<? 
	include('header_app.php');

	$system_status = $_SESSION['system_status'];
	$daily_log_array = $_SESSION['daily_log_array'];
	$daily_log_time_array = $_SESSION['daily_log_time_array'];
	$sys_stat = $_SESSION['sys_stat'];
	$sys_temp = $_SESSION['sys_temp'];
    $date = date("m/d/y");


    //need to add error handling for system temperature

   	include('profile_header.php');

?>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js"></script>
<script src="ajaxloader/ajaxloader.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('#dash0').hide().fadeIn(800);
	$('#dash1').hide().fadeIn(1000);
	$('#dash2').hide().fadeIn(1400);
	$('#dash3').hide().fadeIn(2000);

	$("#refresh_button").click(function(){
	$('#dash0').hide().fadeIn(800);
	$('#dash1').hide().fadeIn(1000);
	$('#dash2').hide().fadeIn(1400);
	$('#dash3').hide().fadeIn(2000);
					$("#decibel_value").hide();
					$("#traffic_value").hide();
					$("#visitor_value").hide();
			$.ajax({

				url: "welcome/getTemperature",
				cache: false,
				dataType: 'text',
				success: function(html){	

					$("span#temp").fadeIn(1000);
					$("#decibel_value").fadeIn(1000);
					$("#traffic_value").fadeIn(2000);
					$("#visitor_value").fadeIn(3000);


				}//end function(html)

			}); // end ajax
});

	$("#arm_button").click(function(){
			var buttonStatus = $("#arm_button").val();
  			//We need to also handle loading to the database. 

			var opts = {
		    
		    size: 256,           // Width and height of the spinner
		    factor: 0.1,       // Factor of thickness, density, etc.
		    color: "#4080FF",      // Color #rgb or #rrggbb
		    speed: 0.8,         // Number of turns per second
		    clockwise: true     // Direction of rotation
			};

			var ajaxLoader = new AjaxLoader("spinner");
			ajaxLoader.show();

  			/** AJAX Live Loading Section **/ 
  			$.ajax({
  				url: "welcome/liveUpdateActivity",
  				cache: false,
  				success: function(html){
  					$("ul#update").append(html);
  					//$("ul#update li:last").fadeOut(0.5);
  					$("ul#update li:last").hide().fadeIn(2000);

  					var html_string = html;
  					buttonStatus = buttonStatus.toLowerCase();



  					
  					if(html_string.toLowerCase().indexOf("disarmed") != -1){

  								$("#arm_button").val("Arm System");
  							    $("#arm_button").addClass('btn-success').removeClass('btn-danger');
  							    $("#arm_button").addClass('btn-success').removeClass('btn-inverse');

  							    $("#system_status_text").html("Unarmed");
  							    $("#system_status_text").css("color","green");
  							    $("#system_status_text").hide().fadeIn(1000);

  					}
  					else if(html_string.toLowerCase().indexOf("armed")!= -1){

  							 $("#arm_button").val("Disarm System");
  							 $("#arm_button").addClass('btn-danger').removeClass('btn-success');
  							 $("#arm_button").addClass('btn-danger').removeClass('btn-inverse');

  							 $("#system_status_text").html("Armed");
  							 $("#system_status_text").css("color","red");
  							 $("#system_status_text").hide().fadeIn(1000);

  					}
  					else if(html_string.toLowerCase().indexOf("respond")!=-1){


			 				$("#arm_button").val("Connect");
  							 $("#arm_button").addClass('btn-inverse').removeClass('btn-success');
  							 	//document.getElementById("arm_button").disabled=true;

  							 $("#system_status_text").html("Offline");
  							 $("#system_status_text").css("color","gray");
  							 $("#system_status_text").hide().fadeIn(1000);


  					}

  					ajaxLoader.hide();

  				}

  			});//end AJAX
  	}); // end on click
});// end document ready

</script>


<!-- BODY BEGIN -->
<!--<body bgcolor="#2ecc71" style="background-image:url('http://scure.me/img/gray_tile.png'); background-attachment:fixed;">-->
<body bgcolor="#2ecc71" style="background-color:#444444; background-attachment:fixed;">


<div id="container1"style="margin-top:40px; padding:15px; ">


	<div id = "sidebar">
		<ul>
			<li><a href="#">Device 1 </a> </li>
			<li><a href="#"> + </a></li>
		</ul>

	</div>




	<!---<ul class="nav nav-pills">		 
		  <li class="active">
		  <a href="welcome" style="font-family: 'Lato', sans-serif; ">Home</a>
		  </li>
		  <li><a href="#"  onclick='return settingFade()' style="font-family: 'Lato', sans-serif; ">Settings</a></li>
		  <li><a href="#" onclick='return syncFade()' style="font-family: 'Lato', sans-serif; ">Sync Device</a></li>
	</ul>
	<p class="footer"></p>
	<br><br>-->

<div style="margin-top:40px; padding:15px; ">


<?
		$timezone = date_default_timezone_get();
		date_default_timezone_set($timezone);
		$time = time();
?>



<!-- SUMMARY/GRAPH SECTION -->

<div class="row-fluid" align="center" style=" margin-top:0px;padding:5px; ">
	 

	  <div class="span8" id="radarGraph" style="padding:40px; padding-top:10px;background-color:rgba(255,255,255,0.95);height:400px;border: 1px solid #D0D0D0; -webkit-box-shadow: 0 0 8px #D0D0D0;"> 

			<h1 id="hub_title"style="text-align:left;font-family: 'Abel', sans-serif;">Dashboard  <a class="btn " style="background:none;"id="refresh_button"><i class="icon-refresh "></i></a>
			</h1>
		
		<div style="text-align:left;">
		<? if($sys_stat == 1){?>    

		<h4 style="font-family: 'Abel', sans-serif;"> System Status: <span id="system_status_text"style="color:red;">Armed</span></h4>
		<input type="submit" class="btn btn-large btn-danger" id="arm_button" value="<?echo $system_status;?>"/>
	  	<canvas id="spinner" style="display:none; margin:auto;"></canvas>


		<?}else if($sys_stat == 0){?>

		<h4 style="font-family: 'Abel', sans-serif;"> System Status: <span id="system_status_text"style="color:green;">Unarmed</span></h4>
		 <input type="submit" id="arm_button" class=" btn-custom" value="<?echo $system_status;?>"/>
	  	<canvas id="spinner" style="display:none; margin:auto;"></canvas>


		<?}else{?>

		 <h4 style="font-family: 'Abel', sans-serif;"> System Status: <span id="system_status_text"style="color:gray;">Offline</span></h4>
		 <input type="submit" id="arm_button" class=" btn-custom" value="<?echo $system_status;?>"/>
	  	<canvas id="spinner" style="display:none; margin:auto;"></canvas>

		<?}?>
	</div>

<br>



<h2 id="dash0"style="font-family: 'Open Sans', sans-serif; font-weight:300; color:black; text-align:left;"> What's going on at home?</h2>
<br>
<h4  style="font-family: 'Open Sans', sans-serif; font-weight:300; color:gray; text-align:left;" id="dash1"> <span style="color:black">Nancy</span> is here feeding the dog.</h4>
<h4 id="dash2" style="font-family: 'Open Sans', sans-serif; font-weight:300; color:gray; text-align:left;"> Looks like <span style="color:black;">Nancy</span> just left.</h4>
<h4 id="dash3" style="font-family: 'Open Sans', sans-serif; font-weight:300; color:gray; text-align:left;"><span style="color:black">Mark</span> is home from school.</h4>



<br>
<!--
<h5 style="font-family: 'Open Sans', sans-serif; font-weight:300; color:gray; text-align:left;">What would you like to do?</h5>
			<!--<canvas id="doughnut" height="350" width="350" ></canvas>
			
			<div id="row-fluid" style="margin-top:20px;">

			<div class="span3" style="border:0px solid black;"><a href="#"><h6 style="font-family: 'Open Sans', sans-serif; font-weight:300;">Call Home</a></h6></div>
			<div class="span3" style="border:1px solid black;"></div>
			<div class="span3" style="border:1px solid black;"></div>
			<div class="span3" style="border:1px solid black;"></div>


		

			</div>
-->



	  </div><!--end span8 -->



	  <div class="span4"  id="summary" align="left" style="background-color:white;padding-left:75px;border: 1px solid #D0D0D0; -webkit-box-shadow: 0 0 8px #D0D0D0; height:400px; ">
			<h3 style="font-family: 'Abel', sans-serif;">Settings for <? echo $date; ?></h3>
			<p style="font-family: 'Abel', sans-serif; margin-bottom:0px; width:400px; text-align:left;"> <!-- get rid of margin bott -->
			<ul id="update" style="overflow:hidden;font-family: 'Abel', sans-serif; margin-bottom:40px; width:400px; text-align:left; margin-top:0px;list-style-type:none; font-size:18px;height:200px;">

<?	

			$length = sizeof($daily_log_array);


						for($i = 0 ; $i < $length ; $i = $i + 1){
							echo "<li style=\"font-family:'Open Sans',sans-serif; font-weight:300; color:black; font-size:12px;\">";
							echo $daily_log_array[$i]." "; echo "<span style=\"color:red;\">".$daily_log_time_array[$i]."</span><br>";
							echo "</li>";
							echo "<br>";

						}

			
?>

			</ul>
			</p>
			
		<span class="alert alert-info">Summary will update as the day goes on!</span>
		<br><br>

		

	  </div> <!-- end span6-->

</div><!--end rowfluid-->
<br>




	<div class ="row-fluid" align="center" style="margin-left:0px; margin-bottom:40px; margin-top:20px;">
		
		<div class="span3" style="background-color:#CC333F;  color:white; height:220px;">				
		<h2 id="temp_level" style="font-family: 'Source Sans Pro', sans-serif; font-weight:300; ">Temperature</h2>  
		<br>
		<h1 id="temperature_value" style="font-family: 'Source Sans Pro', sans-serif;font-weight:300; "><? echo "<span id=\"temp\">"; echo $sys_temp; echo "</span>";?></h1>
		</div>
		
		<div class="span3" style="background-color:rgba(0,160,176,0.8);  color:white; height:220px;">				
		<h2 id="sound_level" style="font-family: 'Source Sans Pro', sans-serif; font-weight:300;"> Sound</h2>	
		<br>
		<h1 id="decibel_value" style="font-family: 'Source Sans Pro', sans-serif; font-weight:300;"><? echo "42 dB";?></h1>
		</div>
		
		<div class="span3" style="background-color:rgba(235,104,65,0.8); color:white; height:220px;">				
		<h2 id="traffic_level" style="font-family: 'Source Sans Pro', sans-serif; font-weight:300;">Motion</h2>	
		<br>
		<h1 id="traffic_value" style="font-family: 'Source Sans Pro', sans-serif; font-weight:300; "><? echo "2";?></h1>
		</div>

		<div class="span3" style="background-color:#EDC951;  color:white; height:220px;">				
		<h2 id="visitor_level" style="font-family: 'Source Sans Pro', sans-serif; font-weight:300;">Visitors</h2>	
		<br>
		<h1 id="visitor_value" style="font-family:  'Source Sans Pro', sans-serif; font-weight:300;"><? echo "2";?></h1>
		

		</div>


	</div>

</div>

	<!-- END SNAPSHOT AREA --> 


<!--

<div class="row-fluid" align="center" style="-webkit-box-shadow: 0 0 8px #D0D0D0;background-color:white;margin-top:10px; margin-left:auto; margin-right:auto;">


	<h2 id="snapshot" style="font-family: 'Abel', sans-serif;">Week At-A-Glance (9/1/13 - 9/7/13)</h2>
	<br><br>


	  <div class="span3" style="width:150px;font-family: 'Abel', sans-serif;"> 
		    <ul style="text-align:left;">
	  		<li>Left Home      (9:21 AM)</li>
			<li>Arrived Home   (8:33 PM)</li>
			</ul>
			<a href="#">Details</a> 
			<h3>Mon.</h3>

	  </div>
	  <div class="span3" style="width:150px;font-family: 'Abel', sans-serif;">
				  		<ul style="text-align:left;">
	  		<li>Left Home      (9:21 AM)</li>
			<li>Arrived Home   (8:33 PM)</li>
			</ul>
			<a href="#">Details</a> 
				
			<h3>Wed.</h3>
			<p class="label label-important">Alarm Triggered	   (12:24 PM)</p>

	  </div>	 

	   <div class="span3" style="width:150px;font-family: 'Abel', sans-serif;">
					  		<ul style="text-align:left;">
	  		<li>Left Home      (9:21 AM)</li>
			<li>Arrived Home   (8:33 PM)</li>
			</ul>
			<a href="#">Details</a> 
			<h3>Thurs.</h3>
	  </div>
	     
	     <div class="span3" style="width:150px;font-family: 'Abel', sans-serif;">
						  		<ul style="text-align:left;">
	  		<li>Left Home      (9:21 AM)</li>
			<li>Arrived Home   (8:33 PM)</li>
			</ul>
			<a href="#">Details</a> 
			<h3>Fri.</h3>
	  </div>
	     
	        <div class="span3" style="width:150px;font-family: 'Abel', sans-serif;">
							  		<ul style="text-align:left;">
	  		<li>Left Home      (9:21 AM)</li>
			<li>Arrived Home   (8:33 PM)</li>
			</ul>
			<a href="#">Details</a> 
			<h3>Sat.</h3>
	  </div>

	  <div class="span3" style="width:150px;font-family: 'Abel', sans-serif;">
							  		<ul style="text-align:left;">
	  		<li>Left Home      (9:21 AM)</li>
			<li>Arrived Home   (8:33 PM)</li>
			</ul>
			<a href="#">Details</a> 

			<h3>Sun.</h3>
	  </div>
<br><br><br>

	</div>-->





</div>



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

</body>
</html>




 









