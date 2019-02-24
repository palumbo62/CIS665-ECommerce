<?php
/* 
    Class:         CIS665
    Assignment:    PHP-HOE3
    Name:          Robert Palumbo
    Due Date:      2.28.2019 @ 11:59pm

    PHP - Hands-on-Exercise 3

    Retrieve and display all the actors (NameFirst, NameLast, Age and Gender) 
    in the RWStudios database. 
 
    Filename: phphoe3sql.php
 */
    
require_once '../dbConnExec.php';

function getActorsList()
{
    // the SQL query to be executed on the database

    $query = "Select NameFirst, NameLast, Age, Gender
            From Actor
            Order by NameLast";
   
   // call the executeQuery method (in dbConnExec.php)
   // and return the result
   return executeQuery($query);
}

?>