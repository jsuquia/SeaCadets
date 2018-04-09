<?php
/**
 * Created by IntelliJ IDEA.
 * User: Javier
 * Date: 09/04/2018
 * Time: 21:42
 */

require('../php_scripts/db.php');

$id = @$_POST['id'];
$password = @$_POST['password'];

$password_hash = password_hash( $password, PASSWORD_DEFAULT, [ 'cost' => 11 ] );

$stmt = $conn->prepare("UPDATE mydb.users SET password=? WHERE ID=$id");

$stmt->bind_param("s", $password_hash);
$stmt->execute();