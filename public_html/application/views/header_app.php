<!DOCTYPE HTML>
<?  include('profile_header.php');?>




      <!--<script src="twitter-bootstrap-v2/docs/assets/js/jquery.js"></script>-->  


    <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>

                <!--<script src="http://static.scripting.com/github/bootstrap2/js/bootstrap.js"></script>-->
        <script type="text/javascript" src="../../bootstrap/js/bootstrap.js"></script>
		  <!--<link href="http://static.scripting.com/github/bootstrap2/css/bootstrap.css" rel="stylesheet">-->
        <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,400,600,700' rel='stylesheet' type='text/css'>
        <script type="text/javascript" charset="utf-8" src="mojotech/stickyMojo.js"></script>
	




    <!--<script src="http://static.scripting.com/github/bootstrap2/js/jquery.js"></script>-->
		<!--<script src="http://static.scripting.com/github/bootstrap2/js/bootstrap-transition.js"></script>-->
		<script src="http://scure.me/Chart.js-master/Chart.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>
		<script src="../../ajaxloader/ajaxloader.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Pathway+Gothic+One' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="css/styles2.css">
    <link rel="stylesheet" type="text/css" href="css/doc.css">
    <link rel="stylesheet" type="text/css" href="../../bootstrap/css/bootstrap.css">  
    <link rel="stylesheet" type="text/css" href="../../bootstrap/css/bootstrap-responsive.css">
		<link rel="stylesheet" type="text/css" href="Flat-UI-master/css/flat-ui.css">
		<link href='http://fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Advent+Pro:100' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Abel' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Lato:300' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>






<script type="text/javascript" src="jquery.touchSwipe.min.js"></script> 

<script type="text/javascript">  //FIGURE OUT HOW TO LINK FILE INSTEAD OF INCLUDING LIKE THIS

// Constructor
function AjaxLoader(id, options) {
    // Convert color Hex to RGB
    function HexToRGB(hex) {
        var shorthandRegex = /^#?([a-f\d])([a-f\d])([a-f\d])$/i;
        hex = hex.replace(shorthandRegex, function (m, r, g, b) {
            return r + r + g + g + b + b;
        });
        var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
        return result ? {
            r: parseInt(result[1], 16),
            g: parseInt(result[2], 16),
            b: parseInt(result[3], 16)
        } : null;
    }

    // Convert color RGB to Hex
    function RGBToHex(r, g, b) {
        return "#" + ((1 << 24) + (r << 16) + (g << 8) + b).toString(16).slice(1);
    }

    // Default options use when constructor's options are ommited
    var defaultOptions = {
        size: 32,       // Width and height of the spinner
        factor: 0.25,   // Factor of thickness, density, etc.
        speed: 1,       // Number of turns per second
        color: "#000",  // Color #rgb or #rrggbb
        clockwise: true // Direction of rotation
    }

    var size, factor, color, speed, clockwise,  // local options variables
        timer, rate = 0.0, deltaRate, segments, thickness, deltaAngle,
        fps = 30        // frames per second;
    if (options != null) {
        // Verify each field of the options
        size = "size" in options ? options.size : defaultOptions.size;
        factor = "factor" in options ? options.factor : defaultOptions.factor;
        color = HexToRGB("color" in options ? options.color : defaultOptions.color);
        speed = "speed" in options ? options.speed : defaultOptions.speed;
        clockwise = "clockwise" in options ? options.clockwise : defaultOptions.clockwise;
    } else {
        // Options are ommited, take it from default
        size = defaultOptions.size;
        factor = defaultOptions.factor;
        color = HexToRGB(defaultOptions.color);
        speed = defaultOptions.speed;
        clockwise = defaultOptions.clockwise;
    }

    var canvas = document.getElementById(id);
    if (canvas == null) {
        console.log("AjaxLoader Error! Cannot find canvas element by id '" + id + "'");
        return null;
    }
    var context = canvas.getContext("2d");
    Init();

    // Init all viriables
    function Init() {
        segments = (size >= 32) ? ((size >= 128) ? 72 : 36) : 18,
        thickness = 0.5 * size * factor,
        deltaAngle = 2.0 * Math.PI / segments;
        deltaRate = speed / fps;
        if (clockwise) {
            deltaRate = -deltaRate;
        }
        canvas.width = size;
        canvas.height = size;
    }

    // Draw ajaxloader
    function Draw(rate) {
        var angle = 2.0 * Math.PI * rate;
        var cosA = Math.cos(angle),
            sinA = Math.sin(angle),
            x0 = 0.5 * size * (1 + cosA),
            y0 = 0.5 * size * (1 - sinA),
            x1 = x0 - thickness * cosA,
            y1 = y0 + thickness * sinA;
        context.clearRect(0, 0, size, size);
        for (var i = 0; i < segments; i++) {
            context.beginPath();
            if (clockwise) {
                context.fillStyle = "rgba(" + color.r + "," + color.g + "," + color.b + "," + (segments - 1 - i) / (segments - 1) + ")";
            } else {
                context.fillStyle = "rgba(" + color.r + "," + color.g + "," + color.b + "," + i / (segments - 1) + ")";
            }
            context.moveTo(x0, y0);
            context.lineTo(x1, y1);
            angle += deltaAngle,
            cosA = Math.cos(angle);
            sinA = Math.sin(angle);
            x0 = 0.5 * size * (1 + cosA);
            y0 = 0.5 * size * (1 - sinA);
            x1 = x0 - thickness * cosA;
            y1 = y0 + thickness * sinA;
            context.lineTo(x1, y1);
            context.lineTo(x0, y0);
            context.closePath();
            context.fill();
        }
    }

    // Show and begin animation
    this.show = function () {
        canvas.removeAttribute("style");
        clearInterval(timer);
        timer = setInterval(function () {
            Draw(rate);
            rate += deltaRate;
            rate = rate - Math.floor(rate);
        }, 1000 / fps);
    }

    // Stop animation and hide indicator
    this.hide = function () {
        clearInterval(timer);
        canvas.style.display = "none";
    }

    this.getSize = function () {
        return size;
    }

    this.setSize = function (value) {
        size = value;
        Init();
    }

    this.getFactor = function () {
        return factor;
    }

    this.setFactor = function (value) {
        factor = value;
        Init();
    }

    this.getSpeed = function () {
        return speed;
    }

    this.setSpeed = function (value) {
        speed = value;
        Init();
    }

    this.getColor = function () {
        return RGBToHex(color.r, color.g, color.b);
    }

    this.setColor = function (value) {
        color = HexToRGB(value);
    }

    this.getClockwise = function () {
        return clockwise;
    }

    this.setClockwise = function (value) {
        clockwise = value;
        Init();
    }
}


