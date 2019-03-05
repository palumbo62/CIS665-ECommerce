<?php
/*
    Purpose: File Upload
    Author: LV
    Date: February 2019
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

?>
