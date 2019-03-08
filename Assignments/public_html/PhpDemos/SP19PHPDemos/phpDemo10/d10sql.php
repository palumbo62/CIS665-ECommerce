<?php
/*
    Purpose: Demo 10 - Complete Application
    Author: LV
    Date: March 2019
    Uses: dbConnExec.php
 */

require_once '../dbConnExec.php';

// get movie ratings

function getMovieRatings()
{
    $query = <<<STR
Select ratingpk, rating
From filmrating
Order by ratingpk
STR;

    return executeQuery($query);
}

// get a specific movie rating

function getAMovieRating($ratingPK)
{
    $query = <<<STR
Select ratingpk, rating
From filmrating
where ratingpk = $ratingPK
STR;

    return executeQuery($query);
}

// search film table on multiple criteria

function getMoviesByMultiCriteria($movieTitle,$pitchText,$ratingPK)
{
    $query = <<<STR
Select filmpk, movietitle, pitchtext, summary, dateintheaters
From film
Where 0=0
STR;
    if ($movieTitle != '')
    {
    $query .= <<<STR
And movietitle like '%$movieTitle%'
STR;
    }
    if ($pitchText != '')
    {
    $query .= <<<STR
And pitchtext like '%$pitchText%'
STR;
    }
    if ($ratingPK != '')
    {
    $query .= <<<STR
And ratingfk = $ratingPK
STR;
    }
$query .= <<<STR
Order by movietitle
STR;

return executeQuery($query);

}

//get title for a specific movie

function getAMovieTitle($filmPK)
{
    $query = <<<STR
Select movietitle
From film
where filmpk = $filmPK
STR;

    return executeQuery($query);
}
// get reviews for a specific movie

function getMovieReviews($filmPK)
{
    $query = <<<STR
Select reviewpk, reviewdate, reviewsummary, reviewrating, contactfk, firstname, lastname
From filmreview inner join contact on contactpk = contactfk
where filmfk = $filmPK
STR;

    return executeQuery($query);
}

// get reviews for a specific movie

function getUserReviews($contactPK)
{
    $query = <<<STR
Select reviewpk, reviewdate, reviewsummary, reviewrating, movietitle
From filmreview inner join film on filmpk = filmfk
where contactfk = $contactPK
Order by reviewdate desc
STR;

    return executeQuery($query);
}

// get details for a secific review

function getReviewDetails($reviewPK, $contactFK)
{
    $query = <<<STR
Select reviewsummary, reviewrating, movietitle
From filmreview inner join film on filmpk = filmfk
where reviewpk = $reviewPK and contactfk = $contactFK
STR;

    return executeQuery($query);
}

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

// insert a new review

function addReview($filmFK, $reviewSummary, $reviewRating, $contactFK)
{
    $query = <<<STR
Insert Into filmreview(reviewsummary,reviewrating,filmfk,contactfk)
Values('$reviewSummary',$reviewRating,$filmFK,$contactFK)
STR;

    executeQuery($query);
}

// Update a review

function updateReview($reviewPK, $reviewSummary, $reviewRating)
{
    $query = <<<STR
Update filmreview
Set reviewsummary = '$reviewSummary', reviewrating = $reviewRating
Where reviewpk = $reviewPK
STR;

    executeQuery($query);
}

// delete a secific review

function deleteReview($reviewPK, $contactFK)
{
    $query = <<<STR
delete
from filmreview            
where reviewpk = $reviewPK and contactfk = $contactFK
STR;

    return executeQuery($query);
}
?>
