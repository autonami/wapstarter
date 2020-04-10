<!doctype html>
<html>

<head>
	<script src="dmxAppConnect/dmxAppConnect.js"></script>
	<meta charset="UTF-8">
	<title>App - Login</title>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="css/style.css" />
	<link rel="stylesheet" href="bootstrap/4/flatly/bootstrap.min.css" />
	<script src="dmxAppConnect/dmxBootstrap4Navigation/dmxBootstrap4Navigation.js" defer=""></script>
	<script src="dmxAppConnect/dmxBrowser/dmxBrowser.js" defer=""></script>
	<script src="dmxAppConnect/dmxStateManagement/dmxStateManagement.js" defer=""></script>
	<script src="dmxAppConnect/dmxBootstrap4Alert/dmxBootstrap4Alert.js" defer=""></script>
	<link rel="stylesheet" href="dmxAppConnect/dmxNotifications/dmxNotifications.css" />
	<script src="dmxAppConnect/dmxNotifications/dmxNotifications.js" defer=""></script>
	<link rel="stylesheet" href="dmxAppConnect/dmxValidator/dmxValidator.css" />
	<script src="dmxAppConnect/dmxValidator/dmxValidator.js" defer=""></script>
</head>

<body is="dmx-app" id="index">



	<dmx-session-manager id="session"></dmx-session-manager>
	<div is="dmx-browser" id="browser1"></div>


	<?php include 'header.html'; ?>

	<div class="container wappler-block pt-3 pb-3">


		<div class="row">
			<div class="col-12 col-xl-4 offset-xl-4 text-center col-md-6 offset-md-3 col">
				<form id="loginform" method="post" class="mt-5" is="dmx-serverconnect-form" action="dmxConnect/api/Security/login.php" dmx-on:success="browser1.goto('account.php');session.set('loggedin',1)" dmx-on:unauthorized="invalidlogin.show()">

					<div class="form-group text-left">
						<label for="username">Username</label>
						<input type="text" class="form-control" id="username" name="username" placeholder="username" required="">
					</div>
					<div class="form-group text-left">

						<label for="password">Password</label>
						<input type="password" class="form-control mb-2" id="password" name="password" placeholder="password" required="">
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="1" id="remember" name="remember">
							<label class="form-check-label" for="remember">Keep me logged in</label>
						</div>
					</div>
					<div class="alert alert-danger" id="invalidlogin" is="dmx-bs4-alert" role="alert" type="danger">
						<p class="mb-0"><i class="fas fa-alert"></i><i class="fa fa-exclamation-triangle"></i>&nbsp; Invalid username or password</p>
					</div>
					<button class="btn btn-primary btn-account" type="submit">Log in</button>
				</form>
			</div>
		</div>
		<div class="row">
			<div class="col-12 col-xl-4 offset-xl-4 text-center col-md-6 offset-md-3 col">
				<a href="register.php"><button id="createaccount" class="btn btn-primary mt-2 btn-account">Create an Account
					</button></a>
			</div>
		</div>
	</div>
	<?php include 'footer.html'; ?>
	<script src="bootstrap/4/js/popper.min.js"></script>
	<script src="bootstrap/4/js/bootstrap.min.js"></script>
</body>

</html>