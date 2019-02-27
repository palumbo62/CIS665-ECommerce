<?php
/*
    Class:          CIS665
    Assignment:     Course Project 
    Team-115:       Robert Palumbo, Kiana Vigil, Valerie Duran
    Due Date:       5.7.2019 @ 11:59pm

    Filename:       bobSql.php
    
        SQL queries used by the BOG Web Site implementation.  All database
        access should be implemented via methods in this source file.
 
        Database:  buscissql1601\cisweb\Team115DB
 */

require_once ("..\phpCommon\bogDbConnExec.php");


function bogLogin($email, $password)
{
    // the SQL query to be executed on the database

    $query = <<<STR
exec spBogLogin '$email', '$password';
STR;
   
   // execute the query and return the result
   return executeQuery($query);
}

function bogAddUserProf($email, $password, $firstName, $lastName,
            $address, $city, $state, $zipcode, $phoneNum,
            $ccNum, $ccExpDate, $ccCvc)
{
    // the SQL query to be executed on the database

    $query = <<<STR
exec spBogAddUserProf '$email', '$password', '$firstName', '$lastName',
'$address', '$city', '$state', '$zipcode', '$phoneNum',
            '$ccNum', '$ccExpDate', '$ccCvc';
STR;
   
   // execute the query and return the result
   return executeQuery($query);
}

function bogGetUserProfById($userId)
{
    // the SQL query to be executed on the database

    $query = <<<STR
exec spBogGetUserProfById '$userId';
STR;
   
   // execute the query and return the result
   return executeQuery($query);
}

?>