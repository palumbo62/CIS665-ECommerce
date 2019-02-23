<?php
/*
    Purpose: Demo6 - CRUD Operations
    Author: LV
    Date: February 2019
    Uses: siteCommon.php, d6sql.php
    Action: d6add1a.php
 */
require_once ("../siteCommon.php");
require_once ("d6Sql.php");

// call the displayPageHeader method in siteCommon.php

displayPageHeader("Add a Movie");
?>

<script src="d6jsLibrary.js" type="text/javascript"></script>

<form name ="addForm" id="addForm" action="d6add1a.php" method="post" onsubmit="return checkForm(this)">

   <label for="movietitle">Movie Title:</label>   
   <input type="text" name="movietitle" id="movietitle" maxlength="100" autofocus required pattern="^[a-zA-Z0-9][\w\s\&,]*[a-zA-Z0-9\!\?\.]$" title="Movie title has invalid characters"/>
   <label for="pitchtext">Tag Line:</label>         
   <input type="text" name="pitchtext" id="pitchtext" maxlength="100" required pattern="^[a-zA-Z0-9][\w\s\&,]*[a-zA-Z0-9\!\?\.]$" title="Tag line has invalid characters" />
   <label for="rating">Movie Rating:</label>
   <select name="ratingpk" id="rating">
      <?php
         $ratingsList = getMovieRatings();  // get the movieratings to populate the list box
         foreach ($ratingsList as $aRating)
         {
            extract($aRating);
            $output .= <<<HTML
            <option value="$ratingpk">$rating</option>
HTML;
         }
         echo $output;
      ?>
   </select>
   <label for="summary">Summary:</label>
   <textarea name="summary" id="summary" wrap="soft" onfocus="this.select()"></textarea>
   <label for="amountbudgeted">Budget:</label>        
   <input type="number" name="amountbudgeted" id="amountbudgeted" maxlength="9" class="sm" required min="1000" max="999000000" />
   <label for="dateintheaters">Release Date:</label>                         
   <input type="date" name="dateintheaters" id="dateintheaters" class="sm" onfocus="this.select()" maxlength="10" required /> 
   <label for="imagename">Image File:</label>         
   <input type="text" name="imagename" id="imagename" class="sm" maxlength="50" pattern="^\w+\.\w{3,5}$" title="Invalid file name" />
    <p>
      <input type="submit" value="Add Movie" />
    </p>        
</form>

<?php

// call the displayPageFooter method in siteCommon.php

displayPageFooter();
?>