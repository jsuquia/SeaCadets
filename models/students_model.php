<?php
/**
 * Created by IntelliJ IDEA.
 * User: Javier
 * Date: 06/04/2018
 * Time: 18:31
 */

require('../php_scripts/db.php');

if(isset($_POST["submit"]))
{

    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $rank = $_POST["rank"];

    echo $name . $surname . $rank;

    $stmt = $conn->prepare("INSERT INTO mydb.students (Name, Surname, Rank) VALUES (?,?,?)");
    $stmt->bind_param("ssi", $name, $surname, $rank);

    $stmt->execute();

    $redirect_uri = $_SERVER['HTTP_REFERER'];
    header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
    exit();

}