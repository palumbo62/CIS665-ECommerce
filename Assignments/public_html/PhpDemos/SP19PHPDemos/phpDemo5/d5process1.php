<?php
/*
    Purpose: Demo5 - Validation
    Author: LV
    Date: February 2019
    Action for: d5valid1.php
 */

// declare an array to hold the validation error messages

$error = array();

// the ternary operator (similar to an in-line IF statement) is used to set the variable, $loginID

$loginID = isset($_POST['loginID']) ? trim($_POST['loginID']) : '';

// if $loginID is empty, add an appropriate message to the $error array

if (empty($loginID))
{
    $error[] = urlencode('Please enter your Login ID');
}

// if $loginID contains non-numeric characters, add an appropriate message to the $error array

elseif (!ctype_digit($loginID))
{
    $error[] = urlencode('Invalid Login ID');
}

// the ternary operator (similar to an in-line IF statement) is used to set the variable, $loginPassword

$loginPassword = isset($_POST['loginPassword']) ? trim($_POST['loginPassword']) : '';

// if $loginPassword is empty, add an appropriate message to the $error array

if (empty($loginPassword))
{
    $error[] = urlencode('Please enter your Password');
}

// if the $error array is NOT empty, redirect to the submitting page
// include the error messages (captured in the $error array) as a URL parameter (error)
// the join method is used to "glue" together each element in the $error array to form one string
// in the example below, each error message in the $error array is "glued" to the next with a <br /> tag

if (!empty($error))
{
    header('Location:d5valid1.php?error=' . join(urlencode('<br />'), $error));
    
    exit;
}
else
{
    require_once ("../siteCommon.php");

    // call the displayPageHeader method in siteCommon.php

    displayPageHeader("OK, You are In!");
}
// call the displayPageFooter method in siteCommon.php

displayPageFooter();
?>
