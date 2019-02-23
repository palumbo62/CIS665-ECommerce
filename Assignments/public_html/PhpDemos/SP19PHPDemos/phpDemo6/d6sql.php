<?php
/*
    Purpose: Demo6 - Sql methods to access and update the RWStudios Database
    Author: LV
    Date: February 2019
    Uses: dbConnExec.php
 */

require_once '../dbConnExec.php';

function addMovie($movieTitle, $pitchText, $amountBudgeted, $ratingFK, $summary, $dateInTheaters, $imageName)
{
    // escape single quotes within the string (e.g., "Schindler's List" is escaped as "Schindler''s List" 
    
    $movieTitle = str_replace('\'', '\'\'', trim($movieTitle));
    $pitchText = str_replace('\'', '\'\'', trim($pitchText));
    $summary = str_replace('\'', '\'\'',trim($summary));
    $imageName = trim($imageName);
    
    $query = <<<STR
Insert Into film(movietitle,pitchtext,amountbudgeted,ratingfk,summary,dateintheaters,imagename)
Values('$movieTitle','$pitchText',$amountBudgeted,$ratingFK,'$summary','$dateInTheaters', '$imageName')
STR;

    executeQuery($query);
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

function getMovieList()
{
    $query = <<<STR
Select filmpk, movietitle
From film
Order by movietitle
STR;
    
    return executeQuery($query);
}

function getMovieDetailsByID($filmPK)
{
   $query = <<<STR
Select filmpk, movietitle, pitchtext, summary, dateintheaters,amountbudgeted, ratingfk, imagename
From film
Where filmpk = $filmPK
STR;
    
    return executeQuery($query);
}

function updateMovie($filmPK, $movieTitle, $pitchText, $amountBudgeted, $ratingFK, $summary, $dateInTheaters, $imageName)
{
    $movieTitle = str_replace('\'', '\'\'', trim($movieTitle));
    $pitchText = str_replace('\'', '\'\'', trim($pitchText));
    $summary = str_replace('\'', '\'\'',trim($summary));
    $imageName = trim($imageName);

    $query = <<<STR
Update film
Set movietitle = '$movieTitle', pitchtext = '$pitchText', amountbudgeted = $amountBudgeted, ratingfk = $ratingFK,
summary = '$summary', dateintheaters = '$dateInTheaters', imagename = '$imageName'
Where filmpk = $filmPK
STR;

    executeQuery($query);
}

function deleteMovie($filmPK)
{
    $query = <<<STR
Delete
From film
Where filmpk = $filmPK
STR;

    executeQuery($query);
}

?>
