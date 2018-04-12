<?php
/**
 * Created by IntelliJ IDEA.
 * User: Javier
 * Date: 11/04/2018
 * Time: 19:28
 */

require('../../php_scripts/check_cookie.php');

if(isset($_POST["update"]))
{
    $password = $_POST["password"];

    $password_hash = password_hash( $password, PASSWORD_DEFAULT, [ 'cost' => 11 ] );

    if($password!=null)
    {
        $stmt = $conn->prepare("UPDATE mydb.users SET password=? WHERE ID=$user->id");

        $stmt->bind_param("s", $password_hash);

        $stmt->execute();
    }

    $redirect_uri = $_SERVER['HTTP_REFERER'];
    header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
    exit();

}