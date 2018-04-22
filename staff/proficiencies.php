<?php
/**
 * Created by IntelliJ IDEA.
 * User: Javier
 * Date: 02/04/2018
 * Time: 19:22
 */

require('../php_scripts/check_cookie.php');
require('../php_scripts/check_privilege.php');

if(isset($_GET["reward"]))
{
    $reward_id = $_GET["reward"];
} else
{
    $redirect_uri = '/scweb/staff/ranks.php';
    header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
    exit();
}

if(isset($_GET["id"]))
{
    $rank_id = $_GET["id"];
} else
{
    $rank_id = 1;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Specialisations</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/specialisations.css">
</head>
<body>

<div class="container-fluid">

    <div class="main-header">
        <div class="back">
            <a href="/scweb/staff/ranks.php"><i class="fa fa-arrow-left"></i></i>&nbsp;back</a>
        </div>

        <div class="row">
            <div class="col-10">
                <h1 class="display-2 d-inline buttons"><a href="/scweb/staff/ranks.php">Ranks/</a><?php if($reward_id == 2) echo "Onshore "; else if($reward_id == 3) echo "Offshore "; else if($reward_id == 4) echo "Boating ";?>Proficiencies
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
    <br>

    <h4>Select Rank to view &nbsp;
        <select class="dropdown" name="rank" onchange="location = '/scweb/staff/proficiencies.php?reward=' + <?=$reward_id?> + '&id=' + this.options[this.selectedIndex].value;">
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
    </h4>


    <div class="left">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col" style="height: 3.7rem; border-bottom: none"></th>
            </tr>
            <tr>
                <th scope="col" style="height: 3.1rem;"></th>
            </tr>
            </thead>

            <tbody>
            <?php

            $sql = "SELECT ID, name, surname FROM mydb.students WHERE rank=$rank_id ORDER BY surname ASC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0)
            {
                // output data of each row
                while($row = $result->fetch_assoc())
                {
                    $student_ID = $row["ID"];
                    $name = $row["name"];
                    $surname = $row["surname"];

                    ?>

                    <tr>
                        <th class="student_name" scope="row">
                            <h6>
                                <div class="row">
                                    <div class="col-12">
                                        <a href="student_details.php?id=<?=$student_ID?>"><?=$name?> <?=$surname?></a>
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

            ?>
            </tbody>
        </table>
    </div>

    <div class="right">

        <?php

        $sql = "SELECT ID, name FROM mydb.categories WHERE rewards_id=$reward_id ORDER BY ID ASC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0)
        {
            // output data of each row
            while($row = $result->fetch_assoc())
            {
                $category_id = $row["ID"];
                $name = $row["name"];

                $sql4="SELECT category_id FROM mydb.subcategories WHERE category_id = $category_id";

                if ($result4=mysqli_query($conn,$sql4))
                {
                    // Return the number of rows in result set
                    $totalsubcategories=mysqli_num_rows($result4);

                    // Free result set
                    mysqli_free_result($result4);
                }

                ?>
                <table class="table table-striped" id="categoryid<?=$category_id?>">
                    <thead>
                    <tr>
                        <th scope="col" colspan="<?=$totalsubcategories?>">
                            <div align="center"><h4><?=$name?></h4></div>
                        </th>
                    </tr>

                    <tr>
                        <?php

                        $count = 0;
                        $subcategories_arr = array();

                        $sql1 = "SELECT ID, name FROM mydb.subcategories WHERE category_id=$category_id ORDER BY ID ASC";
                        $result1 = $conn->query($sql1);

                        if ($result1->num_rows > 0)
                        {
                            // output data of each row
                            while($row1 = $result1->fetch_assoc())
                            {
                                $name = $row1["name"];
                                $subcategories_arr[] = $row1["ID"];
                                $count++;
                                ?>

                                <th scope="col">
                                    <div align="center"><?=$name?></div>
                                    <div class="caption"><?=$name?></div>
                                </th>


                                <?php
                            }
                        }

                        ?>

                        <style>
                            #categoryid<?=$category_id?>
                            {
                                width: calc(5rem*<?=$count?>);
                            }
                        </style>

                    </tr>
                    </thead>

                    <tbody>
                    <?php

                    $sql1 = "SELECT ID FROM mydb.students WHERE rank=$rank_id ORDER BY surname ASC";
                    $result1 = $conn->query($sql1);

                    if ($result1->num_rows > 0)
                    {
                        // output data of each row
                        while($row1 = $result1->fetch_assoc())
                        {
                            $student_ID = $row1["ID"];

                            ?>

                            <tr>
                                <?php

                                foreach ($subcategories_arr as $subcategories_id)
                                {
                                    $sql2 = "SELECT * FROM mydb.completed_rewards WHERE student_ID = $student_ID AND subcategory = $subcategories_id AND category = $category_id AND reward = $reward_id";
                                    $result2 = $conn->query($sql2);

                                    if ($result2->num_rows > 0) {
                                        ?>

                                        <td style="background-color: limegreen">
                                            <button class="update_btn" id="btn" data-checked="1" disabled onclick="update(this, <?= $student_ID ?>, <?= $subcategories_id ?>, <?= $category_id ?>, <?=$reward_id?>)"></button>
                                        </td>

                                        <?php

                                    } else {
                                        ?>

                                        <td style="background-color: white;">
                                            <button class="update_btn fa fa-times" id="btn" data-checked="0" disabled onclick="update(this, <?= $student_ID ?>, <?= $subcategories_id ?>, <?= $category_id ?>, <?=$reward_id?>)"></button>
                                        </td>

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

                <?php
            }
        }

        ?>

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

    function update(element, student_id, subcategory, category, reward){

        var checked = $(element).data("checked");

        jQuery.ajax({
            type: "POST",
            url: "ajax/update_completed_rewards.php",
            data: {student_id: student_id, subcategory: subcategory, category: category, reward: reward, checked: checked},
            cache: false
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

</script>

</body>
</html>