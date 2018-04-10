<?php
/**
 * Created by IntelliJ IDEA.
 * User: Javier
 * Date: 07/04/2018
 * Time: 13:25
 */

require('../../php_scripts/db.php');

if(isset($_POST["add"]))
{

    $rank = $_POST["rank"];
    $module = $_POST["name"];
    $abbr = $_POST["abbr"];

    $stmt = $conn->prepare("INSERT INTO mydb.modules (module, abbr, rank) VALUES (?,?,?)");
    $stmt->bind_param("ssi", $module, $abbr, $rank);

    $stmt->execute();

    $redirect_uri = $_SERVER['HTTP_REFERER'];
    header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
    exit();

}

if(isset($_POST["delete"]))
{

    $id = $_POST["id"];

    $sql = "DELETE FROM mydb.modules WHERE ID = $id";

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