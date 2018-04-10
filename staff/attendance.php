<?php
/**
 * Created by IntelliJ IDEA.
 * User: Javier
 * Date: 02/04/2018
 * Time: 19:22
 */

require('../php_scripts/check_cookie.php');
require('../php_scripts/check_privilege.php');

if(isset($_POST["submit"]))
{

    $module_ID = $_POST["module_id"];
    $module = $_POST["module"]; //HASH THIS HERE PLEASE
    $abbr = $_POST["abbr"];
    $rank = $_POST["rank"];

   //echo $module . $module_ID . $abbr . $rank;

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Attendance</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/attendance.css">
</head>
<body>

<div class="container-fluid">

    <div class="main-header">
        <div class="back">
            <a href="<?=$_SERVER['HTTP_REFERER']?>"><i class="fa fa-arrow-left"></i></i>&nbsp;back</a>
        </div>

        <div class="row">
            <div class="col-10">
                <h1 class="display-2 d-inline"><a href="/scweb/staff/ranks.php">Ranks/</a><a href="/scweb/staff/modules.php?id=<?=$rank?>">Modules/</a>Attendance &nbsp;</h1> <h4 class="d-inline">for <?=$module?> (<?=$abbr?>) - <?=date("d M Y")?></h4>
            </div>

            <div class="col-2">
                <form action="../logout.php">
                    <button type="submit" class="logout align-bottom" title="Logout">
                        <i class="fa fa-power-off fa-2x" style="color: red;"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="container">
        <table class="table">
            <tbody>
            <?php

            $sql = "SELECT ID, Name, Surname FROM mydb.students WHERE Rank=$rank ORDER BY Surname ASC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0)
            {
                // output data of each row
                while($row = $result->fetch_assoc())
                {
                    $student_ID = $row["ID"];
                    $name = $row["Name"];
                    $surname = $row["Surname"];
                    $date = date("Y-m-d");

                    $sql1 = "SELECT * FROM mydb.attendance WHERE student = $student_ID AND module = $module_ID AND date='$date'";
                    $result1 = $conn->query($sql1);

                    if ($result1->num_rows > 0)
                    {
                        ?>

                        <style>
                            .student<?=$student_ID?>
                            {
                                background-color: #ccffcc;
                            }
                        </style>

                        <?php
                    }
                    ?>

                    <tr class="student<?=$student_ID?>">
                        <th scope="row"><h6><?=$name?> <?=$surname?></h6></th>
                        <td class="buttons">
                            <button name="present" class="fa fa-check fa-2x present" onclick="update_attendance(this, <?=$student_ID?>, <?=$module_ID?>, <?=$rank?>, 1)"></button>
                            <button name="absent" class="fa fa-times fa-2x absent" onclick="update_attendance(this, <?=$student_ID?>, <?=$module_ID?>, <?=$rank?>, 0)"></button>
                        </td>
                    </tr>

                    <?php
                }
            }
            else
            {
                echo "0 results";
            }

            ?>
            </tbody>
        </table>
    </div>

</div>



<!-- jQuery first, then Tether, then Bootstrap JS. -->
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>

<script>

    function update_attendance(element, student_id, module_id, rank, check)
    {

        jQuery.ajax({
            type: "POST",
            url: "ajax/update_attendance.php",
            data: {student_id: student_id, module_id: module_id, rank: rank, check: check},
            cache: false
        });

        if(check == 1)
        {
            $(element).closest("tr").css( "background-color", "#ccffcc");
        } else
        {
            $(element).closest("tr").css( "background-color", "#ffc1c1");
        }

    }

</script>

</body>
</html>