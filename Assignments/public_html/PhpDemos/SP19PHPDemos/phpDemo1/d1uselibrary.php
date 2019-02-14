<!DOCTYPE html>
<html>
   <head>
      <!--
         Purpose: Demo1 - Using a user-built function
         Author: LV
         Date: January 2017
      -->
      <meta charset="UTF-8" />
      <title>Demo1 - Using a User-built function</title>

      <link href="d1styles.css" rel="Stylesheet" />
      
      <?php
        // include the file that has the function
        include ("d1library.php");
      ?>
   </head>

   <body>
      <header>
         <h2>Functions</h2>
      </header>
      
      <section>
         
         <span> Using a User-Built Function: </span><br /> <br />

         <!-- Call the function -->

         <?php
            echo displayDate();
         ?>
      </section>  
   </body>
</html>

