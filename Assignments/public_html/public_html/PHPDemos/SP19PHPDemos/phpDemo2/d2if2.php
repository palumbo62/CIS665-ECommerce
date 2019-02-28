<!DOCTYPE html> 
<html>
   <head>
      <!--  PHP:Demo2 - Conditional Processing
            Author: LV
            Date: January 2017
            Uses: d2Selection.php
      -->

      <meta charset="UTF-8" />
      <title>Demo 2 - Conditional Processing</title>
      
      <link href="d2styles.css" rel="Stylesheet" />
      
      <?php

        // include the file that has the class
        include("d2Selection.php");
      ?>

   </head>

   <body>
      <header>
         <h2>Conditional Processing<br />Nested If</h2>
      </header>
      
      <section>
         
         <?php
    
//            $roomRate = getRoomRate("N");
//            echo 'The room rate is $' . number_format($roomRate,2);
//            echo '<br /> <br />';
//            // or, you can use the printf function
//
//            printf('The room rate is $%.2f', $roomRate);
//        
            // the money_format function is not available on Windows   
         
         if (!isset($_GET['discount']))
            {
               exit('Please indicate if Discount is applicable or not!');
            }
            else
            {
               $roomRate = getRoomRate($_GET['discount']);
               echo 'The room rate is $' . number_format($roomRate,2);
               echo '<br /> <br />';
               printf('The room rate is $%.2f', $roomRate);
        
            }
         ?>
      </section>
   </body>
</html>