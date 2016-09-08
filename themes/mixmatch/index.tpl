<html>
<head>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

    <link href='{THEMEBASE}/css/base.css' rel='stylesheet' type='text/css'>

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>ezLogin</title>
</head>


<body>

<div class="container">

    <div class="row" style="margin-top:20px">
        <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
            <form role="form" action="?" method="POST">
                <fieldset>
                    <h2>Please Sign In</h2>
                    <hr class="colorgraph">
                    <div id="alertDivError" class="alert alert-danger">{ERRORMSG}</div>
                    <div class="form-group">
                        <input type="text" id="lg_user" name="lg_user" class="form-control input-lg" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <input type="password" id="lg_password" name="lg_password" class="form-control input-lg" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <div class="g-recaptcha" data-sitekey="{SITEKEY}"></div>
                    </div>
                    <hr class="colorgraph">
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <input type="submit" name="submit"  class="btn btn-lg btn-success btn-block" value="Sign In">
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <a href="{userRegisterLinkLocation}" class="btn btn-lg btn-primary btn-block">Register</a>
                        </div>
                    </div>
                    <a href="{passwordForgotLinkLocation}" class="btn btn-link pull-right">Forgot Password?</a>
                </fieldset>
            </form>
        </div>
    </div>

</div>

<script src='{THEMEBASE}/js/error.js'></script>

</body>
</html>
