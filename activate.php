<?php
session_start();
require_once('inc/ezLogin.php');
include_once('themes/template.class.php');

if(isset($_SESSION['ezLogin_user'])) {
    header('Location: ' . SITE_BASE . 'members.php');
    exit;
}

$theme = new Template();
$theme->_setParams('themebase', 'themes/' . THEME);

$code = $_GET["code"];
if($code) {
    if((strlen($code) == 20) && ctype_alnum($code)) {
        if(doActivate($code)) {
            $theme->_setParams('successmsg', 'Your account has been activated! You may now close this window.');
        } else {
            $theme->_setParams('errormsg', 'Invalid Activation Code');
        }
    } else {
        $theme->_setParams('errormsg', 'Invalid Activation Code');
    }
} else {
    $theme->_setParams('errormsg', 'No Activation Code Supplied');
}


$theme->_getTemplateFile(THEME, 'activate');
$theme->outputPage();