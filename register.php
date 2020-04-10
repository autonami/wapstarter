<!doctype html>
<html>

<head>
	<script src="dmxAppConnect/dmxAppConnect.js"></script>
	<meta charset="UTF-8">
	<title>App - Register</title>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="css/style.css" />
	<link rel="stylesheet" href="bootstrap/4/flatly/bootstrap.min.css" />
	<script src="dmxAppConnect/dmxBootstrap4Navigation/dmxBootstrap4Navigation.js" defer=""></script>
	<script src="dmxAppConnect/dmxBrowser/dmxBrowser.js" defer=""></script>
	<link rel="stylesheet" href="dmxAppConnect/dmxValidator/dmxValidator.css" />
	<script src="dmxAppConnect/dmxValidator/dmxValidator.js" defer=""></script>
	<script src="dmxAppConnect/dmxBootstrap4Alert/dmxBootstrap4Alert.js" defer=""></script>
	<script src="dmxAppConnect/dmxFormatter/dmxFormatter.js" defer=""></script>
</head>

<body is="dmx-app" id="index">
	<div is="dmx-browser" id="browser1"></div>


	<?php include 'header.html'; ?>

	<div class="container wappler-block pt-3 pb-3">

		<div class="row">
			<div class="col-12 col-xl-4 offset-xl-4 text-center col-md-6 offset-md-3 col">
				<form id="registerform" method="post" class="mt-5" is="dmx-serverconnect-form" action="dmxConnect/api/Security/register.php" dmx-on:success="browser1.goto('login.php')"
					dmx-on:invalid="alreadyregistered.setTextContent(lastError.response.data.hasKey(validate_email) ? lastError.response.data.validate_email : lastError.response.data.validate_username);alreadyregistered.show()">
					<div class="form-group text-left">
						<label for="email">E-mail</label>
						<input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required="" data-rule-email="">
					</div>
					<div class="form-group text-left">
						<label for="username">Username</label>
						<input type="text" class="form-control" id="username" name="username" placeholder="Enter a username" required="">
					</div>
					<div class="form-group text-left">

						<label for="password">Password</label>
						<input type="password" class="form-control mb-2" id="password" name="password" placeholder="Enter a password" required="">
					</div>
					<div class="alert" id="alreadyregistered" is="dmx-bs4-alert" role="alert" type="danger">
						<p>This is a nice alert!</p>
					</div>
					<button class="btn btn-primary mt-2" type="submit">Create an Account</button>
				</form>
			</div>
		</div>
	</div>
	<?php include 'footer.html'; ?>
	<script src="bootstrap/4/js/popper.min.js"></script>
	<script src="bootstrap/4/js/bootstrap.min.js"></script>
</body>

</html>