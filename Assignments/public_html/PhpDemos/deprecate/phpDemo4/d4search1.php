<?php
/*
    Purpose: Demo4 - Search
    Author: LV
    Date: January 2019
    Uses: siteCommon.php
    Action: d4results1.php
 */

require_once ("../siteCommon.php");

// call the displayPageHeader method in siteCommon.php

displayPageHeader("Search for a movie by its title");
?>

<section>
   <form action="d4results1.php" method = "post" name="SearchByTitle" id="SearchByTitle">
      <label for="movietitle"> Movie Title:</label>
      <input type="text" name="movietitle" id ="movietitle" maxlength="50" />
      <p>
         <input type="submit" value="Search" name="search" />
      </p>
   </form>
</section>

<?php

// call the displayPageFooter method in siteCommon.php

displayPageFooter();
?>