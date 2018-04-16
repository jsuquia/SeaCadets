<?php
/**
 * Created by IntelliJ IDEA.
 * User: Javier
 * Date: 02/04/2018
 * Time: 19:22
 */

require('../php_scripts/check_cookie.php');
require('../php_scripts/check_privilege.php');

if(isset($_GET["id"]))
{
    $rankID = $_GET["id"];
} else
{
    $redirect_uri = '/scweb/staff/ranks.php';
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

    <!-- Modal -->
    <div class="modal fade" id="updateRank" tabindex="-1" role="dialog" aria-labelledby="updateRank" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Student's Rank</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="models/students_model.php" method ="post">
                    <div class="modal-body">
                        <input type="hidden" name="rank" value="<?=($rankID+1)?>"/>
                        <input type="hidden" name="student_id" id="student_id" value=""/>

                        <h3 class="col-12" style="text-align: center; margin-bottom: 1.5rem; margin-top: 1rem;">Do you wish to update</h3>

                        <h2 class="col-12" style="text-align: center;" id="update_rank_text"></h2>

                        <br>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                        <button type="submit" name="update_rank" class="btn btn-primary">Yes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="main-header">
        <div class="back">
            <a href="/scweb/staff/ranks.php"><i class="fa fa-arrow-left"></i></i>&nbsp;back</a>
        </div>

        <div class="row">
            <div class="col-10">
                <h1 class="display-2 d-inline"><a href="/scweb/staff/ranks.php">Ranks/</a>Students
                    <button type="button" class="btn btn-primary" id="enabling_btn" onclick="activateBtn()">Update Progress</button>
                    <button type="button" class="btn btn-primary" id="adding_student" data-toggle="modal" data-target="#addStudent">Add Student</button>
                </h1>

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
                        <button type="submit" name="add" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="left">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col" style="height: 3.05rem;"></th>
            </tr>
            </thead>

            <tbody>
            <?php

            $sql = "SELECT ID, name, surname FROM mydb.students WHERE rank=$rankID ORDER BY surname ASC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0)
            {
                // output data of each row
                while($row = $result->fetch_assoc())
                {
                    $student_ID = $row["ID"];
                    $name = $row["name"];
                    $surname = $row["surname"];

                    $percentage = percentage($rankID,$student_ID);

                    ?>

                    <tr>
                        <th class="student_name" scope="row">
                            <h6>
                                <div class="row">
                                    <div class="col-6">
                                        <a href="student_details.php?id=<?=$student_ID?>"><?=$name?> <?=$surname?></a>
                                    </div>

                                    <div class="col-6">
                                        <div class="progress">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: <?=$percentage?>%" aria-valuenow="<?=$percentage?>" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>

                            </h6>

                            <form action="models/students_model.php" method ="post">
                                <input type="hidden" name="student_id" value="<?=$student_ID?>"/>
                                <button type="submit" name="delete" class="delete">
                                    <i class="fa fa-trash-o"></i>
                                </button>
                            </form>
                        </th>
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

                $sql = "SELECT module, abbr FROM mydb.modules WHERE Rank=$rankID";
                $result = $conn->query($sql);

                if ($result->num_rows > 0)
                {
                    // output data of each row
                    while($row = $result->fetch_assoc())
                    {
                        $abbr = $row["abbr"];
                        $module = $row["module"];
                        $modules_arr[] = $row["abbr"];

                        ?>

                        <th scope="col">
                            <div><?=$abbr?></div>
                            <div class="caption"><?=$module?></div>
                        </th>


                        <?php
                    }
                }

                ?>

            </tr>
            </thead>

            <tbody>
            <?php

            $sql = "SELECT ID FROM mydb.students WHERE rank=$rankID ORDER BY surname ASC";
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

                                <td style="background-color: limegreen"><button class="update_btn" id="btn" data-checked="1" disabled onclick="update(this, <?=$student_ID?>, '<?=$abbr?>', <?=$rankID?>)"></button></td>

                                <?php

                            }
                            else
                            {
                                ?>

                                <td style="background-color: white;"><button class="update_btn fa fa-times" data-checked="0" disabled onclick="update(this, <?=$student_ID?>, '<?=$abbr?>', <?=$rankID?>)"></button></td>

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
<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

<script>

    $(document).ready(function () {
        $(document).on('mouseenter', '.student_name', function () {
            $(this).find(":button").show();
        }).on('mouseleave', '.student_name', function () {
            $(this).find(":button").hide();
        });
    });

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

    function update(element, student_id, module, rank){

        var checked = $(element).data("checked");

        jQuery.ajax({
            type: "POST",
            url: "ajax/update_completed_modules.php",
            data: {student_id: student_id, module: module, rank: rank, checked: checked},
            cache: false,
            success: function(data) {
                check_completion(data);
            },
        });

        if(checked == 1)
        {

            $(element).css( "background-color", "#ffc1c1");
            $(element).prop( "class", "update_btn fa fa-times");
            $(element).data("checked", 0);
        } else
        {

            $(element).css( "background-color", "limegreen");
            $(element).prop( "class", "update_btn fa fa-check");
            $(element).data("checked", 1);
        }

    }

    function check_completion(data)
    {
        var arr = data.split('","');

        var text = arr[2].slice(1, -1);

        if(arr[1] == 100)
        {
            $('#updateRank').modal('show');
            $('#student_id').val(arr[0]);
            $('#update_rank_text').text(text);
        }
    }

</script>

</body>
</html>


<?php

    function percentage($rank_id, $student_id)
    {
        global $conn;

        $sql="SELECT ID FROM mydb.modules WHERE rank = $rank_id";

        if ($result=mysqli_query($conn,$sql))
        {
            // Return the number of rows in result set
            $totalmodules=mysqli_num_rows($result);

            // Free result set
            mysqli_free_result($result);
        }

        $sql="SELECT ID FROM mydb.completed_modules WHERE student_ID = $student_id AND rank = $rank_id";

        if ($result=mysqli_query($conn,$sql))
        {
            // Return the number of rows in result set
            $completedmodules=mysqli_num_rows($result);

            // Free result set
            mysqli_free_result($result);
        }

        $percentage = round(($completedmodules/$totalmodules)*100);

        return $percentage;
    }

?>
