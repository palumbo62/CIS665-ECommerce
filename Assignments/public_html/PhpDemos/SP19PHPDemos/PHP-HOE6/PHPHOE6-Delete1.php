
<?php
/* 
    Class:         CIS665
    Assignment:    PHP-HOE6
    Name:          Robert Palumbo
    Due Date:      3.12.2019 @ 11:59pm

    PHP - Hands-on-Exercise 6

    Performs the actual deletion of an actor from the database    
 * 
    Filename: PHPHOE6-Delete.php 
*/

 include_once ("PHPHOE6-Sql.php");

if ((isset($_GET['ActorPK'])) && (is_numeric($_GET['ActorPK'])))
{
    deleteActor((int)$_GET['ActorPK']);
}

header("Location: PHPHOE6-All.php");
exit;

?>
