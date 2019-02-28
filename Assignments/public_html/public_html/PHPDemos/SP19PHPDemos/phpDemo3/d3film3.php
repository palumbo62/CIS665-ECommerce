<?php
/*
    Purpose: Demo3 - Accessing and displaying data from a DB
    Author: LV
    Date: January 2019
    Uses: siteCommon.php, d3Sql.php
    Links to: d3film3_1.php
*/

require_once ("../siteCommon.php");
require_once ("d3Sql.php");

// call the displayPageHeader method in siteCommon.php

displayPageHeader("Film Table <br /> Titles formatted and displayed as hyperlinks");

//Call the getFilmsList method

$filmsList = getFilmsList();

//get a count of the number of films

$numFilms = count($filmsList);

// Display the film titles as hyperlinks

$output = <<<ABC
<section>
<table>
   <caption>Film List - ($numFilms Films)</caption>
   <tbody>
ABC;

$filmNum = 0;

foreach ($filmsList as $film)
{
    // XRLP NOTE:
    // extract() makes variables out of the associative array keys and assigns
    // the value for each key to the corresponding variable
    extract($film);
    $filmNum ++;
    
    // XRLP NOTE:
    // urlencode this function is convenient when encoding a string to be used 
    //      in a query part of a URL, as a convenient way to pass variables to 
    //      the next page.
    // trim removes leading/trailing whitespace
    
    $filmpk = urlencode(trim($filmpk));
    $dateReleased = date_format(new DateTime($dateintheaters), 'F j, Y');
    
    //$testvar = urlencode("$%$& *(&*");
    
    $output .= <<<ABC
    <tr>
        <td>
            // creates hyperlink using <a> tag
            $filmNum: <a href="d3film3_1.php?filmpk=$filmpk">$movietitle</a><br />
            //$filmNum: <a href="d3film3_1.php?filmpk=$filmpk"&testvar=$testvar>$movietitle</a><br />
                $pitchtext
        </td>
        <td>
            Released: $dateReleased
        </td>
    </tr>
    <tr>
        <td colspan="2">
            $summary
        </td>
    </tr>
ABC;
}

$output .= '</tbody> </table> </section>';

echo $output;

// call the displayPageFooter method in siteCommon.php

displayPageFooter();

?>
