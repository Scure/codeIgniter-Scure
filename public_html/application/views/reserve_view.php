<? include('header_landing.php');?>

<body>
<link rel="stylesheet" type="text/css" href="Flat-UI-master/css/flat-ui.css">

	<div align="center" style="width:700px; height:400px; margin-top:150px; margin-left:auto; padding:10px;margin-right:auto; background-color:rgba(255,255,255,0.7); border-radius:5px;">  

		<h1 style="font-family:'Source Sans Pro',sans-serif; font-weight:200;"> Thank You for Signing Up!</h1>
		<br>
		<h3 style="font-family:'Source Sans Pro',sans-serif; font-weight:200;">
		<?
			if(isset($_SESSION['email'])){

				  echo $_SESSION['email']; 

			}
		?>
		</h3>
		<br>
		<p style=" font-family: 'Lato', sans-serif; color:gray; font-size:18px; line-height:30px;">
		We will be updating you when Scure reaches some important milestones and then again when development is nearing completion!  
		<br><br>
		  <a href="http://scure.me" class="btn btn-danger" >Go Back</a>
		  <br><br>
		<?

			if(isset($_SESSION['reserveCount'])){

				echo "<strong>"; echo $_SESSION['reserveCount'];   echo "</strong>"; echo "  reservations made so far!";
			}
		?>
		</p>


	</div>



</body>

</html>













