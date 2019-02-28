<?php
/*
    Class:         CIS665
    Assignment:    PHP-HOE4
    Name:          Robert Palumbo
    Due Date:      3.5.2019 @ 11:59pm

    PHP - Hands-on-Exercise 4

    Develop PHP pages/functions to enable a user to search for actors by last name (the user could enter
    a full or partial last name), maximum age (use the Age column for the search; not AgeReal) and
    gender (use radio buttons for gender). The user can choose to provide or not provide values for each
    search criterion. Retrieve and display all the actors (NameFirst, NameLast, Age and Gender) that
    match the specified criteria
   
    Filename: PHPHOE4-ResultsWP.php
 */

require_once ("PHPHOE4-SiteCommon.php");
require_once ("PHPHOE4-Sql.php");

// $_POST is an associative array of the values passed via the HTTP POST method

$lastname = $_POST['lastname'];
$age = $_POST['age'];
$gender = $_POST['gender'];

// remove any potentially malicious characters

$lastname = preg_replace("/[^a-zA-Z0-9\s]/", '', $lastname);
$age = preg_replace("/[^0-9]/", '', $age);
$gender = preg_replace("/[^MF]/", '', $gender);

// get the rating associated with the ratingpk
// call the displayPageHeader method in siteCommon.php

$heading = <<<ABC
You searched for<br />
Actor Last Name: '$lastname' <br />
Actor Age (max): '$age' <br />
Actor Gender: '$gender'
ABC;

displayPageHeader($heading);

//Call the getActorByMultiCriteriaBy method

$actorList = getActorByMultiCriteria($lastname,$age,$gender);

// get a count of the number of movies returned by the method

$matchingRecords = count($actorList);

echo "<section>";

if ($matchingRecords == 0)
{
   echo "<h3>No matches found for the search term(s)</h3>";
}
else
{   
// prepare the output using heredoc syntax

$output = <<<ABC
<table id="actors" align="center">
   <caption>$matchingRecords actor(s) found</caption>
   <tbody>

   <tr>
        <th>#&nbsp&nbsp&nbsp</th>
        <th>Last Name</th>
        <th>Age&nbsp&nbsp</th>
        <th>Gender</th>
ABC;


    foreach ($actorList as $actor)
    {
        extract($actor);
        $actorCnt ++;
       
        $output .= <<<ABC
        <tr>
            <td>
                $actorCnt&nbsp&nbsp&nbsp
            </td>
            <td>
                $NameLast&nbsp&nbsp
            </td>
            <td>
                $Age&nbsp&nbsp
            </td>
            <td>
                $Gender
            </td>
        </tr>
ABC;
    }
    
    $output .= "<tbody></table>";
}
$output .= <<<ABC
<p style="text-align: center">
    <a href="PHPHOE4-SearchWP.php">[Back to Search Page]</a>
</p></section>
ABC;

// display the output

echo $output;

// call the displayPageFooter method in siteCommon.php

displayPageFooter('PHP-HOE4');
?>
