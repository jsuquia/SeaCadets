<?php
/**
 * Created by IntelliJ IDEA.
 * User: Javier
 * Date: 03/04/2018
 * Time: 16:39
 */

if(isset($_POST["student"]))
{
    $id = $_POST["id"];

    $redirect_uri = '/scweb/staff/students.php?id=' . $id;
    header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
    exit();
}

if(isset($_POST["modules"]))
{
    $id = $_POST["id"];

    $redirect_uri = '/scweb/staff/modules.php?id=' . $id;
    header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
    exit();
}