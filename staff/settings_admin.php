<?php
/**
 * Created by IntelliJ IDEA.
 * User: Javier
 * Date: 08/04/2018
 * Time: 16:34
 */

require('../php_scripts/check_privilege.php');

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

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/settings.css">
</head>
<body>

<div class="container-fluid">

    <div class="main-header">
        <div class="back">
            <a href="/scweb/staff/ranks.php"><i class="fa fa-arrow-left"></i></i>&nbsp;back</a>
        </div>

        <div class="row">
            <div class="col-10">
                <h1 class="display-2 d-inline"><a href="/scweb/staff/ranks.php">Ranks/</a>Settings</h1>
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
    <div class="container">
        <div class="header">
            <h2>UPDATE YOUR DETAILS</h2>
        </div>
        <br>

        <form action="models/settings_model.php" method ="post">
            <input type="hidden" name="id" value="<?=$user->id?>"/>
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="sub-header">
                        <h4>YOUR <b>USERNAME</b></h4>
                        <input type="text" name="username" class="form-control" id="username" value="<?=$user->username?>">
                    </div>
                    <br>
                    <div class="sub-header">
                        <h4>YOUR <b>NAME</b></h4>
                        <input type="text" name="name" class="form-control" id="name" value="<?=$user->name?>">
                        <br>
                    </div>
                </div>

                <div class="col-12 col-lg-6">
                    <div class="sub-header">
                        <h4>NEW <b>PASSWORD</b></h4>
                        <input type="password" name="password" class="form-control" id="password" placeholder="**********">
                    </div>
                    <br>
                    <div class="sub-header">
                        <h4>YOUR <b>SURNAME</b></h4>
                        <input type="text" name="surname" class="form-control" id="surname" value="<?=$user->surname?>">
                        <br>
                    </div>
                </div>

                <div class="col-12 col-lg-6">
                    <div class="sub-header">
                        <h4>YOUR <b>EMAIL</b></h4>
                        <input type="email" name="email" class="form-control" id="email" value="<?=$user->email?>">
                    </div>
                    <br>
                    <div class="sub-header">
                    </div>
                </div>

                <div class="col-12 col-lg-6">
                    <div class="sub-header">
                    </div>
                    <br>
                    <div class="sub-header text-right">
                        <button type="submit" name="update" class="btn btn-primary"><h5><b>UPDATE</b></h5></button>
                    </div>
                </div>

            </div>
        </form>

        <br>

        <div class="header">
            <h2>ADD STAFF MEMBER</h2>
        </div>
        <br>
        <h4>Add and remove staff from the system</h4>
        <br><br>
        <form action="models/settings_model.php" method ="post">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="sub-header">
                        <h4>THEIR <b>USERNAME</b></h4>
                        <input type="text" name="username" class="form-control" id="username" placeholder="new_user" required>
                    </div>
                    <br>
                    <div class="sub-header">
                        <h4>THEIR <b>NAME</b></h4>
                        <input type="text" name="name" class="form-control" id="name" placeholder="name" required>
                        <br>
                    </div>
                </div>

                <div class="col-12 col-lg-6">
                    <div class="sub-header">
                        <h4>THEIR <b>PASSWORD</b></h4>
                        <input type="password" name="password" class="form-control" id="password" placeholder="**********" required>
                    </div>
                    <br>
                    <div class="sub-header">
                        <h4>THEIR <b>SURNAME</b></h4>
                        <input type="text" name="surname" class="form-control" id="surname" placeholder="surname" required>
                        <br>
                    </div>
                </div>

                <div class="col-12 col-lg-6">
                    <div class="sub-header">
                        <h4>THEIR <b>EMAIL</b></h4>
                        <input type="email" name="email" class="form-control" id="email" placeholder="example@hotmail.com" required>
                    </div>
                    <br>
                    <div class="sub-header">
                    </div>
                </div>

                <div class="col-12 col-lg-6">
                    <div class="sub-header">
                    </div>
                    <br>
                    <div class="sub-header text-right">
                        <button type="submit" name="add" class="btn btn-primary"><h5><b>ADD</b></h5></button>
                    </div>
                </div>

            </div>
        </form>

        <br>
        <div class="header">
            <h2>EDIT ALL STAFF</h2>
        </div>
        <br>
        <h4>Remove staff or update their details</h4>
        <br><br>
        <table class="table">
            <thead>
            <tr>
                <th>USERNAME</th>
                <th>NAME</th>
                <th>SURNAME</th>
                <th></th>
            </tr>
            </thead>
            <tbody>

            <?php

            $sql = "SELECT users.*, staff.name, staff.surname, staff.email FROM mydb.users LEFT JOIN mydb.staff ON users.ID = staff.user_id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {

                    ?>

                    <tr>
                        <td id="username" data-id="<?=$row["ID"]?>"><?=$row["username"]?></td>
                        <td id="name"><?=$row["name"]?></td>
                        <td id="surname"><?=$row["surname"]?></td>
                        <td style="width: 15%;">
                            <button class="fa fa-pencil-square-o fa-2x" onclick="edit(this)"></button>
                            <form action="models/settings_model.php" method ="post" style="display: inline;">
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
        var id = $(element ).closest("tr").find('#username').data("id");
        var username = $(element ).closest("tr").find('#username');
        var name = $(element ).closest("tr").find('#name');
        var surname = $(element ).closest("tr").find('#surname');

        isEditable=username.is('.editable');
        username.prop('contenteditable',!isEditable).toggleClass('editable');

        isEditable=name.is('.editable');
        name.prop('contenteditable',!isEditable).toggleClass('editable');

        isEditable=surname.is('.editable');
        surname.prop('contenteditable',!isEditable).toggleClass('editable');

        if(!isEditable)
        {
            $(element).toggleClass('fa fa-pencil-square-o fa-2x fa fa-check fa-2x');
            username.css( "background-color", "#F2F2F2");
            name.css( "background-color", "#F2F2F2");
            surname.css( "background-color", "#F2F2F2");
        } else
        {
            $(element).toggleClass('fa fa-check fa-2x fa fa-pencil-square-o fa-2x');
            username.css( "background-color", "white");
            name.css( "background-color", "white");
            surname.css( "background-color", "white");

            jQuery.ajax({
                type: "POST",
                url: "ajax/update_settings.php",
                data: {id: id, username: username.text(), name: name.text(), surname: surname.text()},
                cache: false
            });
        }

    }
</script>

</body>
</html>
