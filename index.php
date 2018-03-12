<?php
<<<<<<< HEAD


if(isset($_COOKIE["user_session"]))
{
    //print_r($_COOKIE["user_session"]);
    $redirect_uri = '/scweb/staff_main.php';
    header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
}

=======
/**
 * Created by IntelliJ IDEA.
 * User: Javier
 * Date: 15/09/2017
 * Time: 11:52
 */
<<<<<<< HEAD
require('php_scripts/check_cookie.php');
=======
//require('php_scripts/check_cookie.php');
>>>>>>> 8ab19431483c9f3d76e7a81d0de980bf7c45cfa0
>>>>>>> d2ebe368574867c7963117cbe2a4a879a79fbcff

?>

<!DOCTYPE html>
<html>

<HEAD>
    <link rel="icon" href="img/logo.png">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Mono:100" rel="stylesheet">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/index.css" type="text/css">
    <TITLE>Login</TITLE>
</HEAD>

<body>

<div class="center">
    <div class="top">
        <!--<img id="image" src="img/original_logo.png" alt="Logos"/>-->
    </div>

    <div class="middle">
        <p id="text">Build Tracker</p>
    </div>

    <div class="bottom">
        <button class="loginBtn loginBtn--google" id="googleBtn">
            Login with Google
        </button>
    </div>
</div>



<script>

    var btn = document.getElementById('googleBtn');
    btn.addEventListener('click', function() {
        document.location.href = '<?=$redirect_uri?>';
    });

</script>

</body>

</html>
