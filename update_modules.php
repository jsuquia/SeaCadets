<?php
/**
 * Created by IntelliJ IDEA.
 * User: Javier
 * Date: 07/04/2018
 * Time: 13:13
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
    <title>Update Modules</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/modules.css">
</head>
<body>

<div class="alert alert-warning alert-dismissible fade show" role="alert">
    Abbreviation is too long! (max 10 characters)
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="container-fluid">

    <div class="main-header">
        <div class="row">
            <div class="col-10">
                <h1 class="display-2 d-inline">Update Modules
                    <button type="button" class="btn btn-primary" id="adding_module" data-toggle="modal" data-target="#addModule">Add Module</button
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

    <!-- Modal -->
    <div class="modal fade" id="addModule" tabindex="-1" role="dialog" aria-labelledby="addStudent" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Module</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="models/modules_model.php" method ="post">
                    <div class="modal-body">
                        <input type="hidden" name="rank" value="<?=$rankID?>"/>

                        <div class="row">
                            <h6 class="col-12 col-md-4 text">Module Name</h6>
                            <input type="text" name="name" class="col-12 col-md-8 form-control" id="name" placeholder="module_name" required>
                        </div>
                        <br>
                        <div class="row">
                            <h6 class="col-12 col-md-4 text">Abbreviation</h6>
                            <input type="text" name="abbr" class="col-12 col-md-8 form-control d-inline" id="abbr" placeholder="XX00" required>
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

    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th>MODULE</th>
                <th>ABBREVIATION</th>
                <th></th>
            </tr>
            </thead>
            <tbody>

            <?php

            $sql = "SELECT ID, module, abbr FROM mydb.modules WHERE rank=$rankID ORDER BY ID ASC";
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

                    <tr>
                        <td id="module" data-id="<?=$module_ID?>"><?=$module?></td>
                        <td id="abbr"><?=$abbr?></td>
                        <td style="width: 10rem;">
                            <button class="fa fa-pencil-square-o fa-2x" onclick="edit(this)"></button>
                            <form action="models/modules_model.php" method ="post" style="display: inline;">
                                <input type="hidden" name="id" value="<?=$row["ID"]?>"/>
                                <button type="submit" name="delete" class="fa fa-times fa-2x" onclick="return confirm('Are you sure you want to delete this item?');"></button>
                            </form>
                        </td>
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
    function edit(element)
    {
        var id = $(element ).closest("tr").find('#module').data("id");
        var module = $(element ).closest("tr").find('#module');
        var abbr = $(element ).closest("tr").find('#abbr');

        isEditable=module.is('.editable');
        module.prop('contenteditable',!isEditable).toggleClass('editable');

        isEditable=abbr.is('.editable');
        abbr.prop('contenteditable',!isEditable).toggleClass('editable');

        if(!isEditable)
        {
            $(element).toggleClass('fa fa-pencil-square-o fa-2x fa fa-check fa-2x');
            module.css( "background-color", "#F2F2F2");
            abbr.css( "background-color", "#F2F2F2");
        } else
        {
            if(abbr.text().length > 10)
            {
                $('.alert').show();

                $(element).toggleClass('fa fa-check fa-2x fa fa-pencil-square-o fa-2x');
                module.css( "background-color", "white");
                abbr.css( "background-color", "white");

            } else
            {
                $(element).toggleClass('fa fa-check fa-2x fa fa-pencil-square-o fa-2x');
                module.css( "background-color", "white");
                abbr.css( "background-color", "white");

                jQuery.ajax({
                    type: "POST",
                    url: "ajax/update_modules.php",
                    data: {id: id, module: module.text(), abbr: abbr.text()},
                    cache: false
                });
            }

        }

    }
</script>

</body>
</html>
