<?php
/**
 * Created by IntelliJ IDEA.
 * User: Javier
 * Date: 15/09/2017
 * Time: 11:52
 */

require('../php_scripts/check_cookie.php');
require('../php_scripts/check_privilege.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Ranks</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/ranks.css">
</head>
<body>

<div class="container-fluid">

    <div class="main-header">
        <div class="back">
            <a>&nbsp;</a>
        </div>
        <div class="row">
            <div class="col-10">
                <h1 class="display-2">Ranks

                </h1>
            </div>

            <div class="col-2">
                <div class="row">
                    <div class="col-6">
                        <button type="button" class="btn btn-primary" id="settings_btn" onClick="document.location.href='/scweb/staff/settings.php'">Settings
                            <i class="fa fa-cog" style="color: white;"></i>
                        </button>
                    </div>
                    <div class="col-6">
                        <form action="../logout.php">
                            <button type="submit" class="logout align-bottom" title="Logout">
                                <i class="fa fa-power-off fa-2x" style="color: red;"></i>
                            </button>
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </div>

    <div class="row">

        <?php

        $sql = "SELECT ID, rank, abbr FROM mydb.ranks";
        $result = $conn->query($sql);

        if ($result->num_rows > 0)
        {
        // output data of each row
            while($row = $result->fetch_assoc())
            {
                $id = $row["ID"];
                $rank = $row["rank"];
                $abbr = $row["abbr"];

                ?>

                <div class="col-4 col-md-3" id="rankdiv">
                    <div class="text-center">

                        <form action="models/choice_model.php" method ="post">
                            <input type="hidden" name="id" value="<?=$id?>">
                            <input type="hidden" name="choice" id="choice<?=$id?>" value="">

                            <button type="submit" id="btn" name="submit" onclick="getChoice(<?=$id?>)">
                                <img src="../img/ranks/circle.jpg" class="rounded" id="img" alt="logo">
                            </button>
                        </form>

                        <h4 class="d-none d-md-block"><?=$rank?> - <?=$abbr?></h4>
                        <h4 class="d-md-none"><?=$abbr?></h4>
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

<!--    <div class="quarter-circle"></div>-->

    <div class="btn-group" data-toggle="buttons">
        <label class="btn btn-secondary">
            <input type="radio" name="options" value="students" checked> Students
        </label>
        <label class="btn btn-secondary">
            <input type="radio" name="options" value="modules"> Modules
        </label>
    </div>

</div>



<!-- jQuery first, then Tether, then Bootstrap JS. -->
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

<script>

    function getChoice(id){
        var radios = document.getElementsByName('options');
        var choice = "choice" + id;

        for (var i = 0, length = radios.length; i < length; i++)
        {
            if (radios[i].checked)
            {
                // do whatever you want with the checked radio
                document.getElementById(choice).value = radios[i].value;

                // only one radio can be logically checked, don't check the rest
                break;
            }
        }
    }

</script>

</body>
</html>


