<?php
/**
 * Created by IntelliJ IDEA.
 * User: Javier
 * Date: 05/04/2018
 * Time: 15:47
 */

require('../php_scripts/db.php');

$checked = @$_POST['checked'];
$id = @$_POST['student_id'];
$module = @$_POST['module'];
$rank = @$_POST['rank'];

if($checked == 1)
{
    $sql = "DELETE FROM mydb.completed_modules WHERE student_ID = $id AND module = '$module'";

    if ($conn->query($sql) !== TRUE)
    {
        echo "Error deleting record: " . $conn->error;
    }
} else
{
    $stmt = $conn->prepare("INSERT INTO mydb.completed_modules (student_ID, module, rank, date) VALUES (?,?,?,?)");
    $stmt->bind_param("isis", $id, $module, $rank, $date);

    $date = date("Y-m-d H:i:s");

    $stmt->execute();
}