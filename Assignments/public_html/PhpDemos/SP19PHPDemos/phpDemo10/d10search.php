<?php
/*
    Purpose: Demo10 - Search
    Author: LV
    Date: March 2019
    Uses: siteCommon2.php, d10sql.php
    Action: d10results.php
 */

session_start();

require_once ("../siteCommon2.php");
require_once ("d10Sql.php");

// get the ratings from the FilmRating table

$ratings = getMovieRatings();

// call the displayPageHeader method in siteCommon2.php

displayPageHeader("<br />Search for a movie by its title, tagline and/or ratings <br />
    Note: The Ratings are generated dynamically");
?>

<section>
<form action="d10results.php" method = "post" name="SearchByMultiCriteria" id="SearchByMultiCriteria">
   <label for="movietitle">Movie Title:</label>
   <input type="text" name="movietitle" id="movietitle" maxlength="50" />
   <label for="pitchtext">Tag Line:</label>
   <input type="text" name="pitchtext" id="pitchtext" maxlength="50" />
   <label for="rating">Movie Rating:</label>
   <select name="ratingpk" id="rating">
      <option value=""></option>
          <?php
              foreach ($ratings as $aRating)
              {
                  extract($aRating); //extract the array elements
                  echo '<option value="' . $ratingpk .'">' . $rating . '</option>';
              }
          ?>
   </select>
   
   <input name = "search" type="submit" value="Search" />
</form>
</section>
<?php

// call the displayPageFooter method in siteCommon2.php

displayPageFooter();
?>
