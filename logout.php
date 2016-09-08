<?php
session_start();
require_once('inc/config.php');

if(isset($_SESSION['ezLogin_user'])) {
    session_destroy();
    header('Location: ' . SITE_BASE . 'index.php');
    exit;
} else {
    header('Location: ' . SITE_BASE . 'index.php');
    exit;
}