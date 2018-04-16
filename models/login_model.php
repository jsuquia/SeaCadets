<?php
/**
 * Created by IntelliJ IDEA.
 * User: Javier
 * Date: 18/09/2017
 * Time: 10:33
 */

require('../php_scripts/db.php');

session_start();

if(isset($_POST["submit"]))
{

    $username = $_POST["username"];
    $password = $_POST["password"];

    //$password_hash = password_hash( "admin", PASSWORD_DEFAULT, [ 'cost' => 11 ] );

    $sql = "SELECT * FROM mydb.users";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {

            if (password_verify($password, $row["password"]))
            {
                if($row["username"] == $username)
                {
                    $randomstring = generateRandomString(120);

                    $stmt = $conn->prepare("INSERT INTO mydb.session (ID, user_id) VALUES (?,?)");
                    $stmt->bind_param("ss", $randomstring, $userid);

                    $userid = $row["ID"];

                    $stmt->execute();

                    setcookie("user_session",$randomstring,time() + (10 * 365 * 24 * 60 * 60), "/");

                    if($row["privilege"] == 1 || $row["privilege"] == 2)
                    {
                        //$redirect_uri = 'https://' . $_SERVER['HTTP_HOST'] . '/2017-projects/seacadet/index.php';
                        $redirect_uri = '/scweb/staff/ranks.php';
                        header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
                        exit();
                    } else
                    {
                        //$redirect_uri = 'https://' . $_SERVER['HTTP_HOST'] . '/2017-projects/seacadet/index.php';
                        $redirect_uri = '/scweb/cadet/home.php';
                        header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
                        exit();
                    }


                }
                else
                {
                    $_SESSION['msg'] = "Username not found!";

                    $redirect_uri = $_SERVER['HTTP_REFERER'];
                    header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
                    exit();
                }
            } else
            {
                $_SESSION['msg'] = "Incorrect Password!";
            }

        }

        $redirect_uri = $_SERVER['HTTP_REFERER'];
        header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
        exit();

    } else {
        //0 results
    }

    $conn->close();
}

if(isset($_POST["password-recovery"]))
{

    $email = $_POST["email"];
    $hash = password_hash( date('c'), PASSWORD_DEFAULT, [ 'cost' => 11 ] );

    $sql = "SELECT * FROM mydb.staff WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0)
    {
        // output data of each row
        while ($row = $result->fetch_assoc())
        {

            $userid = $row['user_id'];

            $stmt = $conn->prepare("INSERT INTO mydb.password_hash (hash, user_id) VALUES (?,?)");
            $stmt->bind_param("ss", $hash, $userid);

            $stmt->execute();

            //$redirect_uri = 'https://' . $_SERVER['HTTP_HOST'] . '/2017-projects/seacadet/index.php';
            $redirect_uri = "/scweb/models/mail_model.php?email=".$email."&hash=".$hash;
            header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
            exit();

        }
    } else
    {
        //echo "Email not found";


        $_SESSION['msg'] = "Email not found";

        $redirect_uri = "/scweb/login.php";
        header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
        exit();
    }



}


function generateRandomString($length) {
    return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
}