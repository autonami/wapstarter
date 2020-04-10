<!doctype html>
<html>

<head>
	<script src="dmxAppConnect/dmxAppConnect.js"></script>
	<meta charset="UTF-8">
	<title>App</title>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="css/style.css" />
	<link rel="stylesheet" href="bootstrap/4/flatly/bootstrap.min.css" />
	<script src="dmxAppConnect/dmxBootstrap4Navigation/dmxBootstrap4Navigation.js" defer=""></script>
	<script src="dmxAppConnect/dmxBrowser/dmxBrowser.js" defer=""></script>
	<script src="dmxAppConnect/dmxFormatter/dmxFormatter.js" defer=""></script>
	<script src="dmxAppConnect/dmxStateManagement/dmxStateManagement.js" defer=""></script>
</head>

<body is="dmx-app" id="index">






	<dmx-serverconnect id="getuserdetails" url="dmxConnect/api/Security/userDetails.php"></dmx-serverconnect>


	<?php include 'header.html'; ?>

	<div class="container wappler-block pt-3 pb-3">


		</form>
		<h3 class="mt-4 text-center">About</h3>
		<div class="row">
			<div class="col-3"></div>
			<div class="col">
				<p><br>This Wappler starter template is brought to you by Autonami (<a href="https://autonami.co/">autonami.co</a>).<br><br>For more templates and no-code inspiration, check my <a href="https://autonami.co/">portfolio</a>, or follow
					me on <a href="https://twitter.com/autonami">Twitter</a>.</p>
			</div>
			<div class="col-3"></div>
		</div>
	</div>
	<?php include 'footer.html'; ?>
	<script src="bootstrap/4/js/popper.min.js"></script>
	<script src="bootstrap/4/js/bootstrap.min.js"></script>
</body>

</html>