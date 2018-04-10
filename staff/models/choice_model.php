<?php
/**
 * Created by IntelliJ IDEA.
 * User: Javier
 * Date: 03/04/2018
 * Time: 16:39
 */

if(isset($_POST["submit"])) {

    $id = $_POST["id"];
    $choice = $_POST["choice"];

    if($choice == "students")
    {
        $redirect_uri = '/scweb/staff/students.php?id=' . $id;
        header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
        exit();
    }
    else
    {
        $redirect_uri = '/scweb/staff/modules.php?id=' . $id;
        header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
        exit();
    }
}