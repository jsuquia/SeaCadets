<?php
/**
 * Created by IntelliJ IDEA.
 * User: Javier
 * Date: 09/04/2018
 * Time: 20:08
 */

require('../php_scripts/check_cookie.php');
require('../php_scripts/check_privilege.php');

if(isset($_GET["id"]))
{
    $student_id = $_GET["id"];
} else
{
    $redirect_uri = '/scweb/staff/ranks.php';
    header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
    exit();
}


$sql = "SELECT students.name, students.surname, students.rank, users.ID, users.username FROM mydb.students LEFT JOIN mydb.users ON students.user_id = users.ID WHERE students.ID = $student_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
// output data of each row
    while ($row = $result->fetch_assoc()) {
        $name = $row["name"];
        $surname = $row["surname"];
        $rank_id = $row["rank"];
        $username = $row["username"];
        $user_id = $row["ID"];
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Students</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/student_details.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
</head>
<body>

<div class="container-fluid">

    <div class="main-header">
        <div class="back">
            <a href="<?=$_SERVER['HTTP_REFERER']?>"><i class="fa fa-arrow-left"></i></i>&nbsp;back</a>
        </div>

        <div class="row">
            <div class="col-10">
                <h1 class="display-2 d-inline"><a href="/scweb/staff/ranks.php">Ranks/</a><a href="<?=$_SERVER['HTTP_REFERER']?>">Students/</a>Student Details</h1>
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
        <h2 class="title">Student Info</h2>
        <br>

        <form action="models/student_details_model.php" method ="post">
            <input type="hidden" name="student_id" value="<?=$student_id?>"/>

            <div class="row">
                <div class="col-6">
                    <div class="col-12">
                        <h4>Name</h4>
                    </div>
                    <div class="col-12">
                        <input type="text" class="details" name="name" value="<?=$name?>"/>
                    </div>
                </div>

                <div class="col-6">
                    <div class="col-12">
                        <h4>Surname</h4>
                    </div>
                    <div class="col-12">
                        <input type="text" class="details" name="surname" value="<?=$surname?>"/>
                    </div>
                </div>

                <br><br><br><br><br>

                <div class="col-6">
                    <div class="col-12">
                        <h4>Rank</h4>
                    </div>
                    <div class="col-12">
                        <select class="dropdown" name="rank">
                            <?php

                            $sql = "SELECT ID, rank FROM mydb.ranks";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {

                                    $id = $row["ID"];
                                    $rank = $row["rank"];

                                    if($id == $rank_id)
                                    {
                                        ?>

                                        <option selected value="<?=$id?>"><?=$rank?></option>

                                        <?php
                                    } else
                                    {
                                        ?>

                                        <option value="<?=$id?>"><?=$rank?></option>

                                        <?php
                                    }

                                }
                            }

                            ?>

                        </select>
                    </div>
                </div>

                <div class="col-6 align-self-end">
                    <button type="submit" name="update" class="btn btn-primary update_details">Update Details</button>
                </div>
            </div>
        </form>

        <br><br><br>

        <h2 class="title">Student Login Details</h2>
        <br>

        <form action="models/student_details_model.php" method ="post">
            <div class="row">
                <div class="col-6">
                    <div class="col-12">
                        <h4>Username</h4>
                    </div>
                    <div class="col-12">
                        <input type="text" class="details" name="username" value="<?=$username?>"/>
                    </div>
                </div>

                <div class="col-6">
                    <div class="col-12">
                        <h4>Password</h4>
                    </div>
                    <div class="col-12">
                        <button type="button" class="details" style="cursor: pointer;" onclick="generate_password(<?=$user_id?>)">Generate New Password</button>
                    </div>
                </div>
            </div>
        </form>

    </div>


</div>



<!-- jQuery first, then Tether, then Bootstrap JS. -->
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<script>

    function generate_password(id)
    {
        var password = "";
        var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

        for (var i = 0; i < 8; i++)
            password += possible.charAt(Math.floor(Math.random() * possible.length));

        toastr.options = {
            closeButton: true,
            positionClass: "toast-top-full-width",
            preventDuplicates: true,
            showDuration: "0",
            hideDuration: "0",
            timeOut: "0",
            extendedTimeOut: "0",
            tapToDismiss: false
        };

        toastr.info("This is the new password! Make sure to take a note of it", password);

        jQuery.ajax({
            type: "POST",
            url: "ajax/generate_password.php",
            data: {id: id, password: password},
            cache: false
        });

    }

</script>

</body>
</html>
