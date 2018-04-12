<?php
/**
 * Created by IntelliJ IDEA.
 * User: Javier
 * Date: 10/04/2018
 * Time: 14:58
 */

require('../php_scripts/check_cookie.php');

$sql = "SELECT ID FROM mydb.students WHERE user_id = $user->id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        $student_id = $row["ID"];
    }
}

$ranks_obj = (object)[];

$sql = "SELECT * FROM mydb.ranks";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $count=0;
    // output data of each row
    while ($row = $result->fetch_object()) {
        $ranks_obj->$count = $row;
        $count++;
    }
}

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

    <link rel="stylesheet" href="css/modules.css">
</head>
<body>

<div class="container-fluid">

    <div class="header">
        <h1>Modules</h1>
    </div>

    <table class="table">

        <?php

        foreach($ranks_obj as $obj)
        {

            if($obj->ID == $user->rank)
            {
                ?>
                <thead class="table-header" id="current_rank">
                    <tr>
                        <th class="rank-header"><?=$obj->rank?></th>
                    </tr>
                </thead>

                <?php
            } else {


                ?>
                <thead class="table-header">
                <tr>
                    <th class="rank-header"><?= $obj->rank ?></th>
                </tr>
                </thead>


                <?php
            }

            $sql = "SELECT module, abbr FROM mydb.modules WHERE rank = $obj->ID";
            $result = $conn->query($sql);

            if ($result->num_rows > 0)
            {
                // output data of each row
                while ($row = $result->fetch_assoc())
                {
                    $abbr = $row["abbr"];

                    $sql1 = "SELECT * FROM mydb.completed_modules WHERE student_ID = $student_id AND module = '$abbr'";
                    $result1 = $conn->query($sql1);

                    if ($result1->num_rows > 0)
                    {
                        ?>

                        <tr style="background-color: rgba(50,205,50,0.3)">
                            <td><?=$row["module"]?></td>
                        </tr>

                        <?php

                    }
                    else
                    {
                        ?>

                        <tr style="background-color: rgba(139,0,0,0.3);">
                            <td><?=$row["module"]?></td>
                        </tr>

                        <?php
                    }

                    ?>

                    <?php
                }
            }
        }

        ?>
    </table>

</div>



<!-- jQuery first, then Tether, then Bootstrap JS. -->
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

<script>

    $(document).ready(function() { window.location = '#current_rank'; });

</script>

</body>
</html>

