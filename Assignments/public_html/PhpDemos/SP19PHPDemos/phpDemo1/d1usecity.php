<!DOCTYPE html> 
<html>
   <head>

      <!--
         Purpose: Demo1 - Instantiate and use a PHP class
         Author: LV
         Date: January 2017
      -->

      <meta charset="UTF-8" />
      <title>Demo1 - Instantiate and use a PHP class</title>
      
      <link href="d1styles.css" rel="Stylesheet" />
      
      <?php

        // include the file that has the class
        include("d1city.php");
      ?>

   </head>

   <body>
      <header>
         <h2>Using a Class</h2>
      </header>
      
      <section>
         <p> 
        
         <?php

            // Instantiate an object of the City class

            $aCity = new City('Fort Collins');

            // Call methods on the object
        
            echo 'You city is: ' . $aCity->getCityName() . '<br />';
            echo 'Your city in Uppercase: ' . $aCity->getCityNameUpper() . '<br />';
            echo 'Your city in Lowercase: ' . $aCity->getCityNameLower() . '<br />';
            echo 'Your city in Reverse: ' . $aCity->reverseCityName() . '<br />';
            echo 'Characters in your city name: ' . $aCity->getCityNameLength() . '<br />';
            echo 'Collins replaced with Wayne: ' . $aCity->replaceCityName('Collins', 'Wayne');
        ?>

         </p>
      </section>
    </body>
</html>
