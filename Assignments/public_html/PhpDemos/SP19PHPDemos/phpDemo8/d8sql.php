<?php
/*
    Purpose: Demo 8 - Securing Applications
    Author: LV
    Date: February 2019
    Uses: dbConnExec.php
 */

require_once '../dbConnExec.php';

// checks whether a user with the provided credentials exists

function getUser($userLogin, $userPassword)
{
    $query = <<<STR
Select contactpk, firstname, userrolename
From contact inner join userrole
on userrolefk = userrolepk
Where userlogin = '$userLogin'
and userpassword = '$userPassword'
STR;

return executeQuery($query);

}

// checks whether a username alreadys exists

function findDuplicateUser($userLogin)
{
    $query = <<<STR
Select userlogin
From contact
Where userlogin = '$userLogin'
STR;

return executeQuery($query);
}

// inserts a new row in the contacts table

function addCustomer($userLogin, $userPassword, $firstName, $lastName, $address, $city, $state, $zip, $country, $eMail, $phone, $mailingList)
{
    $query = <<<STR
Insert Into contact(userlogin, userpassword, firstname, lastname, address, city, state, zip, country, email, phone, mailinglist)
Values('$userLogin','$userPassword','$firstName','$lastName','$address','$city', '$state','$zip','$country','$eMail','$phone','$mailingList')
STR;

    executeQuery($query);
}

?>
