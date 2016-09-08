<?php
session_start();
require_once('inc/ezLogin.php');
require_once('inc/captcha/autoload.php');
include_once('themes/template.class.php');

if(isset($_SESSION['ezLogin_user'])) {
    header('Location: ' . SITE_BASE . 'members.php');
    exit;
}

$theme = new Template();

$theme->_setParams('userRegisterLinkLocation', SITE_BASE . 'register.php');
$theme->_setParams('passwordForgotLinkLocation', SITE_BASE . 'forgot.php');


$theme->_setParams('sitekey', RECAPTCHA_SITEKEY);
$theme->_setParams('themebase', 'themes/' . THEME);

if (isset($_POST['submit'])) {
    $reCaptcha = new \ReCaptcha\ReCaptcha(RECAPTCHA_PRIVATEKEY);

    $resp = $reCaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);
    if ($resp->isSuccess()) {
        $user = ($_POST['lg_user']);
        $password = ($_POST['lg_password']);

        if( (strlen($user)>=MIN_USERNAME_LENGTH) && (strlen($user)<=MAX_USERNAME_LENGTH) && ctype_alnum($user)) {
            if((strlen($password)>= MIN_PASSWORD_LENGTH) && (strlen($password) <= MAX_PASSWORD_LENGTH)) {
                if(doLogin($user, $password)) {

                    $userData = getUserData($user);

                    if($userData['account_activated']) {
                        if($userData['account_enabled']) {
                            $_SESSION['ezLogin_uid'] = $userData['id'];
                            $_SESSION['ezLogin_user'] = $userData['user'];
                            $_SESSION['ezLogin_email'] = $userData['email'];
                            $_SESSION['ezLogin_rank'] = $userData['rank'];
                            $_SESSION['ezLogin_creation'] = $userData['creation_timestamp'];
                            header('Location: ' . SITE_BASE . 'members.php');
                            exit;
                        } else {
                            $theme->_setParams('errormsg', 'Your account is disabled, contact an administrator to regain access.');
                        }
                    } else {
                        $theme->_setParams('errormsg', 'You must activate your account before you login. 
                        Check your email for an activation link. If your having trouble contact an administrator');
                    }
                } else {
                    $theme->_setParams('errormsg', 'You entered an incorrect username or password combination!');
                }
            } else {
                $theme->_setParams('errormsg', 'Your password must be between ' .
                    MIN_PASSWORD_LENGTH . ' and ' . MAX_PASSWORD_LENGTH . ' characters long.');
            }
        } else {
            $theme->_setParams('errormsg', 'Your username must be alphanumeric and be between ' .
                MIN_USERNAME_LENGTH . ' to ' . MAX_USERNAME_LENGTH . ' characters long.');
        }

    } else {
        $theme->_setParams('errormsg', 'The ReCaptcha was invalid, try again.');
    }
}

$theme->_getTemplateFile(THEME, 'index');
$theme->outputPage();