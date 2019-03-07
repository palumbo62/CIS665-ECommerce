<?php
/*
    Class:         CIS665
    Assignment:    PHP-HOE6
    Name:          Robert Palumbo
    Due Date:      3.12.2019 @ 11:59pm

    PHP - Hands-on-Exercise 6

    Create PHP pages/functions to display only those actors represented 
    by you (i.e., the actors who have you as their agent). Display links 
    for Edit and Delete next to each actor’s name (see d6all.php in Demo 6). 
    Clicking on the Edit link, should enable a user to edit and update the 
    actor’s data (i.e., first name, last name, age and gender). 
    Include appropriate validations. Clicking on the Delete link should 
    delete that actor’s record from the Actor table.  
    
    Filename: PHPHOE6-AddActorForm.php 
 */
require_once ("PHPHOE6-SiteCommon.php");
require_once ("PHPHOE6-Sql.php");

// call the displayPageHeader method in siteCommon.php

displayPageHeader("Add/Edit/Delete an Actor");

$actorList = getActorList();  //gets the list of movies

$output = <<<HTML
<section><table id="allActors">
HTML;

// display each movie with links to edit or delete it

foreach ($actorList as $actor)
{
    extract($actor);
    $output .= <<<HTML
    <tr>
        <td>
            $NameFirst $NameLast
        </td>
        <td>
            <a href="PHPHOE6-Edit1.php?ActorPK=$ActorPK">[Edit]</a>
        </td>
        <td>
            <a href="PHPHOE6-Delete1.php?ActorPK=$ActorPK">[Delete]</a>
        </td>
    </tr>
HTML;
}

$output .= <<<HTML
    <tr>
        <td colspan="3" align="center">
            <a href="PHPHOE6-Edit1.php">[Add an Actor]</a>
        </td>
    </tr>
</table></section>
HTML;

echo $output;

// call the displayPageFooter method in siteCommon.php

displayPageFooter('PHPHOE6');

?>
