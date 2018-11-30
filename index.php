<!DOCTYPE html>
<html>
	<head>
		<title>
			Circular Motion Project
		</title>
		
		<script src="jquery.min.js"></script>
		<script src="materialize.min.js" defer></script>
		
		<link href="materialize.min.css" rel="stylesheet"/>
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
						<label for="radius">Radius (m)</label>
						<p class="range-field">
							<input type="range" id="radius" min="0.1" max="12" step="0.1" value="6" />
						</p>
						<label for="mass">Mass (kg)</label>
						<p class="range-field">
							<input type="range" id="mass" min="0.2" max="25" step="0.1" value="5" />
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
			};

			window.prettyNumber = function(n) {
				return Math.round(n*10000)/10000;
			};

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

