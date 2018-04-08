<?php
/**
 * Created by IntelliJ IDEA.
 * User: Javier
 * Date: 08/04/2018
 * Time: 16:41
 */

require('../php_scripts/db.php');

if(isset($_POST["add"]))
{
    $username = $_POST["username"];
    $password = $_POST["password"];
    $name = $_POST["name"];
    $surname = $_POST["surname"];

    //echo $username . $password . $name . $surname;

    $password_hash = password_hash( $password, PASSWORD_DEFAULT, [ 'cost' => 11 ] );

    $stmt = $conn->prepare("INSERT INTO mydb.users (username, password, name, surname) VALUES (?,?,?,?)");
    $stmt->bind_param("ssss", $username, $password_hash, $name, $surname);

    $stmt->execute();

    $redirect_uri = $_SERVER['HTTP_REFERER'];
    header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
    exit();

}

if(isset($_POST["delete"]))
{

    $id = $_POST["id"];

    $sql = "DELETE FROM mydb.users WHERE ID = $id";

    if ($conn->query($sql) !== TRUE)
    {
        echo "Error deleting record: " . $conn->error;
    } else
    {
        $redirect_uri = $_SERVER['HTTP_REFERER'];
        header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
        exit();
    }

}