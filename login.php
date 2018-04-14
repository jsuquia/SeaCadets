<?php
/**
 * Created by IntelliJ IDEA.
 * User: Javier
 * Date: 15/09/2017
 * Time: 11:52
 */

session_start();

if(isset($_COOKIE["user_session"]))
{
    //$redirect_uri = 'https://' . $_SERVER['HTTP_HOST'] . '/2017-projects/seacadet/ranks.php';
    $redirect_uri = '/scweb/staff/ranks.php';
    header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
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

    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
</head>
<body>

<div class="container-fluid">

    <!-- Modal -->
    <div class="modal fade" id="recoverPassword" tabindex="-1" role="dialog" aria-labelledby="recoverPasword" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Recover Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="models/login_model.php" method ="post">
                    <div class="modal-body">
                        <input type="hidden" name="rank" value=""/>

                        <div class="row email">
                            <h6 class="col-12 text">Enter your email to recover the password</h6>
                            <br><br>
                            <input type="email" name="email" class="col-12 form-control" id="email" placeholder="email@example.com" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="password-recovery" class="btn btn-primary">Send Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row align-items-center">
        <div class="col-6 hidden-sm-down" id="left">
            <img src="img/logo.png" class="img-fluid mx-auto d-block" alt="Responsive image">
        </div>

        <div class="col-12 col-md-6" id="right">

            <div class="row justify-content-center">
                <div class="col-6 content">
                    <h1 class="display-5 d-inline bold">SIGN IN</h1>
                    <br><br><br><br>
                    <form action="models/login_model.php" method ="post">
                        <div class="form-group">
                            <h5>USERNAME</h5>
                            <input type="text" name="username" class="form-control" id="username" aria-describedby="usernameHelp" placeholder="donald_trump" required>
                        </div>
                        <br>
                        <div class="form-group">
                            <h5>PASSWORD</h5>
                            <input type="password" name="password" class="form-control" id="password" placeholder="*************" required>
                        </div>

                        <br>
                        <button type="submit" name="submit" class="btn btn-primary"><b>SIGN IN</b></button>
                    </form>
                    <br>
                    <button type="button" class="btn btn-primary" id="recover-password" data-toggle="modal" data-target="#recoverPassword">Forgot your password?</button>

                </div>
            </div>


        </div>
    </div>

</div>



<!-- jQuery first, then Tether, then Bootstrap JS. -->
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<script>

    function display_msg(msg, check)
    {

        toastr.options = {
            positionClass: "toast-top-full-width",
            preventDuplicates: true
        };

        if(check == 0)
        {
            toastr.success(msg);
        } else if(check == 1)
        {
            toastr.error(msg);
        }

    }


</script>

</body>
</html>

<?php

if(isset($_SESSION['msg']))
{
    if($_SESSION['msg'] == "Email successfully sent" || $_SESSION['msg'] == "Password successfully changed")
    {
        echo '<script type="text/javascript">',
            'display_msg("'.$_SESSION['msg'].'", 0);',
        '</script>'
        ;
    } else
    {
        echo '<script type="text/javascript">',
            'display_msg("'.$_SESSION['msg'].'", 1);',
        '</script>'
        ;
    }

}

unset($_SESSION['msg']);

?>



