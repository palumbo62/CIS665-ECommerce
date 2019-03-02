<?php
/*
    Class:         CIS665
    Assignment:    PHP-HOE5
    Name:          Robert Palumbo
    Due Date:      3.7.2019 @ 11:59pm

    PHP - Hands-on-Exercise 5
 
    SQL code used by this assignment.
 
    Filename: PHPHOE5-Sql.php
 */

require_once ("PHPHOE5-dbConnExec.php");

function addActor($firstName, $lastName, $age, $gender, $agentName)
{
    // escape single quotes within the string (e.g., "Schindler's List" is escaped as "Schindler''s List" 
    
    $firstName = str_replace('\'', '\'\'', trim($firstName));
    $lastName = str_replace('\'', '\'\'', trim($lastName));
    $agentName = str_replace('\'', '\'\'',trim($agentName));
    
    $query = <<<STR
Insert Into actor(NameFirst,NameLast,Age,Gender,ActorAgent)
Values('$firstName','$lastName',$age,'$gender','$agentName')
STR;

//    echo "Query to Execute: '$query'";
    
    executeQuery($query);
}

?>
