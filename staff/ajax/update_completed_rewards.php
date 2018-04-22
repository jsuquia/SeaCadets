<?php
/**
 * Created by IntelliJ IDEA.
 * User: Javier
 * Date: 05/04/2018
 * Time: 15:47
 */

require('../../php_scripts/db.php');

$checked = @$_POST['checked'];
$id = @$_POST['student_id'];
$subcategory = @$_POST['subcategory'];
$category = @$_POST['category'];
$reward = @$_POST['reward'];

if($checked == 1)
{
    $sql = "DELETE FROM mydb.completed_rewards WHERE student_ID = $id AND subcategory = $subcategory AND category = $category AND reward = $reward";

    if ($conn->query($sql) !== TRUE)
    {
        echo "Error deleting record: " . $conn->error;
    }
} else
{
    $stmt = $conn->prepare("INSERT INTO mydb.completed_rewards (student_ID, subcategory, category, reward, date) VALUES (?,?,?,?,?)");
    $stmt->bind_param("iiiis", $id, $subcategory, $category, $reward, $date);

    $date = date("Y-m-d H:i:s");

    $stmt->execute();
}