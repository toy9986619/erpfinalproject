<!DOCTYPE HTML>
<!--
	Prologue by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Info - Final Project</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="{{ URL::asset('/homepage/assets/css/main.css') }}" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<link rel="stylesheet" href="/homepage/assets/css/animate.min.css">
	</head>
	<body>

		<!-- Header -->
			<div id="header">

				<div class="top">

					<!-- Logo -->
						<div id="logo">
							<span class="image avatar48"><img src="{{ URL::asset('/homepage/images/avatar.jpg') }}" alt="" /></span>
							<h1 id="title">滷味攻城屍</h1>
							<p>爆肝GG輪班新人</p>
						</div>

					<!-- Nav -->
						<nav id="nav">
							<ul>
								<li><a href="#top" id="top-link" class="skel-layers-ignoreHref"><span class="icon fa-home">Home</span></a></li>
								<li><a href="#salary" id="salary-link" class="skel-layers-ignoreHref"><span class="icon fa-th">Working Hours</span></a></li>
								
							</ul>
						</nav>

				</div>

				<div class="bottom">
					<img src="{{ URL::asset('/homepage/images/LOGOF.png') }}">
				</div>

			</div>

		<!-- Main -->
			<div id="main">

				<!-- Intro -->
					<section id="top" class="one dark cover">
						<div class="container">

							<header>
								<h2 class="alt"><br/>Welcome back,<br/>
								Dear 滷味攻城屍 .</h2>
								<p><br/><br/><br/>You can check employees' infomation here.</p>
							</header>

							<footer>
								<a href="#salary" class="button scrolly">Enter</a>
							</footer>
							<br/>

						</div>
					</section>

				<!-- Portfolio -->
					<section id="salary" class="two">
						<div class="container">

							<header>
								<h2>Working Hours</h2>
							</header>
							
							<table border="1px" id="table1"></table>
							<p id="editpanel"></p>
							<a id="demo01" href="#animatedModal">我要修改</a><br>
							
							
							
							
							<div id="animatedModal">
							<div class="close-animatedModal"> CLOSE MODAL</div>
							<div class="modal-content">
							
							<table border="1px" id="table2"></table>
							</div>
							</div>
							
							
							
							
							
							
						<input type="button" id="button" onclick="myfunction()" value="test" />
    
						<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
						<script src="http://momo.sytes.net:808/json/jsonblade052601.js"> </script>  
							

						</div>
					</section>

			</div>

		<!-- Footer -->
			<div id="footer">

				<!-- Copyright -->
					<ul class="copyright">
						<li>&copy; TAIWAN No.1!!! All rights reserved.</li>
					</ul>

			</div>

		<!-- Scripts -->
			<script src="{{ URL::asset('/homepage/assets/js/jquery.min.js') }}"></script>
			<script src="{{ URL::asset('/homepage/assets/js/jquery.scrolly.min.js') }}"></script>
			<script src="{{ URL::asset('/homepage/assets/js/jquery.scrollzer.min.js') }}"></script>
			<script src="{{ URL::asset('/homepage/assets/js/skel.min.js') }}"></script>
			<script src="{{ URL::asset('/homepage/assets/js/util.js') }}"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="{{ URL::asset('/homepage/assets/js/main.js') }}"></script>
			<script src="{{ URL::asset('/homepage/assets/js/animatedModal.js') }}"></script>
			
			<script>
				$("#demo01").animatedModal();
				if(document.getElementById("edit1")){
					document.getElementById("edit1").onclick = function(){jump();}
					
				}
				function jump(){
					lnk = document.getElementById("demo01"); 
					lnk.click();
				}
				
				
				
				
			</script>

	</body>
</html>