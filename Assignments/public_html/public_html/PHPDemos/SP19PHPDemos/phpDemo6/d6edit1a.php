<?php
/* 
    Purpose: Demo6 - CRUD Operations
    Author: LV
    Date: February 2019
    Action for: d6edit1.php
    Uses: d6Sql.php
 */

require_once ("d6sql.php");

// if $_POST has a filmpk element, call the update method

if (isset($_POST['filmpk']))
{
    updateMovie((int)$_POST['filmpk'], $_POST['movietitle'], $_POST['pitchtext'], $_POST['amountbudgeted'],
            (int)$_POST['ratingpk'], $_POST['summary'], $_POST['dateintheaters'], $_POST['imagename']);
}
else //call the add method
{
    addMovie($_POST['movietitle'], $_POST['pitchtext'], $_POST['amountbudgeted'], 
            (int)$_POST['ratingpk'], $_POST['summary'], $_POST['dateintheaters'], $_POST['imagename']);
}

header("Location: d6all.php");
exit;

?>
