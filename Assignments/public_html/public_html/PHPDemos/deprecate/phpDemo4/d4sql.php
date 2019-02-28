<?php
/*
    Purpose: Demo4 - Sql Methods to access the Movie Database
    Author: LV
    Date: January 2019
    Uses: dbConnExec.php
 */

require_once ("../dbConnExec.php");

function getMovieByTitle($movieTitle)
{
    $query = <<<STR
Select movietitle, pitchtext, summary, dateintheaters
From film
Where movietitle like '%$movieTitle%'
STR;

    return executeQuery($query);
}

function getMovieRatings()
{
    $query = <<<STR
Select ratingpk, rating
From filmrating
Order by ratingpk
STR;

    return executeQuery($query);
}

function getAMovieRating($ratingPK)
{
    $query = <<<STR
Select ratingpk, rating
From filmrating
where ratingpk = $ratingPK
STR;

    return executeQuery($query);
}

function getMoviesByMultiCriteria($movieTitle,$pitchText,$ratingPK)
{
    $query = <<<STR
Select movietitle, pitchtext, summary, dateintheaters
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

?>