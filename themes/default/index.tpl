<html>
	<head>
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.js"></script>
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

		<link href='{THEMEBASE}/css/base.css' rel='stylesheet' type='text/css'>

		<script src="https://www.google.com/recaptcha/api.js" async defer></script>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
		<title>ezLogin</title>
	</head>


	<body>

		<div class="text-center" style="padding:50px 0">
			<div class="logo">Login</div>
			<div class="login-form-1">
				<form id="login-form" class="text-left" action="?" method="POST">
					<div class="login-form-main-message"></div>
					<div id="alertDivError" class="alert alert-danger">{ERRORMSG}</div>
					<div class="main-login-form">
						<div class="login-group">
							<div class="form-group">
								<label for="lg_user" class="sr-only"></label>
								<input type="text" class="form-control" id="lg_user" name="lg_user" placeholder="username">
							</div>
							<div class="form-group">
								<label for="lg_password" class="sr-only"></label>
								<input type="password" class="form-control" id="lg_password" name="lg_password" placeholder="password">
							</div>
								<p>
									<div class="g-recaptcha" data-sitekey="{SITEKEY}" style="transform:scale(0.85);-webkit-transform:scale(0.85);transform-origin:0 0;-webkit-transform-origin:0 0;">
									</div>
								<p>
						</div>
						<button type="submit" name="submit" class="login-button"><i class="fa fa-chevron-right"></i></button>
					</div>
					<div class="etc-login-form">
						<p>forgot your password? <a href="{passwordForgotLinkLocation}">click here</a></p>
						<p>new user? <a href="{userRegisterLinkLocation}">create new account</a></p>
					</div>
				</form>
			</div>
		</div>


		<script src='{THEMEBASE}/js/error.js'></script>

	</body>
</html>
