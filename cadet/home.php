<?php
/**
 * Created by IntelliJ IDEA.
 * User: Javier
 * Date: 10/04/2018
 * Time: 14:58
 */

require('../php_scripts/check_cookie.php');

//echo $user->username . ", ";
//echo $user->name. ", ";
//echo $user->surname. ", ";
//echo $user->email. ", ";
//echo $user->rank. ", ";
//echo $user->privilege;

$sql = "SELECT ID FROM mydb.students WHERE user_id = $user->id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        $student_id = $row["ID"];
    }
}

$sql="SELECT ID FROM mydb.modules WHERE rank = $user->rank";

if ($result=mysqli_query($conn,$sql))
{
    // Return the number of rows in result set
    $totalmodules=mysqli_num_rows($result);

    // Free result set
    mysqli_free_result($result);
}

$sql="SELECT ID FROM mydb.completed_modules WHERE student_ID = $student_id AND rank = $user->rank";

if ($result=mysqli_query($conn,$sql))
{
    // Return the number of rows in result set
    $completedmodules=mysqli_num_rows($result);

    // Free result set
    mysqli_free_result($result);
}

$percentage = round(($completedmodules/$totalmodules)*100);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Home</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/home.css">
</head>
<body>

<div class="container-fluid">

    <div id="top">
        <div class="row align-items-center" id="row1">
            <div class="col-6">
                <h1><?=$user->name?> <?=$user->surname?></h1>
            </div>

            <?php

            $sql = "SELECT rank, abbr FROM mydb.ranks WHERE ID = $user->rank";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {

                    ?>

                    <div class="col-3" align="center">
                        <div class="rank_circle" style="background: url('../img/ranks/cdt1.jpg') no-repeat center;"></div>
                        <div class="title"><?=$row["rank"]?></div>
                    </div>

                    <?php
                }
            }

            ?>

            <div class="col-3" align="center">
                <button type="button" class="settings_btn" onClick="document.location.href='/scweb/cadet/settings.php'">
                    <i class="fa fa-cog" style="color: lightgray;"></i>
                </button>
            </div>
        </div>
    </div>

    <div id="middle">
        <div class="row align-items-center" id="row2">
            <div class="col-12">
                <button class="progress-btn" onClick="document.location.href='/scweb/cadet/modules.php'">
                    <div class="progress">
                        <div class="progress-bar bg-success" role="progressbar" style="width: <?=$percentage?>%;" aria-valuenow="<?=$percentage?>" aria-valuemin="0" aria-valuemax="100"><?=$percentage?>%</div>
                    </div>
                </button>
            </div>

            <div class="col-6" align="center">
                <h4>next rank </h4>
            </div>
            <div class="col-6" >
                <?php

                $sql = "SELECT rank, abbr FROM mydb.ranks WHERE ID = ($user->rank + 1)";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {

                        ?>

                        <div class="col-3" align="center">
                            <div class="next_rank_circle" style="background: url('../img/ranks/cdt1.jpg') no-repeat center;"></div>
                            <div class="title_2"><?=$row["rank"]?></div>
                        </div>

                        <?php
                    }
                }

                ?>
            </div>

        </div>
    </div>

    <div id="bottom">
        <div class="row align-items-center" id="row3">
            <div class="col-6" align="center">
                <button class="bottom_btn"></button>
                <h5>Specialisation</h5>
            </div>

            <div class="col-6" align="center">
                <button class="bottom_btn"></button>
                <h5>Proficiencies</h5>
            </div>
        </div>
    </div>

</div>



<!-- jQuery first, then Tether, then Bootstrap JS. -->
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

<script>

</script>

</body>
</html>

