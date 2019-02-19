<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
    <!--
       Class:         CIS665
       Assignment:    PHP-HOE1
       Name:          Robert Palumbo
       Due Date:      2.21.2019 @ 11:59pm

       PHP - Hands-on-Exercise 1

       Strings and functions

       Filename: PHPHOE1.php
    -->
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // put your code here
        
        // Step 1. 
        // create $var1, assign value, display value
        $var1 = 'CIS665 - EBusiness Applications!!!';

        echo "<br /><br />";
        echo '$var1::   '. $var1;
        
        // Concatenate 1st 3 and last 3 characters, assign to $var2 and display value
        $var2 = substr($var1, 0, 3) . substr($var1, strlen($var1) - 3, 3);

        echo "<br /><br />";
        echo '$var2::   ' . $var2;
        
        // Step 2.
        // Create a function that concatenates first or last name to the 1st 3
        // or last 3 characters of the input string based on whether its length
        // is even or odd.
        include("fnNameConcat.php");
 
        // Step 3.
        // Assign $var3 string of length 10, call function, display result
        $var3 = 'This is 10';

        echo "<br /><br />";
        echo '$var3::   ' . $var3;
        echo "<br /><br />";
        echo 'concat::  ' . fnNameConcat($var3);

       // Assign $var4 string of length 13, call function, display result
        $var4 = 'This is a -13';
        echo "<br /><br />";
        echo '$var4::   ' . $var4;
        echo "<br /><br />";
        echo 'concat::  ' . fnNameConcat($var4);

        ?>
    </body>
</html>
