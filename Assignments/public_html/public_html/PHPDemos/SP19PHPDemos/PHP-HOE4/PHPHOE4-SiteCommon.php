<?php
   /* 
    Class:         CIS665
    Assignment:    PHP-HOE4
    Name:          Robert Palumbo
    Due Date:      3.5.2019 @ 11:59pm

    PHP - Hands-on-Exercise 4

    Methods to render Common Site Header and Footer  
    
    Filename: PHPHOE4-SiteCommon.php
*/

function displayPageHeader($pageTitle)
{
   $output = <<<ABC
<!DOCTYPE html>
<html>
   <head>
      <meta charset="UTF-8" />
      <title>Rockwell Studios</title>
      <link rel="stylesheet" href="PHPHOE4-Styles.css" type="text/css" />
   </head>

   <body>
      <header>
         <h2>Rockwell Studios - $pageTitle </h2>
      </header>
ABC;
   echo $output;
}
   
function displayPageFooter($footerTitle)
{
   $year = date('M-Y');
   $output = <<<ABC
   <footer>
      <address>
            CIS665 Robert Palumbo &copy; $footerTitle &nbsp;$year
      </address>
   </footer>   
 </body>
</html>
ABC;
   echo $output;
}
?>