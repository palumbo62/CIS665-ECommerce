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

$userPK = (isset($_SESSION['userInfo']))? $_SESSION['userInfo']['UserPK'] : "";   

if (!empty($userPK)) {
    $tag = "USER PK='$userPK!";
} else {
    $tag = "UserPK NOT Set";
}

displayPageHeader("..\cssStyles\loginResultsCSS.css", $tag);
displayLoginResults_User();

displayPageFooter('');
?>