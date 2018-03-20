<?php
/**
 * Created by IntelliJ IDEA.
 * User: Javier
 * Date: 15/09/2017
 * Time: 11:52
 */

require('php_scripts/check_cookie.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/staff_main.css">
</head>
<body>

<div class="container-fluid">

    <div class="main-header">
        <h1 class="display-2">Ranks</h1>
    </div>

    <a href="logout.php"> logout </a>

    <div class="row">

        <?php

        $sql = "SELECT rank, abbr FROM mydb.ranks";
        $result = $conn->query($sql);

        if ($result->num_rows > 0)
        {
        // output data of each row
            while($row = $result->fetch_assoc())
            {
            $rank = $row["rank"];
            $abbr = $row["abbr"];

            ?>

            <div class="col-4 col-md-3" id="rankdiv">
                <div class="text-center">
                    <a href="">
                        <img src="img/ranks/circle.jpg" class="rounded" id="img" alt="logo">
                    </a>
                    <h4><?=$rank?> - <?=$abbr?></h4>
                </div>
            </div>

            <?php
            }
        }
        else
        {
            echo "0 results";
        }

        ?>
    </div>

</div>



<!-- jQuery first, then Tether, then Bootstrap JS. -->
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

</body>
</html>


