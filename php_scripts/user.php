<?php
/**
 * Created by IntelliJ IDEA.
 * User: Javier
 * Date: 18/09/2017
 * Time: 14:57
 */

require('db.php');

class User
{

    var $isloaded = false;

    var $id = -100;
    var $username = "ERROR";
    var $name = "ERROR";
    var $surname = "ERROR";
    var $rank = "ERROR";
    var $email = "NULL";
    var $privilege = "ERROR";


    function loadbysession($sessionid)
    {
        global $conn;

        $sql = "SELECT ID, user_id FROM mydb.session WHERE ID='$sessionid'";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc())
            {
                $this->loadbyuserid($row["user_id"]);
            }
        } else
        {
            return;
        }
    }

    function loadbyuserid($userid)
    {
        global $conn;

        $sql = "SELECT ID, username, privilege FROM mydb.users WHERE ID=$userid";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc())
            {
                $this->isloaded = true;
                $this->id = $userid;
                $this->username = $row["username"];
                $this->privilege = $row["privilege"];
            }
        } else
        {
            return;
        }

        if($this->privilege == 1 || $this->privilege == 2)
        {
            $sql = "SELECT name, surname, email FROM mydb.staff WHERE user_id=$userid";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc())
                {
                    $this->name = $row["name"];
                    $this->surname = $row["surname"];
                    $this->email = $row["email"];
                }
            } else
            {
                return;
            }
        } else
        {
            $sql = "SELECT name, surname, rank FROM mydb.students WHERE user_id=$userid";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc())
                {
                    $this->name = $row["name"];
                    $this->surname = $row["surname"];
                    $this->rank = $row["rank"];
                }
            } else
            {
                return;
            }
        }
    }

}