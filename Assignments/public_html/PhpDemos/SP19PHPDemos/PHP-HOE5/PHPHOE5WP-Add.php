<?php
/*
    Class:         CIS665
    Assignment:    PHP-HOE5
    Name:          Robert Palumbo
    Due Date:      3.7.2019 @ 11:59pm

    PHP - Hands-on-Exercise 4

    Create PHP pages/functions to allow users to add a new actor record. The 
    form should have appropriate controls to enter an actor’s first name 
    (NameFirst), last name (NameLast), age, gender and agent (ActorAgent). 
    Include appropriate client-side validations for each control.  
    Note: Gender is stored as “M” or “F” in the database. 
  
    Filename: PHPHOE5WP-Add.php 
 */
require_once ("PHPHOE5-SiteCommon.php");
require_once ("PHPHOE5-Sql.php");

// Call the addMovie method

addActor($_POST['firstName'], $_POST['lastName'], (int) $_POST['age'],
    $_POST['gender'], $_POST['agentName']);

displayPageHeader("New actor '{$_POST['firstName']}, {$_POST['lastName']}' added");

?>

<p style="text-align: center">
    <a href="PHPHOE5WP.php">[Add another movie]</a>
</p>

<?php
displayPageFooter('PHPHOE5');
?>
