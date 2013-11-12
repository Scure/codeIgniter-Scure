<!DOCTYPE HTML>

<html style="height:100px;">
	<head>
        <meta charset="utf-8">
        <meta http-equiv="cache-control" content="no-cache">
<meta http-equiv="cache-control" content="max-age=0" />
<meta http-equiv="cache-control" content="no-cache" />
        <title>Login</title>
        
        <? include('font_file.php');
           include('bootstrap_files.php');
        ?>

		<script src="../../ajaxloader/ajaxloader.js"></script>
        <link rel="stylesheet" type="text/css" href="css/login.css">
		<link rel="stylesheet" type="text/css" href="Flat-UI-master/css/flat-ui.css">
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>

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
			$('#summary').fadeOut(1);
			$('#hub_title').fadeIn(1000);
			$('#summary').fadeIn(1000);
            $('#slogan').hide().fadeIn(1300);

			$('#product_desc').fadeIn(2300);
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

  <style>label{display:block;} .errors{color:red;}

    
    #container{
        margin: 10px;
        border: 1px solid #D0D0D0;
        -webkit-box-shadow: 0 0 8px #D0D0D0;
    }
.wrapper {
  margin: 50px auto;
  width: 500px;
  height: 370px;
  background: white;
  border-radius: 10px;
  -webkit-box-shadow: 0px 0px 8px rgba(0,0,0,0.3);
  -moz-box-shadow:    0px 0px 8px rgba(0,0,0,0.3);
  box-shadow:         0px 0px 8px rgba(0,0,0,0.3);
  position: relative;
  z-index: 90;
}

.ribbon-wrapper-green {
  width: 85px;
  height: 88px;
  overflow: hidden;
  position: absolute;
  top: -3px;
  right: -3px;
}

.ribbon-green {
  font: bold 15px Sans-Serif;
  color: #333;
  text-align: center;
  text-shadow: rgba(255,255,255,0.5) 0px 1px 0px;
  -webkit-transform: rotate(45deg);
  -moz-transform:    rotate(45deg);
  -ms-transform:     rotate(45deg);
  -o-transform:      rotate(45deg);
  position: relative;
  padding: 7px 0;
  left: -5px;
  top: 15px;
  width: 120px;
  background-color: #BFDC7A;
  background-image: -webkit-gradient(linear, left top, left bottom, from(#BFDC7A), to(#8EBF45)); 
  background-image: -webkit-linear-gradient(top, #BFDC7A, #8EBF45); 
  background-image:    -moz-linear-gradient(top, #BFDC7A, #8EBF45); 
  background-image:     -ms-linear-gradient(top, #BFDC7A, #8EBF45); 
  background-image:      -o-linear-gradient(top, #BFDC7A, #8EBF45); 
  color: #6a6340;
  -webkit-box-shadow: 0px 0px 3px rgba(0,0,0,0.3);
  -moz-box-shadow:    0px 0px 3px rgba(0,0,0,0.3);
  box-shadow:         0px 0px 3px rgba(0,0,0,0.3);
}

.ribbon-green:before, .ribbon-green:after {
  content: "";
  border-top:   3px solid #6e8900;   
  border-left:  3px solid transparent;
  border-right: 3px solid transparent;
  position:absolute;
  bottom: -3px;
}

.ribbon-green:before {
  left: 0;
}
.ribbon-green:after {
  right: 0;
}



        </style>

	</head>
		
		



        <body style="background-color:#FFFFFF;">


<!-- NAVBAR -->
<div class="navbar navbar-inverse navbar-fixed-top">  
  <div class="navbar-inner">  
    <div class="container">  
    <ul class="nav">  
  <li class="active">  
    <a class="brand" href="index.php">Scure <p style="font-size:8px; display:inline;">BETA</p></a>  
  </li>  
    <li><a href="about">About Us</a></li>  

  <li><a href="blog">Updates <span class="badge badge-important">2</span></a></li>

<!--
  <li><a href="#">Pricing</a></li>  
  <li><a href="#">Contact</a></li>  
 -->
</ul>  
<ul class="nav">  
  <li class="dropdown">  
    <a href="#"  class="dropdown-toggle" data-toggle="dropdown"> Resources  
    <b class="caret"></b>  
    </a>  
	    <ul class="dropdown-menu">  
	     	<li><a href="#">Firmware</a></li>  
	  		<li><a href="#">Schematics</a></li>  
	  		<li><a href="#">Hardware / CAD </a></li>  
	    </ul>  
  </li>  
</ul>  
<!--
<form class="navbar-search pull-left">  
  <input type="text" class="search-query" placeholder="Search">  
</form> --> 
<ul class="nav pull-right">  
  <li class="dropdown">  
    <a href="admin" class="about"  data-toggle="dropdown">  
          Log in  
          <b class="caret"></b>  
    </a>  
    <ul class="dropdown-menu">  
     <li class="socials"><!-- Place this tag where you want the +1 button to render -->  
<g:plusone annotation="inline" width="150"></g:plusone>  
</li>  
  <li class="socials"><div class="fb-like" data-send="false" data-width="150" data-show-faces="true"></div></li>  
  <li class="socials"><a href="https://twitter.com/share" class="twitter-share-button">Tweet</a>  
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></li>  
    </ul>  
  </li>  
</ul>  
    </div>  
  </div>  
</div>  
<!-- NAVBAR END -->

<!--Migrate to external CSS --> 
<style type="text/css">

  









</style>







