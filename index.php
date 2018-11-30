<!DOCTYPE html>
<html>
	<head>
		<title>
			Circular Motion Project
		</title>
		
		<script src="jquery.min.js"></script>
		<script src="materialize.min.js" defer></script>
		
		<link href="materialize.min.css.php" rel="stylesheet"/>
		<style type="text/css">
			.no-margin {
				margin: 0 !important;
			}

			.no-bottom-margin {
				margin-bottom: 0 !important;
			}

			.no-top-margin {
				margin-top: 0 !important;
			}

			a {
				font-weight: bolder;
				color: #303f9f;
			}

			a:hover {
				text-decoration: underline;
			}

			.align-right {
				text-align: right;
			}

			.bold {
				font-weight: bold;
			}


			input[type=range] + .thumb {
				background-color: #303f9f;
			}

			input[type=range]::-webkit-slider-thumb {
				background-color: #303f9f;
			}

			input[type=range]::-moz-range-thumb {
				background: #303f9f;
			}

			input[type=range]::-ms-thumb {
				background: #303f9f;
			}

			.code-block {
				font-family: monospace;
				display: block;
				padding: 10px;
				margin: 10px;
				background-color: #f9f9f9;
			}

			.code-block * {
				font-family: monospace;
			}

			.code-block p {
				padding: 0;
				margin: 0;
			}

			.code-block p:empty {
				height: 1.5em;
			}

			.switch label input[type=checkbox]+.lever:after {
				background-color: #303f9f !important;
			}

			.switch label input[type=checkbox]+.lever {
				background-color: #9e9e9e !important;
			}
		</style>
	</head>
	<body>
		<div class="container">
			<div class="section">
				<h2 class="header center no-margin">Circular Motion Project</h2>
				<h5 class="header center no-bottom-margin">The Noahs</h5>
				<h5 class="header center no-top-margin">Mr. Chintipalli's Physics Honors, Period 4</h5>
			</div>
			<div class="divider"></div>
			<div class="section">
				<div class="row">
					<div class="col s12 m7 l8">
						<canvas id="canvas" style="border: 1px solid black; border-radius: 0.4em;"></canvas>
					</div>
					<div class="col s12 m5 l4">
						<label for="radius">Radius (m)</label>
						<p class="range-field">
							<input type="range" id="radius" min="0.1" max="12" step="0.1" value="6" />
						</p>
						<label for="mass">Mass (kg)</label>
						<p class="range-field">
							<input type="range" id="mass" min="0.2" max="25" step="0.1" value="5" />
						</p>
						<div class="switch">
							<label>
								Angular Speed
								<input type="checkbox" id="w-or-v">
								<span class="lever"></span>
								Velocity
							</label>
						</div>
						<label for="w-or-v-val">Angular Speed (rev/s)</label>
						<p class="range-field">
							<input type="range" id="w-or-v-val" min="0.05" max="3" step="0.05" value="0.6" />
						</p>
						<div class="divider"></div>
						<div class="code-block">
							<p>Measurements:</p>
							<p></p>
							<p>Radius: <span id="radius-val"></span></p>
							<p>Mass: <span id="mass-val"></span></p>
							<p>Angluar Speed: <span id="angular-speed-val"></span></p>
							<p>Angluar Speed: <span id="angular-speed-rps-val"></span></p>
							<p>Velocity: <span id="velocity-val"></span></p>
							<p>Centripetal Acceleration: <span id="acceleration-val"></span></p>
							<p>Centripetal Force: <span id="force-val"></span></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
<script type="text/javascript">
	(function($){
		$(function(){
			window.canvas = $("#canvas");

			// calculate proper dimensions (must be even) and center
			window.wh = Math.floor(window.canvas.parent().width()/24)*24;
			window.center = wh/2;

			// used for pretty aligning with different screen sizes
			window.gridUnit = wh/24;

			window.context = canvas.get(0).getContext("2d");
			context.canvas.width = wh;
			context.canvas.height = wh;
			
			window.drawCircle = function(x, y, r, fill="#4caf50") {
				context.beginPath();
				context.arc(x, y, r, 0, 2 * Math.PI, false);
				context.fillStyle = fill;
				context.fill();
				context.lineWidth = 1;
				context.strokeStyle = '#333';
				context.stroke();
			};

			window.drawLine = function(x1, y1, x2, y2) {
				context.beginPath();
				context.moveTo(x1,y1);
				context.lineTo(x2,y2);
				context.stroke();
			};

			window.prettyNumber = function(n) {
				return Math.round(n*10000)/10000;
			};

			window.radius = 6*gridUnit; // 1m=1unit
			window.speed = 2*Math.PI*0.6/100; // rad/0.01 sec
			window.projectile = {
				x: center + radius*gridUnit, // px
				y: 0,
				angle: 0, // radians
				size: 5*0.25*gridUnit // 1kg=0.25unit
			};

			window.lastSpeedSetting = "W";

			window.animate = function() {
				// blank canvas
				context.fillStyle = "#fff";
				context.fillRect(0, 0, wh, wh);

				// fill in parameters
				radius = document.getElementById("radius").value*gridUnit;
				projectile.size = document.getElementById("mass").value*gridUnit*0.25;
				if ($("#w-or-v").is(":checked")) {
					// velocity
					if (lastSpeedSetting == "V") {
						speed = document.getElementById("#w-or-v-val").value/100*gridUnit/radius;
					} else {
						$("label[for=w-or-v-val]").text("Velocity (m/s)");
						$("#w-or-v-val").attr("min", 0.1).attr("max", 220).attr("step", 0.1).val(Math.round(10*speed*100*(radius/gridUnit))/10);
					}
					lastSpeedSetting = "V";
				} else {
					// angular speed
					if (lastSpeedSetting == "W") {
						speed = 2*Math.PI*$("#w-or-v-val").val()/100;
					} else {
						$("label[for=w-or-v-val]").text("Angular Speed (rev/s)");
						$("#w-or-v-val").attr("min", 0.05).attr("max", 3).attr("step", 0.05).val(speed*100/(2*Math.PI));
					}
					lastSpeedSetting = "W";
				}

				// fill in measurements
				document.getElementById("radius-val").innerHTML = ""+prettyNumber(radius/gridUnit)+" m";
				document.getElementById("mass-val").innerHTML = ""+prettyNumber(4*projectile.size/gridUnit)+" kg";
				document.getElementById("angular-speed-val").innerHTML = ""+prettyNumber(speed*100/Math.PI)+"π rad/s";
				document.getElementById("angular-speed-rps-val").innerHTML = ""+prettyNumber(speed*100/(2*Math.PI))+" rev/s";
				var velocity = speed*100*(radius/gridUnit);
				document.getElementById("velocity-val").innerHTML = ""+prettyNumber(velocity)+" m/s";
				document.getElementById("acceleration-val").innerHTML = ""+prettyNumber(velocity*velocity/(radius/gridUnit))+" m/s²";
				document.getElementById("force-val").innerHTML = ""+prettyNumber((4*projectile.size/gridUnit)*velocity*velocity/(radius/gridUnit))+" N";

				// increment for the iteration
				projectile.angle += speed;
				projectile.x = center + Math.cos(projectile.angle)*radius,
				projectile.y = center + Math.sin(projectile.angle)*radius,

				// draw frame
				drawLine(center, center, projectile.x, projectile.y);
				drawCircle(center, center, gridUnit/2, "#ccc");
				drawCircle(projectile.x, projectile.y, projectile.size, "#303f9f");

				setTimeout(animate, 10);
			};

			requestAnimationFrame(animate);
		});
	})(jQuery);
</script>

