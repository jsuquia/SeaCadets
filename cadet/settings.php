<?php
/**
 * Created by IntelliJ IDEA.
 * User: Javier
 * Date: 11/04/2018
 * Time: 18:57
 */

require('../php_scripts/check_cookie.php');

$sql = "SELECT rank, abbr FROM mydb.ranks WHERE ID = $user->rank";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {

        $rank = $row["rank"];

    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Settings</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/settings.css">
</head>
<body>

<div class="container-fluid">


        <div class="header">
            <h1>Profile</h1>
        </div>


    <div class="profile">

        <div class="row">

            <div class="col-5">
                <h5>Name</h5>
            </div>
            <div class="col-7">
                <?=$user->name?>
            </div>

            <div class="col-5">
                <h5>Surname</h5>
            </div>
            <div class="col-7">
                <?=$user->surname?>
            </div>

            <div class="col-5">
                <h5>Username</h5>
            </div>
            <div class="col-7">
                <?=$user->username?>
            </div>

            <div class="col-5">
                <h5>Rank</h5>
            </div>
            <div class="col-7">
                <?=$rank?>
            </div>

        </div>

    </div>

        <br>

        <div class="header">
            <h2>Update Password</h2>
        </div>

    <div class="password_update">
        <form action="models/settings_model.php" method ="post">
            <div class="row">

                <div class="col-5">
                    <h5>Password</h5>
                </div>
                <div class="col-7">
                    <input type="password" name="password" class="password"/>
                </div>

                <div class="col-12" align="center">
                    <button type="submit" name="update" class="btn btn-primary update">Update</button>
                </div>

            </div>
        </form>
    </div>
    <br>
    <form action="../logout.php">
        <button type="submit" class="btn logout" title="Logout">Logout</button>
    </form>
</div>



<!-- jQuery first, then Tether, then Bootstrap JS. -->
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>

</body>
</html>