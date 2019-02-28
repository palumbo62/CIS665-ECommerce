<?php
/*
    Class:          CIS665
    Assignment:     Course Project 
    Team-115:       Robert Palumbo, Kiana Vigil, Valerie Duran
    Due Date:       5.7.2019 @ 11:59pm

    Filename:       bogMain.php
    
        Main web page for the Be-Our-Guest web sites.
 
        Database:  buscissql1601\cisweb\Team115DB
*/
    require_once ("..\phpCommon\BogSiteCommon.php");
    require_once ("..\sqlCommon\bogSql.php");

    displayPageHeader('BOG - Be Our Guest');

    echo '<section>';
    
    $filepath = "..\images\MountainCabin1.jpg";
    echo '<img src="' . $filepath . '" alt="Mountain Cabin" height="200" width="300" float="left">';
    echo '<h3>Just a temporary starter page...</h3>';
    echo '</ section><hr />';

    // call the displayPageFooter method in mySiteCommon.php
    displayPageFooter('BOG');
?>
