<?php
/*
    Purpose: Demo4 - Search
    Author: LV
    Date: January 2019
    Uses: siteCommon.php, d4Sql.php
    Action for: d4search2.php
 */

require_once ("../siteCommon.php");
require_once ("d4Sql.php");

// $_POST is an associative array of the values passed via the HTTP POST method

$movieTitle = $_POST['movietitle'];
$pitchText = $_POST['pitchtext'];
$ratingPK = $_POST['ratingpk'];

// remove any potentially malicious characters

$movieTitle = preg_replace("/[^a-zA-Z0-9\s]/", '', $movieTitle);
$pitchText = preg_replace("/[^a-zA-Z0-9\s]/", '', $pitchText);
$ratingPK = preg_replace("/[^0-9]/", '', $ratingPK);

// get the rating associated with the ratingpk

if ($ratingPK != '')
{
    $ratingRow = getAMovieRating($ratingPK);
    if (count($ratingRow) == 1)
    extract($ratingRow[0]);
}
// call the displayPageHeader method in siteCommon.php

$heading = <<<ABC
You searched for<br />
Movie title: '$movieTitle' <br />
Movie tagline: '$pitchText' <br />
Movie rating: '$rating'
ABC;

displayPageHeader($heading);

//Call the getMoviesByMultiCriteria method

$movieList = getMoviesByMultiCriteria($movieTitle,$pitchText,$ratingPK);

// get a count of the number of movies returned by the method

$matchingRecords = count($movieList);

echo "<section>";

if ($matchingRecords == 0)
{
   echo "<h3>No matches found for the search term(s)</h3>";
}
else
{   
// prepare the output using heredoc syntax

$output = <<<ABC
<table>
   <caption>$matchingRecords movie(s) found</caption>
   <tbody>
ABC;

    foreach ($movieList as $movie)
    {
        extract($movie);
        $movieNum ++;
        $dateReleased = date_format(new DateTime($dateintheaters), "F j, Y");
        $output .= <<<ABC
        <tr>
            <td>$movieNum: $movietitle<br />
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
    
    $output .= "<tbody></table>";
}
$output .= <<<ABC
<p style="text-align: center">
    <a href="d4search2.php">[Back to Search Page]</a>
</p></section>
ABC;

// display the output

echo $output;

// call the displayPageFooter method in siteCommon.php

displayPageFooter();
?>
