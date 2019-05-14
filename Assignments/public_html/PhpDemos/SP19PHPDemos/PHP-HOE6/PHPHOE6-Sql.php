<?php
/*
    Class:         CIS665
    Assignment:    PHP-HOE6
    Name:          Robert Palumbo
    Due Date:      3.12.2019 @ 11:59pm

    PHP - Hands-on-Exercise 6
 
    SQL code used by this assignment.
 
    Filename: PHPHOE6-Sql.php
 */

require_once ("PHPHOE6-dbConnExec.php");

function addActor($nameFirst, $nameLast, $age, $gender, $actorAgent)
{
    $nameFirst = str_replace('\'', '\'\'', trim($nameFirst));
    $nameLast = str_replace('\'', '\'\'', trim($nameLast));
    $agentName = str_replace('\'', '\'\'',trim($agentName));
    
    $query = <<<STR
Insert Into actor(NameFirst,NameLast,Age,Gender,ActorAgent)
Values('$nameFirst','$nameLast',$age,'$gender','$actorAgent')
STR;

//    echo "Query to Execute: '$query'";
    
    executeQuery($query);
}

function getActorList()
{
    $query = <<<STR
Select ActorPK, NameFirst, NameLast, Age, Gender, ActorAgent
From Actor
Where ActorAgent = 'Robert Palumbo'
Order by NameLast
STR;
    
    return executeQuery($query);
}

function getActorDetailsByID($ActorPK)
{
   $query = <<<STR
Select ActorPK, NameFirst, NameLast, Age, Gender, ActorAgent
From Actor 
Where ActorPK = $ActorPK
STR;
    
    return executeQuery($query);
}

function updateActor($actorPK, $nameFirst, $nameLast, $age, $gender, $actorAgent)
{
    $nameFirst = str_replace('\'', '\'\'', trim($nameFirst));
    $nameLast = str_replace('\'', '\'\'', trim($nameLast));
    $actorAgent = str_replace('\'', '\'\'',trim($actorAgent));
    
    $query = <<<STR
Update Actor
Set NameFirst = '$nameFirst', NameLast = '$nameLast', Age = $age, 
Gender = '$gender', ActorAgent = '$actorAgent'
Where ActorPK = $actorPK
STR;

    executeQuery($query);
}

function deleteActor($actorPK)
{
    $query = <<<STR
Delete
From Actor
Where ActorPK = $actorPK
STR;

    executeQuery($query);
}

?>
