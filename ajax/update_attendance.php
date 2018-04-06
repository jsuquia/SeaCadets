<?php
/**
 * Created by IntelliJ IDEA.
 * User: Javier
 * Date: 05/04/2018
 * Time: 15:47
 */

require('../php_scripts/db.php');

$check = @$_POST['check'];
$id = @$_POST['student_id'];
$module_id = @$_POST['module_id'];
$rank = @$_POST['rank'];

if($check == 1)
{
    $stmt = $conn->prepare("INSERT INTO mydb.attendance (student, module, rank, date) VALUES (?,?,?,?)");
    $stmt->bind_param("iiis", $id, $module_id, $rank, $date);

    $date = date("Y-m-d");

    $stmt->execute();
} else
{
    $sql = "DELETE FROM mydb.attendance WHERE student = $id AND module = '$module_id'";

    if ($conn->query($sql) !== TRUE)
    {
        echo "Error deleting record: " . $conn->error;
    }
}