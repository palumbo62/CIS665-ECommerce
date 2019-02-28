<?php
/*
    Purpose: Demo3 Alt - Display Film Titles
    Author: LV
    Date: February 2019
*/

require_once ("SiteCommon.php");
require_once ("FilmData.php");

// call the static displayPageHeader method in SiteCommon

echo SiteCommon::displayPageHeader('Film Titles');

// call the static getFilms method in FilmData
        
$filmDT = FilmData::getFilms();

// use a loop to prepare output

$output = '<section>';

foreach ($filmDT as $film)
{
    $output .= $film->movietitle . '<br />' ;
}

$output .= '</section>';

echo $output;

// call the static displayPageFooter method in SiteCommon

echo SiteCommon::displayPageFooter();

?>
