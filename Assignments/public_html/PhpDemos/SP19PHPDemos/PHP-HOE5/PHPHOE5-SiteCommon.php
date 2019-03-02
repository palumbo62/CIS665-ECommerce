<?php
   /* 
    Class:         CIS665
    Assignment:    PHP-HOE5
    Name:          Robert Palumbo
    Due Date:      3.7.2019 @ 11:59pm

    PHP - Hands-on-Exercise 5

    Methods to render Common Site Header and Footer  
    
    Filename: PHPHOE5-SiteCommon.php
*/

function displayPageHeader($pageTitle)
{
   $output = <<<ABC
<!DOCTYPE html>
<html>
   <head>
      <meta charset="UTF-8" />
      <title>Rockwell Studios</title>
      <link rel="stylesheet" href="PHPHOE5-Styles.css" type="text/css" />
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