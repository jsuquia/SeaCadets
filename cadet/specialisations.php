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

    <link rel="stylesheet" href="css/rewards.css">
</head>
<body>

<div class="container-fluid">

    <div class="header">
        <h1>Specialisations</h1>
    </div>
    <br>


    <?php

    $sql = "SELECT ID, name FROM mydb.categories WHERE rewards_id=1 ORDER BY ID ASC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0)
    {
        // output data of each row
        while($row = $result->fetch_assoc())
        {
            $category_id = $row["ID"];
            $name = $row["name"];

            ?>
            <div class="categories">
                <div class="row">
                    <div class="col-12">
                        <h4><?=$name?></h4>
                    </div>
                </div>
                <div class="row justify-content-center">


                    <?php

                    $sql1 = "SELECT ID, name FROM mydb.subcategories WHERE category_id=$category_id ORDER BY ID ASC";
                    $result1 = $conn->query($sql1);

                    if ($result1->num_rows > 0)
                    {
                        // output data of each row
                        while($row1 = $result1->fetch_assoc())
                        {
                            $name = $row1["name"];
                            $subcategories_id = $row1["ID"];

                            $sql2 = "SELECT * FROM mydb.completed_rewards WHERE student_ID = $student_id AND subcategory = $subcategories_id AND category = $category_id AND reward = 1";
                            $result2 = $conn->query($sql2);

                            if ($result2->num_rows > 0) {
                                ?>

                                <div class="col-6">
                                    <div class="mx-auto subcategories" style="background-color: limegreen;"></div>
                                    <p align="center" style="margin-bottom: .5rem;"><?=$name?></p>
                                </div>

                                <?php

                            } else {
                                ?>

                                <div class="col-6">
                                    <div class="mx-auto subcategories" style="background-color: lightgray; border: 1px solid grey;"></div>
                                    <p align="center" style="margin-bottom: .8rem;"><?=$name?></p>
                                </div>

                                <?php
                            }
                        }
                    }

                    ?>
                </div>
            </div>

            <?php
        }
    }

    ?>


</div>



<!-- jQuery first, then Tether, then Bootstrap JS. -->
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

<script>

</script>

</body>
</html>

