<?php
session_start();
require_once('inc/mail.php');
require_once('inc/captcha/autoload.php');
include_once('themes/template.class.php');

if (isset($_SESSION['ezLogin_user'])) {
    header('Location: ' . SITE_BASE . 'members.php');
    exit;
}

$theme = new Template();

$theme->_setParams('userLoginLinkLocation', SITE_BASE . 'index.php');
$theme->_setParams('userRegisterLinkLocation', SITE_BASE . 'register.php');

$theme->_setParams('sitekey', RECAPTCHA_SITEKEY);
$theme->_setParams('themebase', 'themes/' . THEME);

if (isset($_POST['submit'])) {
    $reCaptcha = new \ReCaptcha\ReCaptcha(RECAPTCHA_PRIVATEKEY);

    $resp = $reCaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);
    if ($resp->isSuccess()) {
        $email = strtolower($_POST['fp_email']);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            if(isRegisteredEmail($email)) {
                $recoveryCode = generateRecoveryCode($email);
                if(is_string($recoveryCode)) {
                    $email_theme = new Template();
                    $email_theme->_setParams('recoveryCode', $recoveryCode);
                    $email_theme->_setParams('recoveryLinkLocation', SITE_BASE . "recovery.php");

                    $mailSubject = "Account Recovery";
                    $mailBody = $email_theme->getOutputPage(THEME, 'email_recovery');

                    if (sendMail($email, $mailSubject, $mailBody)) {
                        $theme->_setParams('successmsg', 'A password recovery link will be sent to the email address if it is registered.');
                    } else {
                        $theme->_setParams('errormsg', 'We were
                                        unable to send you an recovery email. Contact an administrator.');
                    }
                } else {
                    $theme->_setParams('successmsg', 'A password recovery link will be sent to the email address if it is registered.');
                }
            } else {
                $theme->_setParams('successmsg', 'A password recovery link will be sent to the email address if it is registered.');
            }

        } else {
            $theme->_setParams('errormsg', 'You must enter in a valid email address.');
        }
    } else {
        $theme->_setParams('errormsg', 'The ReCaptcha was invalid, try again.');
    }
}


$theme->_getTemplateFile(THEME, 'forgot');
$theme->outputPage();