</script>

  <link rel="stylesheet" href="/resources/demos/style.css" />

  
		<script>

		$(document).ready(function(){

			$('#hero_title').fadeOut(1);
			$('#hero_paragraph').fadeOut(1);
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
			$('#donut').hide();
      //1.  
      $('#dashboard').fadeOut(1);
      $('#dashboard').fadeIn(1700);
      $('#timeline_section').hide();

      $('#summary').fadeOut(1);
      $('#summary').fadeIn(3500);

			$('#hub_title').fadeIn(1000);

			$('#product_desc').fadeIn(2300);
			$('#temp_level').fadeIn(1800);
			$('#sound_level').fadeIn(2200);
			$('#traffic_level').fadeIn(2600);
			$('#visitor_level').fadeIn(2800);

			$('#temperature_value').fadeIn(3000);
			$('#decibel_value').fadeIn(3200);
			$('#traffic_value').fadeIn(3400);
			$('#visitor_value').fadeIn(3600);

    $('#dash0').hide().fadeIn(800);
    $('#dash1').hide().fadeIn(1000);
    $('#dash2').hide().fadeIn(1400);
    $('#dash3').hide().fadeIn(2000);

			$('#snapshot').fadeIn(1200);
			$('#room_temp').fadeIn(2000);
			
			$('#hero_title').fadeIn(2000);
			$('#hero_paragraph').fadeIn(3000);
			$('#hero_button').fadeIn(4500);
			$('#draggable').draggable();
			
/**
      $('#windowTitleDialog').bind('show', function () {
					document.getElementById ("xlInput").value = document.title;
					});**/

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


/**
	function closeDialog () {
				$('#myModal').modal('hide'); 
				};



			function okClicked () {
				document.title = document.getElementById ("xlInput").value;
				closeDialog ();
				};**/

		</script>



		
		









<!-- NAVBAR --><!--
<div class="navbar navbar-inverse navbar-fixed-top">  
  <div class="navbar-inner">  
    <div class="container">  
    <ul class="nav">  
  <li class="active">  
    <a class="brand" href="index.php">Scure <p style="font-size:8px; display:inline;">BETA</p></a>  
  </li>  
    <li><a href="#" onclick='return welcomeFade()'>Home</a></li>  

  <li><a href="#"onclick='return syncFade()'>Friends</a></li>

     <li><a href="" onclick='return settingFade()' > Settings </a></li>  
</ul>  




<ul class="nav pull-right">  
  <li>  
    <a href="logout" class="about"  data-toggle="dropdown">  
          Log Out 
    </a>  </li>
   
    </ul>  
  </li>  
</ul>  
    </div>  
  </div>  
</div>  
<!-- NAVBAR END -->






<!-- BODY BEGIN -->
<!--<body bgcolor="#2ecc71" style="background-image:url('http://scure.me/img/gray_tile.png'); background-attachment:fixed;">-->
  
    
    <style type="text/css">

      body, html {
          height: 100%;
          width:100%;
          margin: 0px;
          padding:0px;
          overflow-x:hidden;
          overflow:hidden;
          font-family: helvetica;
          font-weight: 100;

  -webkit-background-size: cover;  
  -moz-background-size: cover;  
  -o-background-size: cover;  
  background-size: cover;  
  -ms-filter: "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='http://media02.hongkiat.com/oversized-background-image-design/bg.jpg', sizingMethod='scale')";  
  filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='.http://media02.hongkiat.com/oversized-background-image-design/bg.jpg', sizingMethod='scale');




      }


  


      .friendContainer{

        border-top:dashed gray 1px;
        width:100%;
        margin-top:40px;
        height:400px;


      }

      .register-form{

        margin-top:30px;
        margin-bottom:30px;

      }

      .container {
          position: relative;
          height: 100%;
          width: 100%;
          left: 0;
          -webkit-transition:  left 0.4s ease-in-out;
          -moz-transition:  left 0.4s ease-in-out;
          -ms-transition:  left 0.4s ease-in-out;
          -o-transition:  left 0.4s ease-in-out;
          transition:  left 0.4s ease-in-out;
      }
      .container.open-sidebar {
          left: 240px;
      }
      
      .swipe-area {
          position: absolute;
          width: 50px;
          left: 0;
      top: 0;
          height: 100%;
          background: #f3f3f3;
          z-index: 0;
      }
      #sidebar {
          background: #DF314D;
          position: absolute;
          width: 240px;
          height: 100%;
          left: -240px;
          box-sizing: border-box;
          -moz-box-sizing: border-box;
      }
      #sidebar ul {
          margin: 0;
          padding: 0;
          list-style: none;
      }
      #sidebar ul li {
          margin: 0;
      }
      #sidebar ul li a {
          padding: 15px 20px;
          font-size: 16px;
          font-weight: 100;
          color: white;
          text-decoration: none;
          display: block;
          border-bottom: 1px solid #C9223D;
          -webkit-transition:  background 0.3s ease-in-out;
          -moz-transition:  background 0.3s ease-in-out;
          -ms-transition:  background 0.3s ease-in-out;
          -o-transition:  background 0.3s ease-in-out;
          transition:  background 0.3s ease-in-out;
      }
      #sidebar ul li:hover a {
          background: #C9223D;
      }
      .main-content {
          width: 100%;
          height: 100%;
          padding: 10px;
          box-sizing: border-box;
          -moz-box-sizing: border-box;
          position: relative;
      }
      .main-content .content{
          box-sizing: border-box;
          -moz-box-sizing: border-box;
      padding-left: 60px;
      width: 100%;
      }
      .main-content .content h1{
          font-weight: 100;
      }
      .main-content .content p{
          width: 100%;
          line-height: 160%;
      }
      .main-content #sidebar-toggle {
          background: #DF314D;
          border-radius: 3px;
          display: block;
          position: relative;
          padding: 10px 7px;
          float: left;
      }
      .main-content #sidebar-toggle .bar{
           display: block;
          width: 18px;
          margin-bottom: 3px;
          height: 2px;
          background-color: #fff;
          border-radius: 1px;   
      }
      .main-content #sidebar-toggle .bar:last-child{
           margin-bottom: 0;   
      }


      .btn-custom {
  background-color: hsl(9, 100%, 43%) !important;
  background-repeat: repeat-x;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#db2000", endColorstr="#db2000");
  background-image: -khtml-gradient(linear, left top, left bottom, from(#DF314D), to(#DF314D));
  background-image: -moz-linear-gradient(top, #DF314D, #DF314D);
  background-image: -ms-linear-gradient(top, #DF314D, #DF314D);
  background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #DF314D), color-stop(100%, #DF314D));
  background-image: -webkit-linear-gradient(top, #DF314D, #DF314D);
  background-image: -o-linear-gradient(top, #DF314D, #DF314D);
  background-image: linear-gradient(#DF314D, #DF314D);
  border-color: #db2000 #db2000 hsl(9, 100%, 43%);
  color: #fff !important;
  text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.00);
  -webkit-font-smoothing: antialiased;
}
    </style>
<!--
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js"></script>-->
<script src="ajaxloader/ajaxloader.js"></script>



 <script type="text/javascript">
      

      $(window).load(function(){
       


        $("[data-toggle]").click(function() {
          var toggle_el = $(this).data("toggle");
          $(toggle_el).toggleClass("open-sidebar");
        });
       

         $('#arm_button').click(function(){
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

$("#snapshot_select").click(function(){
  
  $('#donut').hide();
  $('#thumbnail_section').fadeOut(1);
  $('#thumbnail_section').fadeIn(1200);

});



$("#graph_select").click(function(){
        
  $('#thumbnail_section').hide();
  $('#donut').fadeIn(1200);

});



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


  $("#timeline_select").click(function(){
      
      $('#timeline_section').hide().fadeIn(2000);
      $('#main_profile').hide();
});


    $(".device_select").click(function(){
      $('#timeline_section').hide();
      $('#main_profile').hide().fadeIn(2000);
});

         $(".swipe-area").swipe({
              swipeStatus:function(event, phase, direction, distance, duration, fingers)
                  {
                      if (phase=="move" && direction =="right") {
                           $(".container").addClass("open-sidebar");
                           return false;
                      }
                      if (phase=="move" && direction =="left") {
                           $(".container").removeClass("open-sidebar");
                           return false;
                      }
                  }
          }); 
      });
      
    </script>


  </head>

