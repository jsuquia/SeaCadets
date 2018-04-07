<?php
/**
 * Created by IntelliJ IDEA.
 * User: Javier
 * Date: 07/04/2018
 * Time: 13:31
 */

require('../php_scripts/db.php');

$id = @$_POST['id'];
$module = @$_POST['module'];
$abbr = @$_POST['abbr'];

$stmt = $conn->prepare("UPDATE mydb.modules SET module=?, abbr=? WHERE ID=$id");

$stmt->bind_param("ss", $module, $abbr);
$stmt->execute();