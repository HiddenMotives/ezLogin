<html>
<head>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

    <link href='{THEMEBASE}/css/base.css' rel='stylesheet' type='text/css'>

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>ezLogin Register</title>
</head>


<body>

<div class="container">

    <div class="row" style="margin-top:20px">
        <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
            <form role="form" action="?" method="POST">
                <fieldset>
                    <h2>Please Sign Up <small>It's free and always will be.</small></h2>
                    <hr class="colorgraph">
                    <div id="alertDivSuccess" class="alert alert-success">{SUCCESSMSG}</div>
                    <div id="alertDivError" class="alert alert-danger">{ERRORMSG}</div>
                    <div class="form-group">
                        <input type="text" id="reg_username" name="reg_username" class="form-control input-lg" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <input type="email" name="reg_email" id="reg_email" class="form-control input-lg" placeholder="Email Address">
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <input type="password" name="reg_password" id="reg_password" class="form-control input-lg" placeholder="Password">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <input type="password" name="reg_password_confirm" id="reg_password_confirm" class="form-control input-lg" placeholder="Confirm Password">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="g-recaptcha" data-sitekey="{SITEKEY}"></div>
                    </div>
                    <hr class="colorgraph">
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <input type="submit" name="submit" value="Register" class="btn btn-primary btn-block btn-lg">
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <a href="{userLoginLinkLocation}" class="btn btn-success btn-block btn-lg">Sign In</a>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>

</div>

<script src='{THEMEBASE}/js/error.js'></script>

</body>
</html>
