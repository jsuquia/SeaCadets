<?php
/**
 * Created by IntelliJ IDEA.
 * User: Javier
 * Date: 14/04/2018
 * Time: 20:59
 */

require('../php_scripts/db.php');

session_start();

if(isset($_POST["reset"]))
{
    $id = $_POST["user_id"];
    $password = $_POST["password"];

    $password_hash = password_hash( $password, PASSWORD_DEFAULT, [ 'cost' => 11 ] );

    $stmt = $conn->prepare("UPDATE mydb.users SET password=? WHERE ID=$id");

    $stmt->bind_param("s", $password_hash);
    $stmt->execute();

    $_SESSION['msg'] = "Password successfully changed";

    $redirect_uri = "/scweb/login.php";
    header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
    exit();

}