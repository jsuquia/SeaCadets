<?php
/**
 * Created by IntelliJ IDEA.
 * User: Javier
 * Date: 08/04/2018
 * Time: 17:13
 */

require('../../php_scripts/db.php');

$username = @$_POST['username'];
$id = @$_POST['id'];
$name = @$_POST['name'];
$surname = @$_POST['surname'];

$stmt = $conn->prepare("UPDATE mydb.users SET username=?, name=?, surname=? WHERE ID=$id");

$stmt->bind_param("sss", $username, $name, $surname);
$stmt->execute();