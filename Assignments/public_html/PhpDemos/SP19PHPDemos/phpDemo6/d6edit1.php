<?php
/*
    Purpose: Demo6 - CRUD Operations
    Author: LV
    Date: February 2019
    Uses: siteCommon.php, d6sql.php
    Action: d6edit1a.php
 */

require_once ("../siteCommon.php");
require_once ("d6Sql.php");

// declare and initialize Add/Edit flag variable

$editmode = false;

// if a numeric filmid was passed through the URL

if ((isset($_GET['filmpk'])) && (is_numeric($_GET['filmpk'])))
{
    // get the details for the movie to be edited
    
    $moviedetails = getMovieDetailsByID((int)$_GET['filmpk']);
    
    // if movie details are returned for the filmid, set $editmode to true
    
    $editmode = (count($moviedetails) == 1);
}

// if mode is $editmode is true

if ($editmode)
{
   extract($moviedetails[0]);

    $dateintheaters = date_format(new DateTime($dateintheaters), 'm/d/Y');

    $formtitle = 'Update a Movie';
    $buttontext = 'Update';
 }
else  //otherwise, set the column variables to ""
{
    $movietitle = '';
    $pitchtext = '';
    $amountbudgeted = '';
    $ratingfk = '';
    $summary = '';
    $imagename = '';
    $dateintheaters = '';

    $formtitle = 'Add a Movie';
    $buttontext = 'Insert';
}

// call the displayPageHeader method in siteCommon.php

displayPageHeader($formtitle);
?>

<script src="d6jsLibrary.js" type="text/javascript"></script>

<form name ="addEditForm" id="addEditForm" action="d6edit1a.php" method="post" onsubmit="return checkForm(this)">

<?php
    if ($editmode)  //put the filmpk in a hidden field
    {
        echo '<input type="hidden" name="filmpk" value="' . $filmpk . '" />';
    }
?>

<label for="movietitle">Movie Title:</label>   
   <input type="text" name="movietitle" id="movietitle" maxlength="100" value="<?php echo $movietitle; ?>" autofocus required pattern="^[a-zA-Z0-9][\w\s\&,]*[a-zA-Z0-9\!\?\.]$" title="Movie title has invalid characters" />
   <label for="pitchtext">Tag Line:</label>         
   <input type="text" name="pitchtext" id="pitchtext" maxlength="100" value="<?php echo $pitchtext; ?>" required pattern="^[a-zA-Z0-9][\w\s\&,]*[a-zA-Z0-9\!\?\.]$" title="Tag line has invalid characters" />
   <label for="rating">Movie Rating:</label>
   <select name="ratingpk" id="rating"> //if edit, ensure that the appropriate rating for the film being edited is selected
      <?php
         $ratingsList = getMovieRatings();  // get the movieratings to populate the list box
         foreach ($ratingsList as $aRating)
         {
            extract($aRating);
            if ($ratingpk == $ratingfk)
            {
               $output .= <<<HTML
                            <option value="$ratingpk" selected>$rating</option>
HTML;
            }
            else
            {
               $output .= <<<HTML
                        <option value="$ratingpk">$rating</option>
HTML;
            }

         }
         echo $output;
      ?>
   </select>
   <label for="summary">Summary:</label>
   <textarea name="summary" id="summary" wrap="soft" onfocus="this.select()"><?php echo $summary; ?></textarea>
   <label for="amountbudgeted">Budget:</label>        
   <input type="number" name="amountbudgeted" id="amountbudgeted" maxlength="9" class="sm" value="<?php echo $amountbudgeted; ?>" required min="1000" max="999000000" />
   <label for="dateintheaters">Release Date:(mm/dd/yyyy)</label>                         
   <input type="text" name="dateintheaters" id="dateintheaters" class="sm" maxlength="10" value="<?php echo $dateintheaters; ?>" required onfocus="this.select()" /> 
   <label for="imagename">Image File:</label>         
   <input type="text" name="imagename" id="imagename" class="sm" maxlength="50" value="<?php echo $imagename ?>" pattern="^\w+\.\w{3,5}$" title="Invalid file name" onfocus="this.select()" />
    <p>
      <input type="submit" value="<?php echo $buttontext ?>" />
      <a href="d6all.php">Cancel</a>
    </p> 

</form>

<?php
// call the displayPageFooter method in siteCommon.php

displayPageFooter();
?>