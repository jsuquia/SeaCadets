<?php
/**
 * Created by IntelliJ IDEA.
 * User: Javier
 * Date: 10/04/2018
 * Time: 16:02
 */

require('../php_scripts/check_cookie.php');
require('../php_scripts/check_privilege.php');

if($user->privilege == 1)
{
    require('settings_admin.php');
}
else
{
    require('settings_other.php');
}