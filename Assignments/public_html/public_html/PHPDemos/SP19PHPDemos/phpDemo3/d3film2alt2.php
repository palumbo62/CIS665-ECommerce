<?php
/*
    Purpose: Demo3 - Accessing and displaying data from a DB
    Author: LV
    Date: January 2019
    Uses: siteCommon.php, d3Sql.php
    Demos: Preparing the output with heredoc syntax
*/

require_once ("../siteCommon.php");
require_once ("d3Sql.php");

// call the displayPageHeader method in siteCommon.php

displayPageHeader("Film Table <br /> Output prepared with
            heredoc syntax");

//Call the getFilmsList method

$filmsList = getFilmsList();

//Display the result in a table

/*  Strings can be delimited using the heredoc syntax.  
    After the <<< operator, an identifier (e.g., ABC) is provided.  
    This is followed by the string (starting on a new line).
    The end of the string is indicated by using the same identifier (e.g., ABC).
    The closing identifier must begin in the first column of the line.
 */ 

$filmCount = count($filmsList);

$output = <<<ABC
<section>
<table>
   <caption>There are $filmCount films in the database </caption>
   <colgroup>
      <col class="firstcol" />
   </colgroup>
   <thead>
      <tr>
         <th>Film Title</th>
         <th>Film Pitch</th>
      </tr>
   </thead>
   <tbody>
ABC;

foreach ($filmsList as $film)
{
// for each film, concatenate the following to the $output variable
   
   $output .= <<<ABC
      <tr>
         <td>{$film['movietitle']}</td>
         <td>{$film['pitchtext']}</td>
      </tr>
ABC;
}

// concatenate the closing tags of the table and the closing section tag to the $output variable

$output .= <<<ABC
   </tbody>
</table>
</section>
ABC;

// display the value of the $output variable

echo $output;

// call the displayPageFooter method in siteCommon.php

    displayPageFooter();
    
?>
