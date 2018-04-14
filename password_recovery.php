<?php
/**
 * Created by IntelliJ IDEA.
 * User: Javier
 * Date: 15/09/2017
 * Time: 11:52
 */

require('php_scripts/db.php');

if(isset($_GET["email"]) && isset($_GET["hash"]))
{
    $email = $_GET["email"];
    $hash = $_GET["hash"];
} else
{
    $_SESSION['msg'] = "The url was invalid";

    $redirect_uri = "/scweb/login.php";
    header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
    exit();
}

$sql = "SELECT user_id FROM mydb.password_hash WHERE hash='$hash'";
$result = $conn->query($sql);

if ($result->num_rows > 0)
{
    while ($row = $result->fetch_assoc())
    {
        $user_id = $row['user_id'];
    }
} else
{
    $_SESSION['msg'] = "Invalid details";

    $redirect_uri = "/scweb/login.php";
    header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
    exit();
}

$sql = "SELECT * FROM mydb.staff WHERE email='$email' AND user_id=$user_id";
$result = $conn->query($sql);

if ($result->num_rows > 0)
{
    while ($row = $result->fetch_assoc())
    {
        $name = $row['name'];
        $surname = $row['surname'];
    }
} else
{
    $_SESSION['msg'] = "Invalid details";

    $redirect_uri = "/scweb/login.php";
    header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
    exit();
}

$sql = "DELETE FROM mydb.password_hash WHERE hash = '$hash'";

if ($conn->query($sql) !== TRUE)
{
    echo "Error deleting record: " . $conn->error;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/password_recovery.css">
</head>
<body>

<div class="container">

    <h1 style="color: white; text-align: center; margin-top: -4rem; margin-bottom: 4rem;">Hi <?=$name?> <?=$surname?></h1>

    <div class="row justify-content-center align-self-center">
        <div class="col-sm-6">

            <div class="jumbotron vertical-center">

                <h1 style="text-align: center;">Password Recovery</h1>
                <br><br>
                <div class="row">
                    <form action="models/password_recovery_model.php" method ="post">
                        <input type="hidden" name="user_id" value="<?=$user_id?>"/>

                        <div class="col-12">
                            <h5>Enter new password</h5>
                        </div>

                        <div class="col-12">
                            <input type="password" name="password" class="password" placeholder="**********"/>
                        </div>

                        <div class="col-12" align="center">
                            <button type="submit" name="reset" class="reset-btn">RESET</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

</div>



<!-- jQuery first, then Tether, then Bootstrap JS. -->
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

</body>
</html>


