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
    $redirect_uri = '/scweb/staff_main.php';
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
    <title>Students</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/students.css">
</head>
<body>

<div class="container-fluid">

    <div class="main-header">
        <div class="row">
            <div class="col-10">
                <h1 class="display-2 d-inline">Students
                    <button type="button" class="btn btn-primary" id="enabling_btn" onclick="activateBtn()">Update Progress</button>
                    <button type="button" class="btn btn-primary" id="adding_student" data-toggle="modal" data-target="#addStudent">Add Student</button>
                </h1>

            </div>

            <!-- Modal -->
            <div class="modal fade" id="addStudent" tabindex="-1" role="dialog" aria-labelledby="addStudent" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Student</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="models/students_model.php" method ="post">
                            <div class="modal-body">
                                <input type="hidden" name="rank" value="<?=$rankID?>"/>

                                <div class="row name">
                                    <h6 class="col-12 col-md-3 text">Name</h6>
                                    <input type="text" name="name" class="col-12 col-md-9 form-control" id="name" placeholder="Gordon" required>
                                </div>
                                <br>
                                <div class="row surname">
                                    <h6 class="col-12 col-md-3 text">Surname</h6>
                                    <input type="text" name="surname" class="col-12 col-md-9 form-control d-inline" id="surname" placeholder="Ramsay" required>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="submit" class="btn btn-primary">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
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

    <div class="left">
        <table class="table table-striped" style="width: 15rem;">
            <thead>
            <tr>
                <th scope="col" style="height: 3.05rem;"></th>
            </tr>
            </thead>

            <tbody>
            <?php

            $sql = "SELECT ID, Name, Surname FROM mydb.students WHERE Rank=$rankID ORDER BY Surname ASC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0)
            {
                // output data of each row
                while($row = $result->fetch_assoc())
                {
                    $student_ID = $row["ID"];
                    $name = $row["Name"];
                    $surname = $row["Surname"];

                    ?>

                    <tr>
                        <th scope="row"><h6><?=$name?> <?=$surname?></h6></th>
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

    <div class="right">
        <table class="table table-striped">
            <thead>
            <tr>
                <?php

                $modules_arr = array();

                $sql = "SELECT abbr FROM mydb.modules WHERE Rank=$rankID";
                $result = $conn->query($sql);

                if ($result->num_rows > 0)
                {
                    // output data of each row
                    while($row = $result->fetch_assoc())
                    {
                        $abbr = $row["abbr"];
                        $modules_arr[] = $row["abbr"];

                        ?>

                        <th scope="col"><?=$abbr?></th>

                        <?php
                    }
                }

                ?>

            </tr>
            </thead>

            <tbody>
            <?php

            $sql = "SELECT ID FROM mydb.students WHERE Rank=$rankID";
            $result = $conn->query($sql);

            if ($result->num_rows > 0)
            {
                // output data of each row
                while($row = $result->fetch_assoc())
                {
                    $student_ID = $row["ID"];

                    ?>

                    <tr>
                        <?php

                        foreach($modules_arr as $abbr)
                        {
                            $sql1 = "SELECT * FROM mydb.completed_modules WHERE student_ID = $student_ID AND module = '$abbr'";
                            $result1 = $conn->query($sql1);

                            if ($result1->num_rows > 0)
                            {
                                ?>

                                <td style="background-color: limegreen"><button class="update_btn" id="btn" disabled onclick="update(this, <?=$student_ID?>, '<?=$abbr?>', <?=$rankID?>, 1)"></button></td>

                                <?php

                            }
                            else
                            {
                                ?>

                                <td style="background-color: #A94530;"><button class="update_btn" disabled onclick="update(this, <?=$student_ID?>, '<?=$abbr?>', <?=$rankID?>, 0)"></button></td>

                                <?php
                            }
                        }

                        ?>
                    </tr>

                    <?php
                }
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

    function activateBtn()
    {
        if(document.getElementById("btn").disabled)
        {
            $(".update_btn").prop("disabled", false);
            $(".update_btn").css("cursor", "pointer");
            $("#enabling_btn").text('Save Progress');
        }
        else
        {
            $(".update_btn").prop("disabled", true);
            $(".update_btn").css("cursor", "default");
            $("#enabling_btn").text('Update Progress');
        }

    }

    function update(element, student_id, module, rank, checked){

        jQuery.ajax({
            type: "POST",
            url: "ajax/update_modules.php",
            data: {student_id: student_id, module: module, rank: rank, checked: checked},
            cache: false
        });

        if(checked == 1)
        {

            $(element).css( "background-color", "#A94530");
        } else
        {

            $(element).css( "background-color", "limegreen");
        }

    }

</script>

</body>
</html>