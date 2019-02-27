<?php
   /* 
    Purpose: Methods to render Common Site Header and Footer
    Author: LV
    Date: January 2019
     */

function displayPageHeader($pageTitle)
{
   $output = <<<ABC
<!DOCTYPE html>
<html>
   <head>
      <meta charset="UTF-8" />
      <title>Rockwell Studios</title>
      <link rel="stylesheet" href="stylesCommon.css" type="text/css" />
   </head>

   <body>
      <header>
         <h2>$pageTitle </h2>
      </header>
ABC;
   echo $output;
}
   
function displayPageFooter()
{
   $year = date('MY');
   $output = <<<ABC
   <footer>
      <address>
         CIS665 Robert Palumbo &copy; $year 
      </address>
   </footer>   
 </body>
</html>
ABC;
   echo $output;
}
?>