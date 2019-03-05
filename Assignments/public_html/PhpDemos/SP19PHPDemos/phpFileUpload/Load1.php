<?php
/*
    Purpose: File UpLoad
    Author: LV
    Date: March 2018
    Action: Load1a.php
 */
require_once ("../siteCommon.php");
require_once ("loadsql.php");

displayPageHeader("Add a Movie");

?>

<script src="LoadjsLibrary.js" type="text/javascript"></script>

<form name ="addForm" id="addForm" action="Load1a.php" method="post" enctype ="multipart/form-data"
      onsubmit="return checkForm(this)">

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
   <label for="dateintheaters">Release Date:(mm/dd/yyyy)</label>                         
   <input type="date" name="dateintheaters" id="dateintheaters" class="sm" onfocus="this.select()" maxlength="10" required />
   <label for="imagename">Image File:</label>         
   <input type="file" name="uploadfile" id="imagename" maxlength="50" />
    <p>
      <input type="submit" value="Add Movie" />
    </p>   
</form>

<?php
    displayPageFooter()
?>
