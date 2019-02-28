<?php
/* 
    Purpose: Demo3 Alt - Accessing and displaying data for a film based on FilmPK passed through URL
    Author: LV
    Date: February 2019
 */

$listPage = 'FilmDisplay2.php';

// If filmpk is not passed with page request or it is not numeric, redirect to FilmDisplay2.php
// Else, assign the URL parameter to a variable

if (!isset($_GET['filmpk'])|| !is_numeric($_GET['filmpk']))
{
    header('Location:' . $listPage);
    exit();
}
else
{
    $filmPK = (int) $_GET['filmpk'];
}

// include the FilmData class

require_once ("FilmData.php");

// Call the static getFilmByPK() method in FilmData

$aFilm = FilmData::getFilmByPK($filmPK);

// If the number of records is not 1, redirect to FilmDisplay2.php

if (count($aFilm) != 1)
{
   header('Location:' . $listPage);
   exit();
}

// format the date and budget fields

$formattedDate = date_format(new DateTime($aFilm[0]->dateintheaters), 'F j, Y');
$formattedBudget = number_format($aFilm[0]->amountbudgeted);

require_once ("SiteCommon.php");

// call the static displayPageHeader method in SiteCommon

echo SiteCommon::displayPageHeader($aFilm[0]->movietitle);

$output = '<section>';

// include img tag if an image exists for the film

if ($aFilm[0]->checkImageFile())
{
   $output .= <<<ABC
<figure>
   <img src = "../images/f{$aFilm[0]->filmpk}.gif" alt="{$aFilm[0]->movietitle}" />
</figure>
ABC;
}

$output .= <<<DEF
<article id="MovieDetail">
   <dl>
    <dt>Tag Line:</dt>
      <dd>{$aFilm[0]->pitchtext}</dd>
    <dt>Summary:<dt>
      <dd>{$aFilm[0]->summary}</dd>
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

// call the static displayPageFooter method in SiteCommon

echo SiteCommon::displayPageFooter();

?>
