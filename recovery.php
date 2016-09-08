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

$theme->_setParams('userLoginLinkLocation', SITE_BASE . 'index.php');
$theme->_setParams('passwordForgotLinkLocation', SITE_BASE . 'forgot.php');

$theme->_setParams('sitekey', RECAPTCHA_SITEKEY);
$theme->_setParams('themebase', 'themes/' . THEME);

if (isset($_POST['submit'])) {
    $reCaptcha = new \ReCaptcha\ReCaptcha(RECAPTCHA_PRIVATEKEY);
    $resp = $reCaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);
    if ($resp->isSuccess()) {

        $recoveryCode = ($_POST['rec_code']);
        $password = ($_POST['rec_password']);
        $passwordconfirm = ($_POST['rec_password_confirm']);

        if ($password === $passwordconfirm) {
            if ((strlen($password) >= MIN_PASSWORD_LENGTH) && (strlen($password) <= MAX_PASSWORD_LENGTH)) {
                if((strlen($recoveryCode) == 40) && ctype_alnum($recoveryCode)) {

                    $uid = getRecoveryCodeUID($recoveryCode);
                    if($uid) {
                        if(updatePassword($uid, $password)) {
                            $theme->_setParams('successmsg', 'Your password has been updated!');
                        } else {
                            $theme->_setParams('errormsg', 'Unable to update your password at this time.');
                        }
                    } else {
                        $theme->_setParams('errormsg', 'Invalid or Expired Recovery Code');
                    }
                } else {
                    $theme->_setParams('errormsg', 'Invalid Recovery Code');
                }
            } else {
                $theme->_setParams('errormsg', 'Your password must be between ' .
                    MIN_PASSWORD_LENGTH . ' and ' . MAX_PASSWORD_LENGTH . ' characters long.');
            }
        } else {
            $theme->_setParams('errormsg', 'The passwords you entered do not match.');
        }
    } else {
        $theme->_setParams('errormsg', 'The ReCaptcha was invalid, try again.');
    }
}

$theme->_getTemplateFile(THEME, 'recovery');
$theme->outputPage();