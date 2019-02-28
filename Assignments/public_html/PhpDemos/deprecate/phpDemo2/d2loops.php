<!DOCTYPE html> 
<html>
   <head>
      <!--  PHP:Demo2 - Iteration
            Author: LV
            Date: January 2017
            Uses: d2Iteration.php
      -->

      <meta charset="UTF-8" />
      <title>Demo 2 - Iteration</title>
      
      <link href="d2styles.css" rel="Stylesheet" />
      
      <?php

        // include the file that has the class
        include("d2Iteration.php");
      ?>

   </head>
   
   <body>

    <section>
        <?php
        
        echo '<h3>For Loop</h3>';

        echo demoForLoop();

        echo '<h3>While Loop</h3>';

        echo demoWhileLoop();

        echo '<h3>Do While Loop</h3>';

        echo demoDoWhileLoop();

        echo '<h3>For Each Loop</h3>';

        echo demoForEachLoop();
      ?>
    </section>
   </body>
</html>

