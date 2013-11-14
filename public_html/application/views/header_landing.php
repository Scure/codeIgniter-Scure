<!DOCTYPE HTML>

<html style="height:100%;">
	<head>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js?ver=1.4.2"></script>

		<head profile="http://www.w3.org/2005/10/profile">
		<link rel="icon" type="image/png" href="http://example.com/myicon.png">
		<link href="http://static.scripting.com/github/bootstrap2/css/bootstrap.css" rel="stylesheet">
		<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,400,600,700' rel='stylesheet' type='text/css'>
		<script src="http://static.scripting.com/github/bootstrap2/js/jquery.js"></script>
		<script src="http://static.scripting.com/github/bootstrap2/js/bootstrap-transition.js"></script>
		<script src="http://static.scripting.com/github/bootstrap2/js/bootstrap-modal.js"></script>
		<script src="http://scure.me/Chart.js-master/Chart.js"></script>
		<script src="bootstrap/js/bootstrap.js"></script>
		<link href='http://fonts.googleapis.com/css?family=Pathway+Gothic+One' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">	
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-responsive.css">
		<!--<link rel="stylesheet" type="text/css" href="css/landingpage.css">-->
		<?/**3
		<!--<link rel="stylesheet" type="text/css" href="Flat-UI-master/js/application.js">-->
		<!--<link rel="stylesheet" type="text/css" href="Flat-UI-master/css/flat-ui.css">-->*/?>
		<link href='http://fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Advent+Pro:100' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Abel' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Lato:300' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
		<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
		<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>




		<script>

		$(document).ready(function(){

			//$('#hero_title').fadeOut(1);
			//$('#hero_paragraph').fadeOut(1);
			$('#hero_button').fadeOut(1);
			$('#room_temp').fadeOut(1);
			$('#snapshot').fadeOut(1);
			$('#temperature_value').fadeOut(1);
			$('#decibel_value').fadeOut(1);
			$('#traffic_value').fadeOut(1);
			$('#visitor_value').fadeOut(1);
			$('#temp_level').fadeOut(1);
			$('#sound_level').fadeOut(1);
			$('#traffic_level').fadeOut(1);
			$('#visitor_level').fadeOut(1);
			$('#hub_title').fadeOut(1);
			$('#summary').fadeOut(1);
			$('#hub_title').fadeIn(1000);
			$('#summary').fadeIn(1000);



			$('#product_desc').fadeIn(2300);

			$('#reserve_email').fadeIn(2600);
			$('#reserve_submit').fadeIn(2900);
			$('#temp_level').fadeIn(1800);
			$('#sound_level').fadeIn(2200);
			$('#traffic_level').fadeIn(2600);
			$('#visitor_level').fadeIn(2800);

			$('#temperature_value').fadeIn(3000);
			$('#decibel_value').fadeIn(3200);
			$('#traffic_value').fadeIn(3400);
			$('#visitor_value').fadeIn(3600);


			$('#snapshot').fadeIn(1200);
			$('#room_temp').fadeIn(2000);
			
			$('#hero_title').fadeIn(2000);
			$('#hero_paragraph').fadeIn(3000);
			$('#hero_button').fadeIn(4500);
			$('#draggable').draggable();
			$('#windowTitleDialog').bind('show', function () {
					document.getElementById ("xlInput").value = document.title;
					});

			$('#slideshow').cycle('fade');

  	
				$('section[data-type="background"]').each(function(){

						var $bgobj = $(this); 

						$(window).scroll(function(){

							var yPos = -($window.scrollTop() / $bgobj.data('speed'));

							var coords = '50%' + yPos + 'px';

							$bgobj.css({backgroundPosition: coords});

						});

				});
					document.createElement("article");
					document.createElement("section");
		});

	function closeDialog () {
				$('#myModal').modal('hide'); 
				};
			function okClicked () {
				document.title = document.getElementById ("xlInput").value;
				closeDialog ();
				};

		</script>



		
		




