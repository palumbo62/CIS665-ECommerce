<?php
/*
    Purpose: Demo3 - Accessing and displaying data from a DB
    Author: LV
    Date: January 2019
    Uses: siteCommon.php, d3Sql.php
*/

require_once ("../siteCommon.php");
require_once ("d3Sql.php");

// call the displayPageHeader method in siteCommon.php

displayPageHeader('Film List');

echo '<section>';

// call the getFilmsList() method in d3sql.php

$filmsList = getFilmsList();


// use a loop to display the results

foreach ($filmsList as $film)
{
    echo $film['movietitle'] . '<br />' ;
}

echo '</section>';

// call the displayPageFooter method in siteCommon.php

displayPageFooter();

?>
