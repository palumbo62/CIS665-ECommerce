<?php
/*
    Class:         CIS665
    Assignment:    PHP-HOE6
    Name:          Robert Palumbo
    Due Date:      3.12.2019 @ 11:59pm

    PHP - Hands-on-Exercise 6

    Used to determine if an actor record is being updated or added new
    and calls the appropriate method to carry out the action.

    Filename: PHPHOE6-Edit1a.php 
 */
require_once ("PHPHOE6-Sql.php");

// if $_POST has an ActorPK element, call the update method

if (isset($_POST['ActorPK']))
{
    updateActor((int)$_POST['ActorPK'], $_POST['firstName'], $_POST['lastName'],
            (int)$_POST['age'], $_POST['gender'], $_POST['agentName']);
}
else //call the add method
{
    addActor($_POST['firstName'], $_POST['lastName'],
            (int)$_POST['age'], $_POST['gender'], $_POST['agentName']);
}

header("Location: PHPHOE6-All.php");
exit;

?>
