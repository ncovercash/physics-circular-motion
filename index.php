<!DOCTYPE html>
<html>
	<head>
		<title>
			Circular Motion Project
		</title>
		
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/js/materialize.min.js" defer></script>
		<script src="//www.google.com/recaptcha/api.js" defer></script>
		
		<link href="//cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/css/materialize.min.css" rel="stylesheet"/>
		<link href="//fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
		<style type="text/css">
			.no-margin {
				margin: 0 !important;
			}

			.no-bottom-margin {
				margin-bottom: 0 !important;
			}

			a {
				font-weight: bolder;
				color: #1b5e20;
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
				background-color: #1b5e20;
			}

			input[type=range]::-webkit-slider-thumb {
				background-color: #1b5e20;
			}

			input[type=range]::-moz-range-thumb {
				background: #1b5e20;
			}

			input[type=range]::-ms-thumb {
				background: #1b5e20;
			}
		</style>
	</head>
	<body>
		<div class="container">
			<div class="section">
				<h2 class="header center">Circular Motion Project</h2>
				<h5 class="header center">The Noahs</h5>
				<h5 class="header center">Mr. Chintipalli's Physics Honors, Period 4</h5>
			</div>
			<div class="divider"></div>
			<div id="sec1" class="section">
				<div class="row">
					<div class="col s12 m7 l8">
						<canvas id="canvas" style="border: 1px solid black; border-radius: 0.4em;"></canvas>
					</div>
					<div class="col s12 m5 l4">
						<label for="range">Range label</label>
						<p class="range-field">
							<input type="range" id="range" min="0" max="10" step="0.01" value="0" />
						</p>
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
			}

			window.radius = 6*gridUnit; // 1m=1unit
			window.speed = 2*Math.PI/300; // rad/0.01 sec
			window.projectile = {
				x: center + radius*gridUnit, // px
				y: 0,
				angle: 0, // radians
				size: gridUnit*2 // 1m=1unit
			}

			window.animate = function() {
				// blank canvas
				context.fillStyle = "#fff";
				context.fillRect(0, 0, wh, wh);

				// increment for the iteration
				projectile.angle += speed;
				projectile.x = center + Math.cos(projectile.angle)*radius,
				projectile.y = center + Math.sin(projectile.angle)*radius,

				// draw frame
				drawLine(center, center, projectile.x, projectile.y);
				drawCircle(center, center, gridUnit/2, "#ccc");
				drawCircle(projectile.x, projectile.y, gridUnit, projectile.size, "#303f9f");

				setTimeout(animate, 10);
			};

			requestAnimationFrame(animate);
		});
	})(jQuery);
</script>

