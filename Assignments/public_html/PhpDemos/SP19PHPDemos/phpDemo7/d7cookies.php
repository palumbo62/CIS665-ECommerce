<?php
/*
    Purpose: Demo7 - Cookies
    Author: LV
    Date: February 2019
    Uses: siteCommon.php, d7sql.php

    If the form is submitted (i.e.,$POST['searchcriteria'] is set);
    set cookies to store the search criteria and maximum number of rows specified by user
 */

if (isset($_POST['searchcriteria']))
{
    $searchcriteria =  $_POST['searchcriteria'];
    $searchmaxrows =   $_POST['searchmaxrows'];

    // cookies are set to expire 30 days from now (given in seconds)

    $expire = time() + (60 * 60 * 24 * 30);
    setcookie('lastsearch', $searchcriteria, $expire);
    setcookie('lastmaxrows', $searchmaxrows, $expire);
}

// If a previous user is visting this page

elseif (isset($_COOKIE['lastsearch']) && isset($_COOKIE['lastmaxrows']))
{
    $searchcriteria =  $_COOKIE['lastsearch'];
    $searchmaxrows = $_COOKIE['lastmaxrows'];
}

// If a user is visiting this page for the first time

else
{
    $searchcriteria =  '';
    $searchmaxrows = 1;
}

require_once ("../siteCommon.php");
require_once ("d7Sql.php");

// call the displayPageHeader method in siteCommon.php

displayPageHeader("Cookies Demo");

?>

<section>
<p>
    This page demos how cookies can be set with PHP. <br />
    You can view the cookies that were set <a href="d7viewcookie.php">here</a> <br />
    You can delete the cookies by clicking <a href="d7deletecookie.php">here</a><br />
</p>
<hr />
<!-- Check the action attribute; the form is being submitted to itself) -->

<form name ="cookiesForm" id="cookiesForm" action="d7cookies.php" method="post">
   <label for="searchcriteria">Search for:</label>
   <input name="searchcriteria" id="searchcriteria" type="text" value="<?php echo $searchcriteria ?>" maxlength="20" autofocus required pattern="^[a-zA-Z0-9][a-zA-Z0-9\s]*[a-zA-Z0-9]$|^[a-zA-Z0-9]$" title="You must specify a search criteria" />
   <label for="searchmaxrows">Maximum Records (1 to 20):</label>
   <input name="searchmaxrows" id="searchmaxrows" type="number" value="<?php echo $searchmaxrows ?>" maxlength="2" min="1" max="20" required />
   <p>
      <input type="submit" value="Search">
   </p>

</form>

<?php

// if the form is submitted

if (isset($_POST['searchcriteria']))
{
    //clean the inputs

    $searchcriteria = preg_replace("/[^a-zA-Z0-9\s]/", '', $searchcriteria);
    $searchmaxrows = (int)$searchmaxrows;

    // call the getMovie method

    $movieList = getMovie($searchcriteria, $searchmaxrows);
    $matchingRecords = count($movieList);

// prepare output with heredoc syntax

$output = <<<ABC
<hr />
<em>$matchingRecords record(s) found for '$searchcriteria' </em> <br />
ABC;

// if the query returned 1 or more records

if ($matchingRecords > 0)
{
    foreach ($movieList as $movie)
    {
        extract($movie);
        $output .= <<<ABC
      <p>
      <strong>$movietitle</strong> <br />
             $summary
      </p>
ABC;
    }
}

echo $output;

}

echo "</section>";

// call the displayPageFooter method in siteCommon.php

displayPageFooter();

?>
