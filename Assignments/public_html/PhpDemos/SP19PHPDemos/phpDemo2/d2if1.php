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
         <h2>Conditional Processing <br /> If, Switch, Ternary Operator</h2>
      </header>
      
      <section>
         <?php
            echo displayDayMessage1();
            echo '<br /> <br />';
            echo displayDayMessage2();
            echo '<br /> <br />';
            echo displayDayMessage3();
         ?>
     </section>
  </body>
</html>