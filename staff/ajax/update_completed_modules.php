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

$sql = "SELECT name, surname FROM mydb.students WHERE ID=$id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        $name = $row["name"];
        $surname = $row["surname"];
    }
}

$sql = "SELECT rank FROM mydb.ranks WHERE ID=($rank+1)";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        $rank_name = $row["rank"];
    }
}


$sql="SELECT ID FROM mydb.modules WHERE rank = $rank";

if ($result=mysqli_query($conn,$sql))
{
    // Return the number of rows in result set
    $totalmodules=mysqli_num_rows($result);

    // Free result set
    mysqli_free_result($result);
}

$sql="SELECT ID FROM mydb.completed_modules WHERE student_ID = $id AND rank = $rank";

if ($result=mysqli_query($conn,$sql))
{
    // Return the number of rows in result set
    $completedmodules=mysqli_num_rows($result);

    // Free result set
    mysqli_free_result($result);
}

$percentage = round(($completedmodules/$totalmodules)*100);

$string = $name . " " . $surname . " to " . $rank_name . "?";

echo json_encode((int)$id);
echo json_encode(',');
echo json_encode($percentage);
echo json_encode(',');
echo json_encode($string);