<div id="fb-root"></div>  
<script>


	(function(d, s, id) {  
	  var js, fjs = d.getElementsByTagName(s)[0];  
	  if (d.getElementById(id)) return;  
	  js = d.createElement(s); js.id = id;  
	  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1";  
	  fjs.parentNode.insertBefore(js, fjs);  
	}(document, 'script', 'facebook-jssdk'));

</script>  










<script src="twitter-bootstrap-v2/docs/assets/js/jquery.js"></script>  
<script src="twitter-bootstrap-v2/docs/assets/js/bootstrap-dropdown.js"></script>  
<script type="text/javascript">  
  (function() {  
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;  
    po.src = 'https://apis.google.com/js/plusone.js';  
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);  
  })();  
</script>  
	
<style type="text/css">

	/** RESET CSS in application/ **/

		




		#header{

			background:url(../images/headeer1-bg.jpg) 50% 0 repeat fixed; min-height: 150px;
			
			height: 150px;
			margin: auto;
			width: 100%;
			position:relative;
			padding:0px;
			border-bottom:2px solid #F0F0F0;
			margin:0; padding:0;
		
		}


		#header article{
			background:url(../images/login_bg.jpg) 50% 0 repeat fixed; min-height: 525px;

			height: 458px;
			position:absolute;
			text-align:left;
			margin:auto;
			top:75px;
			width:100%;
			color:black;
			font-size:60px;
			font-family: 'Roboto Slab', serif;
			font-family: 'Berkshire Swash', cursive;
			font-family: 'Rancho', cursive;
		}
		
		#dinner{
		
