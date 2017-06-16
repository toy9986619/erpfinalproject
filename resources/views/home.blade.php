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
								<li><a href="#staff" id="staff-link" class="skel-layers-ignoreHref"><span class="icon fa-user">Staffs</span></a></li>
								<li><a href="#record" id="record-link" class="skel-layers-ignoreHref"><span class="icon fa-th">Records</span></a></li>
								<li><a href="#salary" id="salary-link" class="skel-layers-ignoreHref"><span class="icon fa-usd">Salary</span></a></li>
								
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
								<p><br/><br/><br/>You can check staffs' infomation here.</p>
							</header>

							<footer>
								<a href="#staff" class="button scrolly">Enter</a>
							</footer>
							<br/>

						</div>
					</section>

				<!-- Portfolio -->
					<section id="staff" class="two">
						<div class="container">
							<header>
								<h2>Staffs</h2>
							</header>
							<div id="tablearea" class="tablearea">
								<table border="1px" id="table1"></table>
								<p id="pagepanel"></p>
								<div id="staffEdit">
								
								</div>
							</div>
							
							
							<div id="animatedModal">
							<p align="right" id="close" class="close-animatedModal"></p>
							<div class="modal-content">
							<p id="editpanel"></p>
							<font size="3">
							<table border="1px" id="table2"></table>
							<p id="submitbtn"></p>
							</font>
							</div>
							</div>
						<input type="button" id="button" onclick="myfunction()" value="test" />
						<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
						<script src="http://momo.sytes.net:808/json/jsonblade06171201.js"> </script>
						</div>
						
						
						
					</section>
					<section id="record" class="three">
						<div class="container">
							<header>
								<h2>Records</h2>
							</header>

							<div id="recordSite"></div>
							
							
							
							
							
							<div id="animatedModal2">
							<p align="right" id="close2" class="close-animatedModal2"></p>
							<div class="modal-content">
							
							<font size="4"><b>
							
							<div id="recordInfoSite"></div>
							
							</b></font>
							</div>
							</div>
							
							
							
							
							
							

						</div>
					</section>
					<section id="salary" class="four">
						<div class="container">
							<header>
								<h2>Salary</h2>
							</header>
							
							<font size="4">
							<div id="salarySite"></div>
							</font>
							
							
							
							<div id="animatedModal3">
							<p align="right" id="close3" class="close-animatedModal3"></p>
							<div class="modal-content">
							
							<font size="4"><b>
							
								<div id="salaryEditSite"></div>
							
							</b></font>
							</div>
							</div>
							
							
							
							
							

						</div>
					</section>

			</div>

		<!-- Footer -->
			<div id="footer">
				<!--invisible button-->
					<a id="demo01" href="#animatedModal"></a><br>
					<a id="demo02" href="#animatedModal2"></a><br>
					<a id="demo03" href="#animatedModal3"></a><br>
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
			<script src="{{ URL::asset('/recordpage/assets/js/recordjs.js') }}"></script>
			<script src="{{ URL::asset('/salarypage/assets/js/salaryjs.js') }}"></script>

			<script>
				if(document.getElementById("demo01")){
					document.getElementById("demo01").onclick = function(){
					document.getElementById("close").innerHTML = '<i class="fa fa-close">　</i>';
					}
				}
				if(document.getElementById("demo02")){
					document.getElementById("demo02").onclick = function(){
					document.getElementById("close2").innerHTML = '<i class="fa fa-close">　</i>';
					}
				}
				if(document.getElementById("demo03")){
					document.getElementById("demo03").onclick = function(){
					document.getElementById("close3").innerHTML = '<i class="fa fa-close">　</i>';
					}
				}
			</script>

	</body>
</html>