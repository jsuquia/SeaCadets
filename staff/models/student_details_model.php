<?php
/**
 * Created by IntelliJ IDEA.
 * User: Javier
 * Date: 09/04/2018
 * Time: 20:49
 */

require('../../php_scripts/db.php');

if(isset($_POST["update"]))
{
    $id = $_POST["student_id"];
    $name = $_POST["name"];
    $surname = $_POST["surname"]; //HASH THIS HERE PLEASE
    $rank = $_POST["rank"];

    $stmt = $conn->prepare("UPDATE mydb.students SET name=?, surname=?, rank=? WHERE ID=$id");

    $stmt->bind_param("sss", $name, $surname, $rank);
    $stmt->execute();

    $redirect_uri = $_SERVER['HTTP_REFERER'];
    header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
    exit();

}