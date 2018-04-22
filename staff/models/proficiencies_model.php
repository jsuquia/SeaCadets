<?php
/**
 * Created by IntelliJ IDEA.
 * User: Javier
 * Date: 22/04/2018
 * Time: 19:11
 */

if(isset($_POST["onshore"]))
{
    $redirect_uri = '/scweb/staff/proficiencies.php?reward=2';
    header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
    exit();
}

if(isset($_POST["offshore"]))
{
    $redirect_uri = '/scweb/staff/proficiencies.php?reward=3';
    header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
    exit();
}

if(isset($_POST["boating"]))
{
    $redirect_uri = '/scweb/staff/proficiencies.php?reward=4';
    header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
    exit();
}