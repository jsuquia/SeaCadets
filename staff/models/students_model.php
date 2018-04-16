<?php
/**
 * Created by IntelliJ IDEA.
 * User: Javier
 * Date: 06/04/2018
 * Time: 18:31
 */

require('../../php_scripts/db.php');

if(isset($_POST["add"]))
{

    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $rank = $_POST["rank"];

    $stmt = $conn->prepare("INSERT INTO mydb.users (username, privilege) VALUES (?,?)");
    $stmt->bind_param("si", $username, $privilege);

    $username = strtolower($name[0].$surname);
    $privilege = 3;

    $stmt->execute();

    $last_id = $conn->insert_id;

    $stmt = $conn->prepare("INSERT INTO mydb.students (name, surname, rank, user_id) VALUES (?,?,?,?)");
    $stmt->bind_param("ssii", $name, $surname, $rank, $last_id);

    $stmt->execute();

    $redirect_uri = $_SERVER['HTTP_REFERER'];
    header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
    exit();

}

if(isset($_POST["delete"]))
{

    $id = $_POST["student_id"];

    $sql = "SELECT user_id FROM mydb.students WHERE ID=$id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $user_id = $row["user_id"];
        }
    }

    $sql = "DELETE FROM mydb.students WHERE ID = $id";

    if ($conn->query($sql) !== TRUE)
    {
        echo "Error deleting record: " . $conn->error;
    }

    $sql = "DELETE FROM mydb.users WHERE ID = $user_id";

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

if(isset($_POST["update_rank"]))
{
    $id = $_POST["student_id"];
    $rank = $_POST["rank"];

    $stmt = $conn->prepare("UPDATE mydb.students SET rank=? WHERE ID=$id");

    $stmt->bind_param("s", $rank);
    $stmt->execute();

    $redirect_uri = $_SERVER['HTTP_REFERER'];
    header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
    exit();

}