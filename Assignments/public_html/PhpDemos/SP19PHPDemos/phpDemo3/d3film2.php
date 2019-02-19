<?php
/*
    Purpose: Demo3 - Accessing and displaying data from a DB
    Author: LV
    Date: January 2019
    Uses: siteCommon.php, d3Sql.php
    Demos: Preparing the output with just PHP code;
           the HTML tags are embedded within the PHP code
*/

require_once ("../siteCommon.php");
require_once ("d3Sql.php");

// call the displayPageHeader method in siteCommon.php

displayPageHeader("Film Table <br /> Output prepared with just PHP Code");

//Call the getFilmsList method

$filmsList = getFilmsList();

//Display the result in a table

echo '<section>';
echo
'<table>
   <caption> There are ' . count($filmsList) . ' films in the database </caption>
      <colgroup>
         <col class="firstcol" />
      </colgroup>
      <thead>
         <tr>
            <th>Film Title</th>
            <th>Film Pitch</th>
         </tr>
      </thead>
      <tbody>';

      foreach ($filmsList as $film)
      {
      echo
         '<tr>
            <td>'  . $film['movietitle']  . '</td>
            <td>' . $film['pitchtext'] . '</td>
         </tr>';
      }

echo  '</tbody> </table> </section>';

// call the displayPageFooter method in siteCommon.php
displayPageFooter();
?>
