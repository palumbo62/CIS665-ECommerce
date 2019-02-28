<?php
/*
    Class:          CIS665
    Assignment:     Course Project 
    Team-115:       Robert Palumbo, Kiana Vigil, Valerie Duran
    Due Date:       5.7.2019 @ 11:59pm

    Filename:       bobSql.php
    
        SQL queries used by the BOG Web Site implementation.  
        All database access should be implemented via methods 
        in this source file.
 
        Database:  buscissql1601\cisweb\Team115DB
 */

require_once ("..\phpCommon\bogDbConnExec.php");

//*************************************************************
// FUNCTION:    bogLogin
//
// PURPOSE:     Used to log a user into the BOG system.
// On a successful login, the user's profile is returne
// in a result set.
// 
//*************************************************************
function bogLogin($email, $password)
{
    // the SQL query to be executed on the database

    $query = <<<STR
exec spBogLogin '$email', '$password';
STR;
   
   // execute the query and return the result
   return executeQuery($query);
}

//*************************************************************
// FUNCTION:    bogAddUserProf
//
// PURPOSE:     Used to add a new user profile to the BOG
// system.  On success returns the unique key identifier for 
// the user just added 
// 
//*************************************************************
function bogAddUserProf($email, $password, $firstName, $lastName,
            $address, $city, $state, $zipcode, $phoneNumber,
            $ccNum, $ccExpDate, $ccCvc)
{
    // the SQL query to be executed on the database
   
    $query = <<<STR
exec spBogAddUserProf '$email', '$password', '$firstName', '$lastName',
'$address', '$city', '$state', $zipcode, $phoneNumber,
$ccNum, '$ccExpDate', $ccCvc;
STR;
   
    // execute the query and return the result
   
    return executeQuery($query);
}

//*************************************************************
// FUNCTION:    bogGetUserProfById
//
// PURPOSE:     Used to retrieve a user profile from the
// database using the User ID.  Upon success the user
// profile data is returned in a result set.
// 
//*************************************************************
function bogGetUserProfById($userId)
{
    // the SQL query to be executed on the database

    $query = <<<STR
exec spBogGetUserProfById '$userId';
STR;
   
   // execute the query and return the result
   return executeQuery($query);
}

//*************************************************************
// FUNCTION:    bogAddProp
//
// PURPOSE:     Used to add a new property to the BOG system.
//
//*************************************************************
function bogAddPropProf($propertyType, $address, $city, $state, 
            $zipcode, $dailyPrice, $numBedrooms, $numBathrooms,
            $sqft, $guestCnt, $pic)
{
    // the SQL query to be executed on the database

    $query = <<<STR
exec spBogAddPropProf $propertyType, '$address', '$city', 
    '$state', $zipcode, $dailyPrice, $numBedrooms, 
    $numBathrooms, $sqft, $guestCnt, '$pic';
STR;
   
    // execute the query and return the result
    return executeQuery($query);
}

//*************************************************************
// FUNCTION:    bogGetPropProfById
//
// PURPOSE:     Used to retrieve a property profile from the
// database using the property ID.  Upon success the property
// profile data is returned in a result set.
// 
//*************************************************************
function bogGetPropProfById($propId)
{
    // the SQL query to be executed on the database

    $query = <<<STR
exec spBogGetPropProfById '$propId';
STR;
   
   // execute the query and return the result
   return executeQuery($query);
}

//*************************************************************
// FUNCTION:    bogDelPropById
//
// PURPOSE:     Used to delete a property from the BOG system.
// All comments and reservation records associated with the
// property will also be deleted within the transaction
//
//*************************************************************
function bogDelPropById($propId)
{
    // the SQL query to be executed on the database

    $query = <<<STR
exec bogDelPropById '$propId';
STR;
   
   // execute the query and return the result
   return executeQuery($query);
}

?>