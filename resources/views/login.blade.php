<!DOCTYPE HTML>
<!--
	Eventually by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Login - Final Project</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="{{ URL::asset('/loginpage/assets/css/main.css') }}" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
	</head>
	<body>

		<!-- Header -->
			<header id="header">
				<img src="{{ URL::asset('/loginpage/images/LOGOF.png') }}">
				<p></p>
			</header>

		<!-- Signup Form -->
			<form id="signup-form" method="post" action="#">
				<br/><input type="text" name="user" id="user" placeholder="User ID" /><br/>
				<input type="password" name="pswd" id="pswd" placeholder="Password" /><br/>
				<input type="submit" value="Sign in" /><br/><br/>
			</form>

		<!-- Footer -->
			<footer id="footer">
				<!--	<ul class="icons">
					<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
					<li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
					<li><a href="#" class="icon fa-github"><span class="label">GitHub</span></a></li>
					<li><a href="#" class="icon fa-envelope-o"><span class="label">Email</span></a></li>
				</ul>	-->
				<ul class="copyright">
					<li>&copy; TAIWAN No.1!!!</li><li>Final Project</li>
				</ul>
			</footer>

		<!-- Scripts -->
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="{{ URL::asset('/loginpage/assets/js/main.js') }}"></script>

	</body>
</html>
