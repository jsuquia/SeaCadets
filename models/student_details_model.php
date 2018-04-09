<?php
/**
 * Created by IntelliJ IDEA.
 * User: Javier
 * Date: 09/04/2018
 * Time: 20:49
 */

require('../php_scripts/db.php');

if(isset($_POST["update"]))
{

    $name = $_POST["name"];
    $surname = $_POST["surname"]; //HASH THIS HERE PLEASE
    $rank = $_POST["rank"];

    echo $name . $surname . $rank;

}