<?php
/*
    Purpose: Demo3 Alt - Accessing and displaying data from a DB
    Author: LV
    Date: February 2019
 */

require_once ("SiteCommon.php");
require_once ("FilmData.php");

// call the static displayPageHeader method in SiteCommon

echo SiteCommon::displayPageHeader("Film Table <br /> Titles formatted and displayed as hyperlinks");

// call the static getFilms() method in FilmData

$filmDT = FilmData::getFilms();

//get a count of the number of films

$numFilms = count($filmDT);

// Display the results as hyperlinks

$output = <<<ABC
<section>
<table>
    <caption>Movie List - ($numFilms Films)</caption>
    <tbody>
ABC;

$filmNum = 0;

foreach ($filmDT as $film)
{
    $filmNum ++;
    $filmpk = urlencode(trim($film->filmpk));
    $dateReleased = date_format(new DateTime($film->dateintheaters), 'F j, Y');
    $output .= <<<ABC
    <tr>
        <td>
            $filmNum: <a href="FilmDisplay2_1.php?filmpk=$filmpk">$film->movietitle</a><br />
            $film->pitchtext
        </td>
        <td>
            Released: $dateReleased
        </td>
    </tr>
    <tr>
        <td colspan="2">
            $film->summary
        </td>
    </tr>
ABC;
}

$output .= '</tbody> </table> </section>';

echo $output;

// call the static displayPageFooter method in SiteCommon

echo SiteCommon::displayPageFooter();

?>
