<?php
/**
 * Created by IntelliJ IDEA.
 * User: Javier
 * Date: 06/04/2018
 * Time: 18:31
 */

require('../php_scripts/db.php');

if(isset($_POST["add"]))
{

    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $rank = $_POST["rank"];

    $stmt = $conn->prepare("INSERT INTO mydb.students (Name, Surname, Rank) VALUES (?,?,?)");
    $stmt->bind_param("ssi", $name, $surname, $rank);

    $stmt->execute();

    $redirect_uri = $_SERVER['HTTP_REFERER'];
    header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
    exit();

}

if(isset($_POST["delete"]))
{

    $id = $_POST["student_id"];

    $sql = "DELETE FROM mydb.students WHERE ID = $id";

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