<?php
/*
    Class:         CIS665
    Assignment:    PHP-HOE5
    Name:          Robert Palumbo
    Due Date:      3.7.2019 @ 11:59pm

    PHP - Hands-on-Exercise 4

    Code that actually adds a new actor to the datbase.  Actor data is
    retrieved from the URL parameters which have been mapped to the $_POST
    super global array.
  
    Filename: PHPHOE5WP-Add.php 
 */
require_once ("PHPHOE6-SiteCommon.php");
require_once ("PHPHOE6-Sql.php");

// Call the addMovie method

addActor($_POST['firstName'], $_POST['lastName'], (int) $_POST['age'],
    $_POST['gender'], $_POST['agentName']);

displayPageHeader("New actor '{$_POST['firstName']}, {$_POST['lastName']}' added");

?>

<p style="text-align: center">
    <a href="PHPHOE6-AddActorForm.php">[Add another actor]</a>
</p>

<?php
displayPageFooter('PHPHOE6');
?>
