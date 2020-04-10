<?php
require('dmxConnectLib/dmxConnect.php');

$app = new \lib\App();

$app->exec(<<<'JSON'
{
	"steps": [
		"Connections/db",
		"SecurityProviders/siteSecurity",
		{
			"module": "auth",
			"action": "restrict",
			"options": {"loginUrl":"login.php","forbiddenUrl":"index.php","provider":"siteSecurity"}
		}
	]
}
JSON
, TRUE);
?>
<!doctype html>
<html>

<head>
	<meta name="ac:route" content="/account">
	<script src="dmxAppConnect/dmxAppConnect.js"></script>
	<meta charset="UTF-8">
	<title>App - Account</title>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="css/style.css" />
	<link rel="stylesheet" href="bootstrap/4/flatly/bootstrap.min.css" />
	<script src="dmxAppConnect/dmxBootstrap4Navigation/dmxBootstrap4Navigation.js" defer=""></script>
	<script src="dmxAppConnect/dmxBrowser/dmxBrowser.js" defer=""></script>
	<script src="dmxAppConnect/dmxFormatter/dmxFormatter.js" defer=""></script>
	<script src="dmxAppConnect/dmxStateManagement/dmxStateManagement.js" defer=""></script>
	<link rel="stylesheet" href="dmxAppConnect/dmxValidator/dmxValidator.css" />
	<script src="dmxAppConnect/dmxValidator/dmxValidator.js" defer=""></script>
	<script src="dmxAppConnect/dmxBootstrap4Alert/dmxBootstrap4Alert.js" defer=""></script>
</head>

<body is="dmx-app" id="index">




	<dmx-serverconnect id="getuserdetails" url="dmxConnect/api/Security/userDetails.php"></dmx-serverconnect>


	<?php include 'header.html'; ?>

	<div class="container wappler-block pt-3 pb-3">

		<h3 class="mt-3 mb-3">Welcome, {{getuserdetails.data.get_user_details[0].username}}</h3>
		<div class="row align-items-start">

			<div class="col-4 align-self-baseline">
				<p class="align-self-center mb-0">E-mail Address : {{getuserdetails.data.get_user_details[0].email}}</p>
				<h5 class="mt-4 mb-3">Change Password</h5>
				<form id="changepassword" method="post" is="dmx-serverconnect-form" action="dmxConnect/api/Security/changePassword.php" dmx-on:success="changepassword.reset();passwordsuccess.show()">
					<div class="form-group">
						<label for="confirmpassword">New Password</label>
						<input type="password" class="form-control" id="password" name="password" placeholder="New password" required="">
					</div>
					<div class="form-group">
						<label for="confirmpassword">Confirm Password</label>
						<input type="password" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Confirm password" data-rule-equalto="password" data-msg-equalto="Passwords must match." required="">
					</div>
					<button class="btn btn-primary" type="submit">Change</button>
					<div class="alert mt-3" id="passwordsuccess" is="dmx-bs4-alert" role="alert" type="success">
						<p class="mb-0">Password changed successfully.</p>
					</div>
				</form>
			</div>
		</div>
	</div>
	<?php include 'footer.html'; ?>
	<script src="bootstrap/4/js/popper.min.js"></script>
	<script src="bootstrap/4/js/bootstrap.min.js"></script>
</body>

</html>