<?php
/* 
    Class:          CIS665
    Assignment:     Course Project 
    Team-115:       Robert Palumbo, Kiana Vigil, Valerie Duran
    Due Date:       5.7.2019 @ 11:59pm

    Filename:       bogSiteCommon.php
    
        PHP based support funtions common to all web site pages.
 
*/
function displayPageHeader($pageTitle)
{
   $output = <<<ABC
<!DOCTYPE html>
<html>
   <head>
      <meta charset="UTF-8" />
      <title>BOG - Be Our Guest!</title>
      <link rel="stylesheet" href="..\cssStyles\BogStylesCommon.css" type="text/css" />
   </head>

   <body>
      <header>
         <h2>$pageTitle </h2>
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
        CIS665 Team-115 &copy; $footerTitle &nbsp;$year
      </address>
   </footer>   
 </body>
</html>
ABC;
   echo $output;
}
?>