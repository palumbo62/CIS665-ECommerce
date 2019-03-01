<?php
/*
    Purpose: Securing Applications
    Author: LV
    Date: February 2019
 */

// this script checks whether the user has been authenticated
// if the session array element, "userInfo" is not set,
// the user is redirected to the login page (d8loginform.php)

session_start();

if (!isset($_SESSION['userInfo']))
{
    /*  
        notice that a URL parameter (redirect) is tagged on to the URL.

        this "redirect" parameter is set to the name of the page that was
        orginally requested by the user (in this demo, it could be either
        d8secure.php or d8admin.php)

        the page that was originally requested is obtained from $_SERVER['PHP_SELF']
        
        the redirect URL parameter is used in "d8loginform.php" to redirect the user
        to the originally requested page (after authentication).

     */
    header('location: d8loginform.php?redirect=' . $_SERVER['PHP_SELF']);
    die();
}
?>
