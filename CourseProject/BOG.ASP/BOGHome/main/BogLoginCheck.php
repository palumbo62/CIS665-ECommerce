<?php
/*
    Class:          CIS665
    Assignment:     Course Project 
    Team-115:       Robert Palumbo, Kiana Vigil, Valerie Duran
    Due Date:       5.24.2019 @ 11:59pm

    Filename:       BogLoginCheck.php
    
        Checks to see if the user has been authenticated and if
        not, the user is redirected to the login page.
 */
session_start();

if (!isset($_SESSION['userInfo']))
{
    $redirect = $_SERVER['PHP_SELF'];
    
    if (isset($_GET['propIdPK']) && is_numeric($_GET['propIdPK']))
    {
        $propIdPK = (int) $_GET['propIdPK'];
        $redirect .= '?propIdPK=' . $propIdPK;
    }
    header('location: BogLogin.php?redirect=' . $redirect);
    die();
}
?>
