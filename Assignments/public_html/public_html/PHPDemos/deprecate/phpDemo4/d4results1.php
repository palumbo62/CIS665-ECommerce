<?php
/* 
    Purpose: Demo4 - Search
    Author: LV
    Date: January 2019
    Uses: siteCommon.php, d4Sql.php
    Action for: d4search1.php
 */

require_once ("../siteCommon.php");
require_once ("d4Sql.php");

// $_POST is an associative array of the values passed via the HTTP POST method
 
$movieTitle = $_POST['movietitle'];

// remove any potentially malicious characters

$movieTitle = preg_replace("/[^a-zA-Z0-9\s]/", '', $movieTitle);

// Or, $movieTitle = preg_replace("/[^\w\s]/", '', $movieTitle);
// This expression will also make underscores acceptable

// Alternatively, use the filter_input function

//if (!filter_input(INPUT_POST, 'movietitle', FILTER_VALIDATE_REGEXP, array('options'=>array('regexp'=>'/^[a-zA-Z0-9\s]*$/'))))
//{
//    header('Refresh: 7; URL=d4search1.php');
//    echo '<h2>Invalid characters in search string. Acceptable characters are letters, numbers and spaces.  </h2>';
//    echo '<h2>If you are not redirected, please <a href="d4search1.php">Click here for search page</a>.</h2>';
//    die();
//}
//else
//{
//    $movieTitle = $_POST['movietitle'];
//}

// call the displayPageHeader method in siteCommon.php

displayPageHeader("Search Results for '" . $movieTitle . "'");

//Call the getMovieByTitle method

$movieList = getMovieByTitle($movieTitle);

// get a count of the number of movies returned by the method

$matchingRecords = count($movieList);

echo "<section>";

if ($matchingRecords == 0)
{
   echo "<h3>No matches found for search term - '$movieTitle'</h3>";
}
else
{   
// prepare the output using heredoc syntax

$output = <<<ABC
<table>
   <caption>$matchingRecords movie(s) found</caption>
   <tbody>
ABC;

   $movieNum = 0;
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
    <a href="d4search1.php">[Back to Search Page]</a>
</p></section>
ABC;

// display the output

echo $output;

// call the displayPageFooter method in siteCommon.php

displayPageFooter();

?>
