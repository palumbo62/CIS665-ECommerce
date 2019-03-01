<?php
/*
    Purpose: Demo 7 - Cookies
    Author: LV
    Date: February 2019
    Uses: dbConnExec.php
 */

require_once '../dbConnExec.php';

function getMovie($searchCriteria, $searchMaxRows)
{
    $query = <<<STR
Select top $searchMaxRows movietitle, summary
From film
Where movietitle like '%$searchCriteria%'
or summary like '%$searchCriteria%'
Order by movietitle
STR;

    return executeQuery($query);
}

?>
