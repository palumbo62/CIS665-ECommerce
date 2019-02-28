<?php
/*
    Purpose: Demo4 - Search
    Author: LV
    Date: January 2019
    Uses: siteCommon.php, d4sql.php
    Action: d4results2.php
 */
require_once ("../siteCommon.php");
require_once ("d4Sql.php");

// get the ratings from the FilmRating table

$ratings = getMovieRatings();

// call the displayPageHeader method in siteCommon.php

displayPageHeader("<br />Search for a movie by its title, tagline and/or ratings <br />
    Note: The Ratings are generated dynamically");
?>

<section>
<form action="d4results2.php" method = "post" name="SearchByMultiCriteria" id="SearchByMultiCriteria">
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
   <p>
      <input name = "search" type="submit" value="Search" />
   </p>      

</form>
</section>
<?php

// call the displayPageFooter method in siteCommon.php

displayPageFooter();
?>
