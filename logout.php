<?php
/**
 * Created by PhpStorm.
 * User: Javier
 * Date: 29/06/2017
 * Time: 09:37
 */

setcookie("user_session",'', 1, "/");

//$redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . '/BuildTracking/index.php';
$redirect_uri = '/scweb/login.php';
header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
exit();