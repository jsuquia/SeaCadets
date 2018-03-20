<?php
/**
 * Created by IntelliJ IDEA.
 * User: Javier
 * Date: 18/09/2017
 * Time: 10:38
 */

global $conn;

$user = 'root';
$servername = 'localhost';
$password = '';

$conn = new mysqli($servername, $user, $password);

if ($conn->connect_error) {
    die('Connect Error (' . $conn->connect_errno . ') '
        . $conn->connect_error);
} else
{
    //echo 'Connection to database successful'; //Remove this later, for testing now
}