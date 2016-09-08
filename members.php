<?php
session_start();
require_once('inc/ezLogin.php');

if(!isset($_SESSION['ezLogin_user'])) {
    header('Location: ' . SITE_BASE . 'index.php');
    exit;
}

echo "<pre>Demo of the members area, the below data is stored in session variables. 
        Modify members.php to change the contents of this file.
        This page is only visible to logged in users.</pre>";

$text = null;
foreach ($_SESSION as $key=>$val) {
    $text .= "<b>" .strtoupper($key)."</b>: ".$val."<br/>";
}

echo $text;

echo "<pre>To logout a logged in user simply redirect them to <a href='".SITE_BASE."logout.php'>logout.php</a></pre>";