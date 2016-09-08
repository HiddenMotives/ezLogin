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

$theme->_setParams('sitekey', RECAPTCHA_SITEKEY);
$theme->_setParams('themebase', 'themes/' . THEME);

if (isset($_POST['submit'])) {
    $reCaptcha = new \ReCaptcha\ReCaptcha(RECAPTCHA_PRIVATEKEY);

    $resp = $reCaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);
    if ($resp->isSuccess()) {
        $user = ($_POST['reg_username']);
        $password = ($_POST['reg_password']);
        $passwordconfirm = ($_POST['reg_password_confirm']);
        $email = strtolower($_POST['reg_email']);

        if ((strlen($user) >= MIN_USERNAME_LENGTH) && (strlen($user) <= MAX_USERNAME_LENGTH) && ctype_alnum($user)) {
            if ($password === $passwordconfirm) {
                if ((strlen($password) >= MIN_PASSWORD_LENGTH) && (strlen($password) <= MAX_PASSWORD_LENGTH)) {
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                        if (!isRegisteredUsername($user)) {
                            if (!isRegisteredEmail($email)) {
                                if (doRegister($user, $email, $password)) {
                                    $userData = getUserData($user);

                                    $email_theme = new Template();
                                    $email_theme->_setParams('user', $userData['user']);
                                    $email_theme->_setParams('activateLinkLocation', SITE_BASE . "activate.php?code=" . $userData['activation_code']);

                                    $mailSubject = "Account Activation";
                                    $mailBody = $email_theme->getOutputPage(THEME, 'email_activate');

                                    if (sendMail($userData['email'], $mailSubject, $mailBody)) {
                                        $theme->_setParams('successmsg', 'Your account has been created, check your
                                        email for an activation code!');
                                    } else {
                                        $theme->_setParams('errormsg', 'Your account has been created, but we were
                                        unable to send you an activation email. Contact an administrator.');
                                    }
                                } else {
                                    $theme->_setParams('errormsg', 'Unable to register your account at this time. Try again later.');
                                }
                            } else {
                                $theme->_setParams('errormsg', $email . ' already has an account!');
                            }
                        } else {
                            $theme->_setParams('errormsg', 'The username ' . $user . ' is already taken!');
                        }
                    } else {
                        $theme->_setParams('errormsg', 'You must enter in a valid email address.');
                    }
                } else {
                    $theme->_setParams('errormsg', 'Your password must be between ' .
                        MIN_PASSWORD_LENGTH . ' and ' . MAX_PASSWORD_LENGTH . ' characters long.');
                }
            } else {
                $theme->_setParams('errormsg', 'The passwords you entered do not match.');
            }
        } else {
            $theme->_setParams('errormsg', 'Your username must be alphanumeric and be between ' .
                MIN_USERNAME_LENGTH . ' to ' . MAX_USERNAME_LENGTH . ' characters long.');
        }
    } else {
        $theme->_setParams('errormsg', 'The ReCaptcha was invalid, try again.');
    }
}

$theme->_getTemplateFile(THEME, 'register');
$theme->outputPage();