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
// FUNCTION:    bogGetPropertyTypes
//
// PURPOSE:     Used to retrieve the list of property types
// 
//*************************************************************
function bogGetPropertyTypes()
{
    // the SQL query to be executed on the database

    $query = <<<STR
exec spBogGetPropertyTypes;
STR;
   
   // execute the query and return the result
   return executeQuery($query);
}

//*************************************************************
// FUNCTION:    bogGetUserRoles
//
// PURPOSE:     Used to retrieve the list of user roles used
// by the system.
//  
//*************************************************************
function bogGetUserRoles()
{
    // the SQL query to be executed on the database

    $query = <<<STR
exec spBogGetUserRoles;
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
function bogAddUserProf($roleType, $email, $password, $firstName, $lastName,
            $address, $city, $state, $zipcode, $phoneNumber,
            $ccNum, $ccExpDate, $ccCvc)
{
    // the SQL query to be executed on the database
   
    $query = <<<STR
exec spBogAddUserProf $roleType, '$email', '$password', '$firstName', '$lastName',
'$address', '$city', '$state', $zipcode, $phoneNumber,
$ccNum, '$ccExpDate', $ccCvc;
STR;
   
    // execute the query and return the result
   
    return executeQuery($query);
}

//*************************************************************
// FUNCTION:    bogGetUserProfByUserId
//
// PURPOSE:     Used to retrieve a user profile from the
// database using the User ID.  Upon success the user
// profile data is returned in a result set.
// 
//*************************************************************
function bogGetUserProfByUserId($userId)
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
// FUNCTION:    bogGetAllPropProf
//
// PURPOSE:     Used to retrieve all property profiles from the
// databas.  Upon success the property profile data is returned 
// in a result set.
// 
//*************************************************************
function bogGetAllPropProf()
{
    // the SQL query to be executed on the database

    $query = <<<STR
exec spBogGetAllPropProf;
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

//*************************************************************
// FUNCTION:    bogGetCommentsByUserId
//
// PURPOSE:     Used to retrieve all comments for the specified
// user id.
//
//*************************************************************
function bogGetCommentsByUserId($userId)
{
    // the SQL query to be executed on the database

    $query = <<<STR
exec spBogGetCommentsByUserId $userId;
STR;
   
   // execute the query and return the result
   return executeQuery($query);
}

//*************************************************************
// FUNCTION:    bogGetCommentsByPropId
//
// PURPOSE:     Used to retrieve all comments for the specified
// property id.
//
//*************************************************************
function bogGetCommentsByPropId($propId)
{
    // the SQL query to be executed on the database

    $query = <<<STR
exec spBogGetCommentsByPropId $propId;
STR;
   
   // execute the query and return the result
   return executeQuery($query);
}

//*************************************************************
// FUNCTION:    bogGetCommentsByPropIdUserId
//
// PURPOSE:     Used to retrieve all comments for the specified
// property id and user id.
//
//*************************************************************
function bogGetCommentsByPropIdUserId($propId, $userId)
{
    // the SQL query to be executed on the database

    $query = <<<STR
exec spBogGetCommentsByPropIdUserId $propId, $userId;
STR;
   
   // execute the query and return the result
   return executeQuery($query);
}

//*************************************************************
// FUNCTION:    bogAddReservProf
//
// PURPOSE:     Used to add a reservation to the BOG system
// assuming the dates are available for the specified property.
//
//*************************************************************
function bogAddReservProf($propId, $userId, $checkinDate, $checkoutDate)
{
    // the SQL query to be executed on the database

    $query = <<<STR
exec spBogAddReservProf $propId, $userId, '$checkinDate', '$checkoutDate', 
        1500, 4;
STR;
   
   // execute the query and return the result
   return executeQuery($query);
}

//*************************************************************
// FUNCTION:    bogGetReservProfByUserId
//
// PURPOSE:     Used to retrieve any reservations made by the
// specified user id.
//
//*************************************************************
function bogGetReservProfsByUserId($userid)
{
    // the SQL query to be executed on the database

    $query = <<<STR
exec spBogGetReservProfsByUserId $userId
STR;
   
   // execute the query and return the result
   return executeQuery($query);
}

//*************************************************************
// FUNCTION:    bogSearhcPropProfs
//
// PURPOSE:     Used to retrieve properties based upon the
// specified parameter search criteria.
// 
// NOTE: It was just simpler to implement this complex search
// inline versus a stored procedure doing the same.
//
//*************************************************************
function bogSearchPropProfs($propType, $address, $city, $state, 
                $zipcode, $dailyPrice, $numBeds, $numBaths, 
                $sqft, $guestCnt)
{
    $query = <<<STR
Select p.[PropertyIdPK], p.[PropertyTypeIdFK], Address, City, State, Zipcode,
DailyPrice, NumBedrooms, NumBathrooms, Sqft, GuestCnt, Pic
From PropertyT p
    Inner Join PropertyTypeT pt
        On p.[PropertyTypeIdFK] = pt.[PropertyTypeIdPK]
Where 0=0
STR;
    if ($propType != '')
    {
    $query .= <<<STR
 And p.[PropertyTypeIdFK] = $propType
STR;
    }
    if ($address != '')
    {
    $query .= <<<STR
 And Address like '%$address%'
STR;
    }
    if ($city != '')
    {
    $query .= <<<STR
 And City like '%$city%'
STR;
    }
    if ($state != '')
    {
    $query .= <<<STR
 And State = '$state'
STR;
    }
    if ($zipcode != '')
    {
    $query .= <<<STR
 And Zipcode = $zipcode
STR;
    }
    if ($dailyPrice != '')
    {
    $query .= <<<STR
 And DailyPrice <= $dailyPrice
STR;
    }
    if ($numBeds != '')
    {
    $query .= <<<STR
 And NumBedrooms >= $numBeds
STR;
    }
    if ($numBaths != '')
    {
    $query .= <<<STR
 And NumBathrooms >= $numBaths
STR;
    }
    if ($sqft != '')
    {
    $query .= <<<STR
 And SqFt <= $sqft
STR;
    }
    if ($guestCnt != '')
    {
    $query .= <<<STR
 And GuestCnt >= $guestCnt
STR;
    }
    $query .= <<<STR
Order by p.[PropertyIdPK]
STR;

return executeQuery($query);

}

//*************************************************************
// FUNCTION:    bogSearhcPropProfsByLoc
//
// PURPOSE:     Used to retrieve properties based upon the
// specified property type, city, state, zipcode.  If all 
// parameters are blank then ALL properties will be returned.
// 
// NOTE: It was just simpler to implement this complex search
// inline versus a stored procedure doing the same.
//
//*************************************************************
function bogSearchPropProfsByLoc($propType, $city, $state, $zipcode)
{
    $query = <<<STR
Select p.[PropertyIdPK], p.[PropertyTypeIdFK], Address, City, State, Zipcode,
DailyPrice, NumBedrooms, NumBathrooms, Sqft, GuestCnt, Pic
From PropertyT p
    Inner Join PropertyTypeT pt
        On p.[PropertyTypeIdFK] = pt.[PropertyTypeIdPK]
Where 0=0
STR;
    if ($propType != '')
    {
    $query .= <<<STR
 And p.[PropertyTypeIdFK] = $propType
STR;
    }
    if ($city != '')
    {
    $query .= <<<STR
 And City like '%$city%'
STR;
    }
    if ($state != '')
    {
    $query .= <<<STR
 And State = '$state'
STR;
    }
    if ($zipcode != '')
    {
    $query .= <<<STR
 And Zipcode = $zipcode
STR;
    }
    
$query .= <<<STR
Order by p.[PropertyIdPK]
STR;

return executeQuery($query);

}

?>