<?php
/* 
    Purpose: Demo3 - Accessing and displaying data for a film based on FilmPK passed through URL
    Author: LV
    Date: January 2019
    Uses: siteCommon.php, d3Sql.php
    Links to: d3film3.php
 */

$listPage = 'd3film3.php';

// If filmpk is not passed with page request or it is not numeric, redirect to d3film3.php

if (!isset($_GET['filmpk'])|| !is_numeric($_GET['filmpk']))
{
    header('Location:' . $listPage);
    exit();
}
else
{
    $filmPK = (int) $_GET['filmpk'];
}

// include the functions library

require_once ("d3Sql.php");

// Call the getFilmByFilmPK method

$filmList = getFilmByFilmPK($filmPK);

// If the number of records is not 1, redirect to d3film3.php

if (count($filmList) != 1)
{
   header('Location:' . $listPage);
   exit();
}

// extract the elements of the array

extract($filmList[0]);

// format the date field

$formattedDate = date_format(new DateTime($dateintheaters), 'F j, Y');
$formattedBudget = number_format($amountbudgeted);

require_once ("../siteCommon.php");

// call the displayPageHeader method in siteCommon.php

displayPageHeader($movietitle);

$output = '<section>';

// include img tag if an image exists for the film

if (checkImageFile($filmPK))
{
   $output .= <<<ABC
<figure>
   <img src = "../images/f$filmPK.gif" alt="$movietitle" />
</figure>
ABC;
}

$output .= <<<DEF
<article id="MovieDetail">
   <dl>
    <dt>Tag Line:</dt>
      <dd>$pitchtext</dd>
    <dt>Summary:<dt>
      <dd>$summary</dd>
    <dt>Released:<dt>
      <dd>$formattedDate</dd>
    <dt>Budget:</dt>
      <dd>\$$formattedBudget</dd>
   </dl>

   <p>
      <a href="$listPage">[Back to Film List]</a>
   </p>
</article>
</section>
DEF;

echo $output;

// call the displayPageFooter method in siteCommon.php

displayPageFooter();

?>
