<?php
/**
 * Created by IntelliJ IDEA.
 * User: Javier
 * Date: 10/04/2018
 * Time: 16:59
 */

if($user->privilege != 1 && $user->privilege != 2)
{
    $redirect_uri = '/scweb/cadet/home.php';
    header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
    exit();
}