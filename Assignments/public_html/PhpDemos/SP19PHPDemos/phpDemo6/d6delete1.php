
<?php
/* 
    Purpose: Demo6 - CRUD Operations
    Author: LV
    Date: February 2019
*/

 include_once ("d6sql.php");

if ((isset($_GET['filmpk'])) && (is_numeric($_GET['filmpk'])))
{
    deleteMovie((int)$_GET['filmpk']);
}

header("Location: d6all.php");
exit;

?>