/*			background:url(../images/dinner2-bg.jpg) 50% 0 repeat fixed; min-height: 525px;*/
			background-color:white;
		
			height: 724px;
			margin: 0 auto;
			width: 100%;
			max-width:1920px;
			position:relative;
			-webkit-box-shadow: 0 0 50px rgba(0,0,0,0.8);
			box-shadow: 0 0 50px rgba(0,0,0,0.8);

		}


		#dinner article{

			height:800px;
			position:absolute;
			text-align:center;
			top:150px;
			width:100%;
			color:white;
			font-size:42px;
			font-family: 'Shadows Into Light Two', cursive;


		}

		#club{
		
			background:url(../images/whitebg.jpg) 50% 0 repeat fixed; min-height: 525px;
			height: 1225px;
			margin: 0 auto;
			width: 100%;
			max-width:1920px;
			position:relative;
			-webkit-box-shadow: 0 0 50px rgba(0,0,0,0.8);
			box-shadow: 0 0 50px rgba(0,0,0,0.8);

		}


		#club article{

			height:1000px;
			position:absolute;
			text-align:center;
			top:150px;
			width:100%;
						color:white;
			font-size:42px;
			font-family: 'Shadows Into Light Two', cursive;


		}
		
		#after{
		
			background:url(../images/after-bg.jpg) 50% 0 repeat fixed; min-height: 525px;
			height: 525px;
			margin: 0 auto;
			width: 100%;
			max-width:1920px;
			position:relative;
			-webkit-box-shadow: 0 0 50px rgba(0,0,0,0.8);
			box-shadow: 0 0 50px rgba(0,0,0,0.8);

		}


		#after article{

			height:458px;
			position:absolute;
			text-align:center;
			top:150px;
			width:100%;
			color:white;
			font-size:42px;
			font-family: 'Shadows Into Light Two', cursive;


		}
		#wrapper{
			
			
			color:black;
			height:600px;
			margin: 0 auto;
			width: 100%;
			max-width: 1920px;
			position:relative;
		}
		
		#home{

			background:url(../images/home-bg.jpg) 50% 0 repeat fixed; min-height: 450px;
			height: 450px;
			margin: 0 auto;
			width: 100%;
			max-width: 1920px;
			position:relative;
		}

		#home article{

			height: 458px;
			position:absolute;
			text-align:center;
			top:150px;
			width:100%;
			color:white;
			font-size:42px;
			font-family: 'Shadows Into Light Two', cursive;


		}

		#about{
		
			background:url(../images/goout2.jpg) 50% 0 repeat fixed; min-height: 525px;
			background:url(../images/ny_bg_1.jpg) 50% 0 repeat fixed; min-height: 450px;

			background-color:white;
			height: 750px;
			
			margin: 0 auto;
			width: 100%;
			max-width:1920px;
			position:relative;
			-webkit-box-shadow: 0 0 50px rgba(0,0,0,0.8);
			box-shadow: 0 0 50px rgba(0,0,0,0.8);

		}


		#about article{

			height:458px;
			position:absolute;
			text-align:center;
			top:150px;
			width:100%;
			color:white;
			font-size:42px;
			font-family: 'Shadows Into Light Two', cursive;


		}
		
				
		#about2Info{
		
			background:url(../images/cafe_4.jpg) 50% 0 repeat fixed; min-height: 450px;

			background-color:white;
			height: 750px;
			color: white;
			margin: 0 auto;
			width: 100%;
			max-width:1920px;
			position:relative;
			-webkit-box-shadow: 0 0 50px rgba(0,0,0,0.8);
			box-shadow: 0 0 50px rgba(0,0,0,0.8);

		}


		#about2Info article{

			height:458px;
			position:absolute;
			text-align:center;
			
			top:150px;
			width:100%;
			color:white;
			font-size:42px;
			font-family: 'Shadows Into Light Two', cursive;


		}
		
		
		
		#menuBar{
			
			
			font-size:14px;
			margin-left:10%;
			text-align:center;
			display: inline;
			font-family: 'Arimo', sans-serif;
		}
		
		#slideshow{
			
				margin-left:55%;
				margin-top:25px;
			
		}
		
		#loginDiv{
			
			border:1px solid gray; 
			width:400px; 
			height:200px; 
			margin-left:auto; 
			margin-right:auto;
			-webkit-box-shadow: 0 0 50px rgba(0,0,0,0.8);
			box-shadow: 0 0 50px rgba(0,0,0,0.8);
		    -moz-border-radius: 10px;
		    -webkit-border-radius: 10px;
		    border-radius: 10px;
		    margin-top:65px;
		    padding:70px;
		    background-color:white;
	
		}

		.homeContent {
		    height: 100%;
		    width: 100%;
		    position: relative;
		    margin: 0 auto;
		}

		#mainBG {
		   background: url(../img/bgbig.jpg) no-repeat scroll;
			background-position:center;
			background-size: cover;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
		}


@media only screen and (max-width: 1024px) and (orientation:landscape) {
   #mainBG { background: url(images/medium.jpg) 50% 0 no-repeat scroll !important;
	background-position:center;
	background-size: cover;
	-webkit-background-size: cover;
	-moz-background-size: cover;
	-o-background-size: cover;
}
}
@media only screen and (min-width: 768px) and (max-width: 991px) {
	#mainBG { background: url(images/medium.jpg) 50% 80% no-repeat scroll !important;
	background-position:center;
	background-size: cover;
	-webkit-background-size: cover;
	-moz-background-size: cover;
	-o-background-size: cover;
}
}
@media only screen and (min-width: 0px) and (max-width: 767px) {
	#mainBG { background: url(images/small.jpg) 75% 80% no-repeat scroll !important;
	background-position:center;
	background-size: cover;
	-webkit-background-size: cover;
	-moz-background-size: cover;
	-o-background-size: cover;
}
}
		
*::-webkit-input-placeholder {
    color: red;
}

*:-moz-placeholder {
    color: red;
}

*:-ms-input-placeholder {
    /* IE10+ */
    color: red;
}
body{
    /*background:url('../img/sfbridge.jpg') no-repeat center center;

	margin:0; padding:0;
    background-color:white;
    background-attachment:fixed;
    overflow:scroll;
    height:100%;
    background-size:cover;*/
}

	



</style>


</head>

	 	<!-- Modal -->
	

	





