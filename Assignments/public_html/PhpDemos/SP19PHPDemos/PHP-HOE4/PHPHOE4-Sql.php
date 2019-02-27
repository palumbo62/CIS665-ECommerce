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
  
    Filename: PHPHOE4-Sql.php
 */

require_once ("PHPHOE4-dbConnExec.php");


function getActorByMultiCriteria($lastname, $age, $gender)
{
    $query = <<<STR
Select NameLast, Age, Gender
From Actor
Where 0=0
STR;
    if ($lastname != '')
    {
    $query .= <<<STR
 And NameLast like '%$lastname%'
STR;
    }
    if ($age != '')
    {
    $query .= <<<STR
 And Age <= $age
STR;
    }
    if ($gender != '')
    {
    $query .= <<<STR
 And Gender = '$gender'
STR;
    }
$query .= <<<STR
 Order by NameLast
STR;

return executeQuery($query);
}

?>