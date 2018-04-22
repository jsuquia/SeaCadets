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

    <!-- Modal -->
    <div class="modal fade" id="choice" tabindex="-1" role="dialog" aria-labelledby="choice" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Go To</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="models/choice_model.php" method ="post">
                    <div class="modal-body">

                        <input type="hidden" name="id" id="rank_id" value="">

                        <div class="row">
                            <div class="col-12">
                                <button class="btn btn-primary student" name="student">Student</button>
                            </div>

                            <div class="col-12">
                                <button class="btn btn-primary module" name="modules">Modules</button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="main-header">
        <div class="back">
            <a>&nbsp;</a>
        </div>
        <div class="row">
            <div class="col-10">
                <h1 class="display-2 d-inline">CTP </h1> <h1 class="display-4 d-inline">by Ranks</h1>
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

                        <button type="button" id="btn" data-toggle="modal" data-target="#choice" onclick="setID(<?=$id?>)">
                            <img src="../img/ranks/circle.jpg" class="rounded" id="img" alt="logo">
                        </button>

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

    <!-- Modal -->
    <div class="modal fade" id="proficiencies" tabindex="-1" role="dialog" aria-labelledby="proficiencies" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Go To</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="models/proficiencies_model.php" method ="post">
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-12">
                                <button class="btn btn-primary onshore" name="onshore">ONSHORE</button>
                            </div>

                            <div class="col-12">
                                <button class="btn btn-primary offshore" name="offshore">OFFSHORE</button>
                            </div>

                            <div class="col-12">
                                <button class="btn btn-primary boating" name="boating">BOATING</button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="main-header-2">
        <div class="row">
            <div class="col-10">
                <h1 class="display-2">Rewards</h1>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-4 col-md-3" id="rankdiv">
            <div class="text-center">

                <button type="button" id="btn" onclick="document.location.href='/scweb/staff/specialisations.php'">
                    <img src="../img/ranks/circle.jpg" class="rounded" id="img" alt="logo">
                </button>

                <h4 class="d-none d-md-block">Specialisations</h4>
                <h4 class="d-md-none">SP</h4>
            </div>
        </div>

        <div class="col-4 col-md-3" id="rankdiv">
            <div class="text-center">

                <button type="button" id="btn" data-toggle="modal" data-target="#proficiencies">
                    <img src="../img/ranks/circle.jpg" class="rounded" id="img" alt="logo">
                </button>

                <h4 class="d-none d-md-block">Proficiecies</h4>
                <h4 class="d-md-none">PR</h4>
            </div>
        </div>
    </div>

</div>



<!-- jQuery first, then Tether, then Bootstrap JS. -->
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

<script>

    function setID(id)
    {
        document.getElementById("rank_id").value = id;
    }

</script>

</body>
</html>


