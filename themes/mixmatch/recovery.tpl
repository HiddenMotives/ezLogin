<html>
<head>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

    <link href='{THEMEBASE}/css/base.css' rel='stylesheet' type='text/css'>

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>ezLogin Account Recovery</title>
</head>


<body>

<div class="container">

    <div class="row" style="margin-top:20px">
        <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
            <form role="form" action="?" method="POST">
                <fieldset>
                    <h2>Account Recovery</h2>
                    <hr class="colorgraph">
                    <div id="alertDivSuccess" class="alert alert-success">{SUCCESSMSG}</div>
                    <div id="alertDivError" class="alert alert-danger">{ERRORMSG}</div>
                    <div class="form-group">
                        <input type="text" id="rec_code" name="rec_code" class="form-control input-lg" placeholder="Recovery Code">
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <input type="password" name="rec_password" id="rec_password" class="form-control input-lg" placeholder="Password">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <input type="password" name="rec_password_confirm" id="rec_password_confirm" class="form-control input-lg" placeholder="Confirm Password">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="g-recaptcha" data-sitekey="{SITEKEY}"></div>
                    </div>
                    <hr class="colorgraph">
                    <div class="row">
                        <input type="submit" name="submit" value="Recover Account" class="btn btn-success btn-block btn-lg">
                    </div>
                    <a href="{passwordForgotLinkLocation}" class="btn btn-link pull-right">Need a Recovery Code?</a>
                    <a href="{userLoginLinkLocation}" class="btn btn-link pull-right">Click here to Login Again!</a>
                </fieldset>
            </form>
        </div>
    </div>

</div>

<script src='{THEMEBASE}/js/error.js'></script>

</body>
</html>
