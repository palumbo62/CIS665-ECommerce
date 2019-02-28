<!DOCTYPE html>
<html>
    <head>
      <!--
        Purpose: Demo1 - Basic PHP - Functions & Variables
        Author: LV
        Date: January 2017
      -->
        <meta charset="UTF-8" />
        <title>Demo1 - Functions Variables and Constants</title>
        
        <link href="d1styles.css" rel="Stylesheet" />
    </head>

    <body>

     <header>

         <h2>Hello and Welcome to the World of PHP</h2>

     </header>

     <section>
         <p>
             <span>Using a PHP function:</span><br /><br />

             <?php
               echo 'Today\'s date is ' . date('F j, Y, g:i A (e)');
             ?>

             <br /> <br />

             <?php
                 //Declaring and initializing a PHP variable;
                 $firstName = 'Rams';
             ?>

             <span>Using a PHP variable:</span> <br /><br />

             <?php
                 echo 'The Colorado State ' . $firstName . '<br />';

                 // Check the syntax differnce when double quotes(") are used

                 echo "The Colorado State $firstName";
             ?>

             <br /><br />

             <?php
                 $city = 'Fort Collins';
             ?>

             <span>More functions:</span> <br /><br />

             <?php
                 echo 'Your city in uppercase: ' . strtoupper($city) . '<br />';
                 echo 'Your city in lowercase: ' . strtolower($city) . '<br />';
                 echo 'Your city in reverse: ' .   strrev($city) . '<br />';
                 echo 'Characters in your city name: ' . strlen($city) . '<br />';
                 echo 'Collins replaced with Wayne: ' . str_replace('Collins', 'Wayne', $city);
             ?>

             <br /><br />

             <span>Using a PHP constant:</span> <br /><br />

             <?php
                 define('MYQUOTE', '"Perplexity is the beginning of knowledge"');
                 echo MYQUOTE;
             ?>
         </p>
     </section>

 </body>
</html>
