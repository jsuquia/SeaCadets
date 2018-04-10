<?php
/**
 * Created by IntelliJ IDEA.
 * User: Javier
 * Date: 08/04/2018
 * Time: 16:41
 */

require('../../php_scripts/db.php');

if(isset($_POST["add"]))
{
    $username = $_POST["username"];
    $password = $_POST["password"];
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $email = $_POST["email"];

    $password_hash = password_hash( $password, PASSWORD_DEFAULT, [ 'cost' => 11 ] );

    $stmt = $conn->prepare("INSERT INTO mydb.users (username, password, privilege) VALUES (?,?,?)");
    $stmt->bind_param("ssi", $username, $password_hash, $privilege);

    $privilege = 2;

    $stmt->execute();

    $last_id = $conn->insert_id;


    $stmt = $conn->prepare("INSERT INTO mydb.staff (name, surname, email, user_id) VALUES (?,?,?,?)");
    $stmt->bind_param("sssi", $name, $surname, $email, $last_id);

    $stmt->execute();

    $redirect_uri = $_SERVER['HTTP_REFERER'];
    header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
    exit();

}

if(isset($_POST["update"]))
{

    $id = $_POST["id"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $email = $_POST["email"];

    $password_hash = password_hash( $password, PASSWORD_DEFAULT, [ 'cost' => 11 ] );

    if($password!=null)
    {
        $stmt = $conn->prepare("UPDATE mydb.users SET username=?, password=? WHERE ID=$id");

        $stmt->bind_param("ss", $username, $password_hash);

        $stmt->execute();
    } else
    {
        $stmt = $conn->prepare("UPDATE mydb.users SET username=? WHERE ID=$id");

        $stmt->bind_param("s", $username);

        $stmt->execute();
    }

    $stmt = $conn->prepare("UPDATE mydb.staff SET name=?, surname=?, email=? WHERE user_id=$id");

    $stmt->bind_param("sss", $name, $surname, $email);

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