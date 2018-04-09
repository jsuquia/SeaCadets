<?php
/**
 * Created by IntelliJ IDEA.
 * User: Javier
 * Date: 02/04/2018
 * Time: 19:22
 */

require('php_scripts/check_cookie.php');

if(isset($_GET["id"]))
{
    $rankID = $_GET["id"];
} else
{
    $redirect_uri = '/scweb/ranks.php';
    header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Modules</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/modules.css">
</head>
<body>

<div class="container-fluid">

    <div class="main-header">
        <div class="back">
            <a href="<?=$_SERVER['HTTP_REFERER']?>"><i class="fa fa-arrow-left"></i></i>&nbsp;back</a>
        </div>
        <div class="row">
            <div class="col-10">
                <h1 class="display-2 d-inline"><a href="/scweb/ranks.php">Ranks/</a>Modules
                    <button type="button" class="btn btn-primary" id="update_modules" onClick="document.location.href='/scweb/update_modules.php?id=<?=$rankID?>'">Update Modules</button>
                </h1>
            </div>

            <div class="col-2">
                <form action="logout.php">
                    <button type="submit" class="logout align-bottom" title="Logout">
                        <i class="fa fa-power-off fa-2x" style="color: red;"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        <?php

        $sql = "SELECT ID, module, abbr FROM mydb.modules WHERE rank=$rankID";
        $result = $conn->query($sql);

        if ($result->num_rows > 0)
        {
            // output data of each row
            while($row = $result->fetch_assoc())
            {
                $module_ID = $row["ID"];
                $module = $row["module"];
                $abbr = $row["abbr"];

                ?>

                <div class="col-4 col-md-2" id="rankdiv">
                    <div class="text-center">
                        <form action="attendance.php" method ="post">
                            <input type="hidden" name="module_id" value="<?=$module_ID?>"/>
                            <input type="hidden" name="module" value="<?=$module?>"/>
                            <input type="hidden" name="abbr" value="<?=$abbr?>"/>
                            <input type="hidden" name="rank" value="<?=$rankID?>"/>
                            <button type="submit" name="submit" class="modules">
                                <?=$abbr?>
                            </button>
                            <div class="title"><?=$module?></div>
                            <p class="d-none d-md-block"><?=$module?></p>
                            <h4 class="d-md-none"> </h4>
                        </form>
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