<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>PHP - Language Basics</title>
        <style>
            body
            {
                font-size:xx-large;
                width: 75%;
                margin: 10px auto;
            }
        </style>
    </head>
    <body>
        <?php
        // put your code here
        echo "Look Ma, I can code in PHP!";
        echo "<br /><br />";
        //declare variables
        $myFavBook = "Wuthering Heights";
        echo "Ankit, your favorite book is $myFavBook";
        //single quotes
        echo "<br /><br />";
        echo 'Ankit, your favorite author is $myFavBook';
        //concatenation
        echo "<br /><br />";
        echo 'Ankit, your favorite author is ' . $myFavBook;
        //escaping double quotes
        echo "<br /><br />";
        echo "To quote Ankit, \"$myFavBook is my all time favorite book\"";
        //heredoc syntax
        echo "<br /><br />";
        $output = <<<ABC
         To quote Ankit, "$myFavBook is a classic read; a novel for the ages!"
ABC;
        echo $output;
        //constants
        define('SHAWQUOTE', 'Those who cannot change their minds cannot change anything');
        echo "<br /><br />";
        echo SHAWQUOTE;
        //use a built-in function
        echo "<br /><br />";
        echo str_repeat('I will not resist the future' . '<br />', 20);
        //array
        $beanCounter = array(5.69, 7.49, 9.21);
        echo "<br /><br />";
        echo "The price of a large coffee is $beanCounter[1]";
        //associative array
        $coffeeePrices = array('tall'=> 2.34, 'grande'=> 3.67, 'venti'=> 4.33);
        //foreach loop
        echo "<br /><br />";
        foreach ($coffeeePrices as $aPrice)
        {
            echo $aPrice . "<br />";
        }
        echo "<br /><br />";
        foreach ($coffeeePrices as $aSize => $aPrice)
        {
            echo $aSize . " " . $aPrice . "<br />";
        }
        //print_r function
        echo "<br /><br />";
        echo "<pre>";
        print_r($coffeeePrices);
        echo "</pre>";
        //include file with function
        include ("fnDemo.php");
        echo "<br /><br />";
        echo multiplyTwoNumbers(34, 56);
        // if statements
        echo "<br /><br />";
        $starSign = "Aquarius";
        if ($starSign == "Aries")
        {
            echo 'You are the greatest';
        }
        elseif ($starSign == "Gemini")
        {
            echo 'You are rich';
        }
        elseif ($starSign == "Libra")
        {
            echo 'You are social';
        }
        else
        {
            echo 'You are smart';
        }
        //switch statement
        echo "<br /><br />";
        switch ($starSign)
        {
           case "Tarus":
               echo "Stay in bed";
               break;
           case "Aquarius":
               echo "Keep clear of buscisweb01";
               break;
           default:
               echo "Run like hell";
        }
        ?>
    </body>
</html>
