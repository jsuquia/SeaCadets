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
$email = @$_POST['email'];
$privilege = @$_POST['privilege'];

$stmt = $conn->prepare("UPDATE mydb.users SET username=?, privilege=? WHERE ID=$id");

$stmt->bind_param("si", $username, $privilege);
$stmt->execute();

$stmt = $conn->prepare("UPDATE mydb.staff SET name=?, surname=?, email=? WHERE user_id=$id");

$stmt->bind_param("sss", $name, $surname, $email);

$stmt->execute();