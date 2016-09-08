<html>
<head>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

    <link href='{THEMEBASE}/css/base.css' rel='stylesheet' type='text/css'>

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>ezLogin Forgot Password</title>
</head>


<body>

<div class="container">

    <div class="row" style="margin-top:20px">
        <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
            <form role="form" action="?" method="POST">
                <fieldset>
                    <h2>Forgot Password</h2>
                    <hr class="colorgraph">
                    <div id="alertDivSuccess" class="alert alert-success">{SUCCESSMSG}</div>
                    <div id="alertDivError" class="alert alert-danger">{ERRORMSG}</div>
                    <div class="form-group">
                        <input type="text" id="fp_email" name="fp_email" class="form-control input-lg" placeholder="Email Address">
                    </div>
                    <div class="form-group">
                        <div class="g-recaptcha" data-sitekey="{SITEKEY}"></div>
                    </div>
                    <hr class="colorgraph">
                    <div class="row">
                        <input type="submit" name="submit"  class="btn btn-lg btn-success btn-block" value="Recover Account">
                    </div>
                </fieldset>
            </form>
        </div>
    </div>

</div>

<script src='{THEMEBASE}/js/error.js'></script>

</body>
</html>
