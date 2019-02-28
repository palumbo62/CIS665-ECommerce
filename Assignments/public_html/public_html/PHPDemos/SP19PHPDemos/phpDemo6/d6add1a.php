<?php
/*
    Purpose: Demo6 - CRUD Operations
    Author: LV
    Date: February 2019
    Uses: siteCommon.php, d6Sql.php
    Action for d6add1.php
 */
require_once ("../siteCommon.php");
require_once ("d6Sql.php");

// Call the addMovie method

addMovie($_POST['movietitle'], $_POST['pitchtext'], (int) $_POST['amountbudgeted'],
    (int) $_POST['ratingpk'], $_POST['summary'], $_POST['dateintheaters'], $_POST['imagename']);

displayPageHeader("New movie {$_POST['movietitle']} added");
?>

<p style="text-align: center">
    <a href="d6add1.php">[Add another movie]</a>
</p>

<?php
displayPageFooter();
?>
