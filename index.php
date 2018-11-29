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
						<canvas class="col s12" id="canvas" style="border: 1px solid black; border-radius: 0.4em;"></canvas>
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

			// calculate proper dimensions and center
			var wh = window.canvas.parent().width();
			var center = wh/2;

			window.context = canvas.get(0).getContext("2d");
			context.canvas.width = wh;
			context.canvas.height = wh;
			

			// sample canvas interactions:
			/*var canvas1 = $("#canvas1")[0];
			var context1 = canvas1.getContext('2d');

			var animate1 = function() {
				context1.fillStyle = "#fff";
				context1.fillRect(0, 0, 500, 500);

				var boxesOfNo = [];

				var rangeVal = $("#range1").val();

				for (var i = 0; i < rangeVal**2; i++) {
					var size = 240/rangeVal;

					boxesOfNo.push({
						x: ((500/rangeVal)/2)-(size/2) + ((500/rangeVal)*(i%rangeVal)),
						y: ((500/rangeVal)/2)-(size/2) + ((500/rangeVal)*Math.floor(i/rangeVal)),
						w: size,
						h: size
					});
				}

				var noCircles = [];

				for (var i = 0; i < boxesOfNo.length; i++) {
					for (var j = 0; j < boxesOfNo[i].w; j+=16) {
						for (var k = 0; k < boxesOfNo[i].h; k+=16) {
							noCircles.push({
								x: boxesOfNo[i].x+j+8,
								y: boxesOfNo[i].y+k+8
							});
						}
					}
				}

				for (var i = 0; i < circles1.length; i++) {
					context1.beginPath();
					context1.arc(circles1[i].x, circles1[i].y, 8, 0, 2 * Math.PI, false);
					context1.fillStyle = '#4caf50';
					context1.fill();
					context1.lineWidth = 1;
					context1.strokeStyle = '#333';
					context1.stroke();

					if (circles1[i].x+4+circles1[i].dx >= 500 || circles1[i].x+circles1[i].dx-4 <= 0) {
						circles1[i].dx = -circles1[i].dx;
						circles1[i].x += circles1[i].dx;
					}
					if (circles1[i].y+4+circles1[i].dy >= 500 || circles1[i].y+circles1[i].dy-4 <= 0) {
						circles1[i].dy = -circles1[i].dy;
						circles1[i].y += circles1[i].dy;
					}

					for (var j = 0; j < boxesOfNo.length; j++) {
						if (circles1[i].x+8+circles1[i].dx >= boxesOfNo[j].x && circles1[i].x-8+circles1[i].dx <= boxesOfNo[j].x+boxesOfNo[j].w
							&& circles1[i].y+8 >= boxesOfNo[j].y && circles1[i].y-8 <= boxesOfNo[j].y+boxesOfNo[j].h) {
							circles1[i].dx = -circles1[i].dx;
							circles1[i].x += circles1[i].dx;
						}
						if (circles1[i].y+8+circles1[i].dy >= boxesOfNo[j].y && circles1[i].y-8+circles1[i].dy <= boxesOfNo[j].y+boxesOfNo[j].h
							&& circles1[i].x+8 >= boxesOfNo[j].x && circles1[i].x-8 <= boxesOfNo[j].x+boxesOfNo[j].w) {
							circles1[i].dy = -circles1[i].dy;
							circles1[i].y += circles1[i].dy;
						}
					}

					circles1[i].x += circles1[i].dx;
					circles1[i].y += circles1[i].dy;
				}

				for (var i = 0; i < boxesOfNo.length; i++) {
					context1.fillStyle = "#fff";
					context1.fillRect(boxesOfNo[i].x, boxesOfNo[i].y, boxesOfNo[i].w, boxesOfNo[i].h);
				}

				for (var i = 0; i < noCircles.length; i++) {
					context1.beginPath();
					context1.arc(noCircles[i].x, noCircles[i].y, 8, 0, 2 * Math.PI, false);
					context1.fillStyle = '#f44336';
					context1.fill();
					context1.lineWidth = 1;
					context1.strokeStyle = '#333';
					context1.stroke();
				}

				setTimeout(animate1, 20);
			};

			circles1 = [];

			for (var i = 0; i < 60; i++) {
				circles1.push({
					x: Math.random()*480+10,
					y: Math.random()*480+10,
					dx: (Math.random()*2 + 1)*(Math.random() > 0.5 ? -1 : 1),
					dy: (Math.random()*2 + 1)*(Math.random() > 0.5 ? -1 : 1)
				});
			}

			requestAnimationFrame(animate1);

			var canvas2 = $("#canvas2")[0];
			var context2 = canvas2.getContext('2d');

			var animate2 = function() {
				context2.fillStyle = "#fff";
				context2.fillRect(0, 0, 500, 500);

				var rangeVal = $("#range2").val();

				for (var i = 0; i < circles2green.length; i++) {
					context2.beginPath();
					context2.arc(circles2green[i].x, circles2green[i].y, 8, 0, 2 * Math.PI, false);
					context2.fillStyle = '#4caf50';
					context2.fill();
					context2.lineWidth = 1;
					context2.strokeStyle = '#333';
					context2.stroke();

					if (circles2green[i].x+4+circles2green[i].dx >= 500 || circles2green[i].x+circles2green[i].dx-4 <= 0) {
						circles2green[i].dx = -circles2green[i].dx;
						circles2green[i].x += circles2green[i].dx;
					}
					if (circles2green[i].y+4+circles2green[i].dy >= 500 || circles2green[i].y+circles2green[i].dy-4 <= 0) {
						circles2green[i].dy = -circles2green[i].dy;
						circles2green[i].y += circles2green[i].dy;
					}

					for (var j = 0; j < rangeVal; j++) {
						if (Math.sqrt(((circles2green[i].x+circles2green[i].dx-circles2red[j].x-circles2red[j].dx)**2)+((circles2green[i].y+circles2green[i].dy-circles2red[j].y-circles2red[j].dy)**2)) < 16) {
							circles2green[i].dx = -circles2green[i].dx;
							circles2green[i].x += circles2green[i].dx;
							circles2green[i].dy = -circles2green[i].dy;
							circles2green[i].y += circles2green[i].dy;

							circles2red[j].dx = -circles2red[j].dx;
							circles2red[j].x += circles2red[j].dx;
							circles2red[j].dy = -circles2red[j].dy;
							circles2red[j].y += circles2red[j].dy;
						}
					}

					circles2green[i].x += circles2green[i].dx;
					circles2green[i].y += circles2green[i].dy;
				}

				for (var i = 0; i < rangeVal; i++) {
					context2.beginPath();
					context2.arc(circles2red[i].x, circles2red[i].y, 8, 0, 2 * Math.PI, false);
					context2.fillStyle = '#f44336';
					context2.fill();
					context2.lineWidth = 1;
					context2.strokeStyle = '#333';
					context2.stroke();

					if (circles2red[i].x+4+circles2red[i].dx >= 500 || circles2red[i].x+circles2red[i].dx-4 <= 0) {
						circles2red[i].dx = -circles2red[i].dx;
						circles2red[i].x += circles2red[i].dx;
					}
					if (circles2red[i].y+4+circles2red[i].dy >= 500 || circles2red[i].y+circles2red[i].dy-4 <= 0) {
						circles2red[i].dy = -circles2red[i].dy;
						circles2red[i].y += circles2red[i].dy;
					}

					circles2red[i].x += circles2red[i].dx;
					circles2red[i].y += circles2red[i].dy;
				}

				setTimeout(animate2, 20);
			};

			circles2green = [];

			for (var i = 0; i < 60; i++) {
				circles2green.push({
					x: Math.random()*480+10,
					y: Math.random()*480+10,
					dx: (Math.random()*2 + 1)*(Math.random() > 0.5 ? -1 : 1),
					dy: (Math.random()*2 + 1)*(Math.random() > 0.5 ? -1 : 1)
				});
			}

			circles2red = [];

			for (var i = 0; i < 100; i++) {
				circles2red.push({
					x: Math.random()*480+10,
					y: Math.random()*480+10,
					dx: (Math.random()*2 + 1)*(Math.random() > 0.5 ? -1 : 1),
					dy: (Math.random()*2 + 1)*(Math.random() > 0.5 ? -1 : 1)
				});
			}

			requestAnimationFrame(animate2);

			var canvas3 = $("#canvas3")[0];
			var context3 = canvas3.getContext('2d');

			var animate3 = function() {
				context3.fillStyle = "#fff";
				context3.fillRect(0, 0, 500, 500);

				var rangeVal = $("#range3").val()/300;

				for (var i = 0; i < circles3green.length; i++) {
					context3.beginPath();
					context3.arc(circles3green[i].x, circles3green[i].y, 8, 0, 2 * Math.PI, false);
					context3.fillStyle = '#4caf50';
					context3.fill();
					context3.lineWidth = 1;
					context3.strokeStyle = '#333';
					context3.stroke();

					if (rangeVal==0) {
						continue;
					}

					if (circles3green[i].x+4+(circles3green[i].dx*rangeVal) >= 500 || circles3green[i].x+(circles3green[i].dx*rangeVal)-4 <= 0) {
						circles3green[i].dx = -circles3green[i].dx;
						circles3green[i].x += (circles3green[i].dx*rangeVal);
					}
					if (circles3green[i].y+4+(circles3green[i].dy*rangeVal) >= 500 || circles3green[i].y+(circles3green[i].dy*rangeVal)-4 <= 0) {
						circles3green[i].dy = -circles3green[i].dy;
						circles3green[i].y += (circles3green[i].dy*rangeVal);
					}

					for (var j = 0; j < circles3red.length; j++) {
						if (Math.sqrt(((circles3green[i].x+(circles3green[i].dx*rangeVal)-circles3red[j].x-(circles3red[j].dx*rangeVal))**2)+((circles3green[i].y+(circles3green[i].dy*rangeVal)-circles3red[j].y-(circles3red[j].dy*rangeVal))**2)) < 16) {
							circles3green[i].dx = -circles3green[i].dx;
							circles3green[i].x += (circles3green[i].dx*rangeVal);
							circles3green[i].dy = -circles3green[i].dy;
							circles3green[i].y += (circles3green[i].dy*rangeVal);

							circles3red[j].dx = -circles3red[j].dx;
							circles3red[j].x += (circles3red[j].dx*rangeVal);
							circles3red[j].dy = -circles3red[j].dy;
							circles3red[j].y += (circles3red[j].dy*rangeVal);
						}
					}

					circles3green[i].x += (circles3green[i].dx*rangeVal);
					circles3green[i].y += (circles3green[i].dy*rangeVal);
				}

				for (var i = 0; i < circles3red.length; i++) {
					context3.beginPath();
					context3.arc(circles3red[i].x, circles3red[i].y, 8, 0, 2 * Math.PI, false);
					context3.fillStyle = '#f44336';
					context3.fill();
					context3.lineWidth = 1;
					context3.strokeStyle = '#333';
					context3.stroke();

					if (rangeVal==0) {
						continue;
					}

					if (circles3red[i].x+4+(circles3red[i].dx*rangeVal) >= 500 || circles3red[i].x+(circles3red[i].dx*rangeVal)-4 <= 0) {
						circles3red[i].dx = -circles3red[i].dx;
						circles3red[i].x += (circles3red[i].dx*rangeVal);
					}
					if (circles3red[i].y+4+(circles3red[i].dy*rangeVal) >= 500 || circles3red[i].y+(circles3red[i].dy*rangeVal)-4 <= 0) {
						circles3red[i].dy = -circles3red[i].dy;
						circles3red[i].y += (circles3red[i].dy*rangeVal);
					}

					circles3red[i].x += (circles3red[i].dx*rangeVal);
					circles3red[i].y += (circles3red[i].dy*rangeVal);
				}

				setTimeout(animate3, 20);
			};

			circles3green = [];

			for (var i = 0; i < 40; i++) {
				circles3green.push({
					x: Math.random()*480+10,
					y: Math.random()*480+10,
					dx: (Math.random()*2 + 1)*(Math.random() > 0.5 ? -1 : 1),
					dy: (Math.random()*2 + 1)*(Math.random() > 0.5 ? -1 : 1)
				});
			}

			circles3red = [];

			for (var i = 0; i < 40; i++) {
				circles3red.push({
					x: Math.random()*480+10,
					y: Math.random()*480+10,
					dx: (Math.random()*2 + 1)*(Math.random() > 0.5 ? -1 : 1),
					dy: (Math.random()*2 + 1)*(Math.random() > 0.5 ? -1 : 1)
				});
			}

			requestAnimationFrame(animate3);

			var canvas4 = $("#canvas4")[0];
			var context4 = canvas4.getContext('2d');

			var amountRemaining4 = 10;

			var animate4 = function() {
				context4.fillStyle = "#fff";
				context4.fillRect(0, 0, 500, 500);

				amountRemaining4 -= (10-$("#range4").val()+1)/30;

				if (amountRemaining4 < 0) {
					amountRemaining4 = 10;
				}

				context4.lineWidth = amountRemaining4;
				context4.strokeStyle = "#333";
				context4.fillStyle = "#4caf50";

				context4.beginPath();
				context4.arc(178-(20-amountRemaining4*2), 178-(20-amountRemaining4*2), 100, 0, 2*Math.PI, false);
				context4.closePath();
				context4.fill();
				context4.stroke();

				context4.beginPath();
				context4.fillStyle = "#f44336";
				context4.arc(322+(20-amountRemaining4*2), 322+(20-amountRemaining4*2), 100, 0, 2*Math.PI, false);
				context4.closePath();
				context4.fill();
				context4.stroke();

				setTimeout(animate4, 20);
			};

			requestAnimationFrame(animate4);

			var canvas5 = $("#canvas5")[0];
			var context5 = canvas5.getContext('2d');

			function P(x,y){this.x = x;this.y = y; }
			function pointOnCurve(P1,P2,P3,t){
			    if(t<=0 || 1<=t || isNaN(t))return false;
			    var c1 =  new P(P1.x+(P2.x-P1.x)*t,P1.y+(P2.y-P1.y)*t);
			    var c2 =  new P(P2.x+(P3.x-P2.x)*t,P2.y+(P3.y-P2.y)*t);
			    return new P(c1.x+(c2.x-c1.x)*t,c1.y+(c2.y-c1.y)*t);  
			}
			function getQCurveBounds(ax, ay, bx, by, cx, cy){
			    var  P1 = new P(ax,ay);
			    var  P2 = new P(bx,by);
			    var  P3 = new P(cx,cy);
			    var tx =  (P1.x - P2.x) / (P1.x - 2*P2.x + P3.x);
			    var ty =  (P1.y - P2.y) / (P1.y - 2*P2.y + P3.y);
			    var Ex = pointOnCurve(P1,P2,P3,tx);
			    var xMin = Ex?Math.min(P1.x,P3.x,Ex.x):Math.min(P1.x,P3.x);
			    var xMax = Ex?Math.max(P1.x,P3.x,Ex.x):Math.max(P1.x,P3.x);
			    var Ey = pointOnCurve(P1,P2,P3,ty);
			    var yMin = Ey?Math.min(P1.y,P3.y,Ey.y):Math.min(P1.y,P3.y);
			    var yMax = Ey?Math.max(P1.y,P3.y,Ey.y):Math.max(P1.y,P3.y);
			    return {x:xMin, y:yMin, width:xMax-xMin, height:yMax-yMin};
			}

			var animate5 = function() {
				context5.fillStyle = "#fff";
				context5.fillRect(0, 0, 500, 500);

				context5.lineWidth = 6;
				context5.strokeStyle = "#333";
				context5.beginPath();
				context5.moveTo(0, 450);
				context5.lineTo(150, 450);
				context5.quadraticCurveTo(250, $("#range5").val()*50-275, 350, 250);
				context5.lineTo(500, 250);
				context5.stroke();

				var bounds = getQCurveBounds(150, 450, 250, $("#range5").val()*50-275, 500, 250);

				context5.fillStyle = "#000";
				context5.font = "20px Arial";
				context5.fillText("Products",410,240);
				context5.fillText("Activation Energy",185,bounds.y-10);
				context5.fillText("Reactants",10,440);

				setTimeout(animate5, 20);
			};

			requestAnimationFrame(animate5);

			*/
		});
	})(jQuery);
</script>

