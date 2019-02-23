<?php
/*
    Purpose: Demo6 - CRUD Operations
    Author: LV
    Date: February 2019
    Uses: siteCommon.php, d6sql.php
*/
require_once ("../siteCommon.php");
require_once ("d6Sql.php");

// call the displayPageHeader method in siteCommon.php

displayPageHeader("Add/Update/Delete a Movie");

$movieList = getMovieList();  //gets the list of movies

$output = <<<HTML
<section><table id="allMovies">
HTML;

// display each movie with links to edit or delete it

foreach ($movieList as $movie)
{
    extract($movie);
    $output .= <<<HTML
    <tr>
        <td>
            $movietitle
        </td>
        <td>
            <a href="d6edit1.php?filmpk=$filmpk">[Edit]</a>
        </td>
        <td>
            <a href="d6delete1.php?filmpk=$filmpk">[Delete]</a>
        </td>
    </tr>
HTML;
}

$output .= <<<HTML
    <tr>
        <td colspan="3" align="center">
            <a href="d6edit1.php">[Add a Movie]</a>
        </td>
    </tr>
</table></section>
HTML;

echo $output;

// call the displayPageFooter method in siteCommon.php

displayPageFooter();

?>
