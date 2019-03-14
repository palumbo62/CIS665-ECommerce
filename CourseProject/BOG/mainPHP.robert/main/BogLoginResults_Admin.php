<?php
/* 
    Class:          CIS665
    Assignment:     Course Project 
    Team-115:       Robert Palumbo, Kiana Vigil, Valerie Duran
    Due Date:       5.24.2019 @ 11:59pm

    Filename:       BogListings.php
    
        Main entry point to the BOG Listings web page
*/ 
    // this method call should be placed at the start (top) of every php file that uses session variables

    session_start();

    require_once ("..\phpCommon\BogSiteCommon.php");
    require_once ("..\sqlCommon\bogSql.php");

    echo '<section>';

    // the session array element "userInfo" will be set (see d10loginform.php) if the user has been authenticated

    $userId = (isset($_SESSION['userInfo']))? $_SESSION['userInfo']['userId'] : "";   
    $roleType = (isset($_SESSION['userInfo']))? $_SESSION['userInfo']['roleType'] : "";   
    
    // Must be ADMIN to manage property
    if (($roleType != 1) || empty($userId)) {
        header('Refresh: 3; URL=BogHome.php');

        echo '<h2>Must be Admin to delete properties.  You will now be redirected to our Home page.</h2>';
        die();
    }

    displayPageHeader("..\cssStyles\loginResultsCSS.css", $tag);
    displayLoginResults_Admin();

    displayPageFooter('');
?>