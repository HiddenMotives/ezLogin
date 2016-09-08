<?php

//The web location where ezLogin is accessible by, followed by a trailing slash.
//ex. http://mywebsite.com/ezLogin/
define('SITE_BASE', 'http://mywebsite.com.com/ezLogin/');

//MYSQL Database Connection Details
define('MYSQL_HOST', 'localhost');
define('MYSQL_USER', 'ezlogin');
define('MYSQL_PASS', '');
define('MYSQL_DB', 'ezlogin');
define('MYSQL_PORT', 3306);

//Google ReCaptcha site and private keys.
define('RECAPTCHA_SITEKEY', '6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI');
define('RECAPTCHA_PRIVATEKEY', '6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe');


/**  EzLogin Settings */

//Theme folder to use.
define('THEME', 'mixmatch');

//Mail Settings
define('FROM_NAME', 'ezLogin Account');
define('FROM_EMAIL', 'mail@mywebsite.com'); //Email where outgoing messages will appear to be sent from.

define('USE_SMTP', false); //If set to false below settings will be ignored and mail will be sent using php mail()
define('SMTP_HOST', 'smtp.mywebsite.com');
define('SMTP_AUTH', false); //If set to false username and password will be ignored.
define('SMTP_USER', 'mail@mywebsite.com');
define('SMTP_PASS', '');
define('SMTP_SECURE', 'ssl'); //SSL or TLS
define('SMTP_PORT', 465);

//Default user rank
//It can be used to give access to a certain part of a page based on the "rank" of the user account.
define('USER_RANK', 1);

//Upon creation automatically enable the user account. 1 for yes, 0 for no.
define('USER_ENABLED', 1);

//BCrypt Password hashing algorithm cost
//Higher value = more iterations of the password hash, but slower performance.
define('PASSWORD_COST', 12);

define('MIN_PASSWORD_LENGTH', 5);
define('MAX_PASSWORD_LENGTH', 64);
define('MIN_USERNAME_LENGTH', 3);
define('MAX_USERNAME_LENGTH', 16); //(Maximum 60 in length)