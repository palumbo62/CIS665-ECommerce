<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // put your code here
        echo "Look Ma, I can code in PHP";
        echo "<br /><br />";
        
        // declare variables, always starts with $ followed by _ or letter
        $favBook  = "Wuthering Heights";
        echo "Your favorit book is $favBook";
        
        // single quote reference
        echo "<br /><br />";
        echo 'this is a test $favBook';
        
        // escaping double quotes
//        echo "To use a quote you must escape it "\";
        echo "To quote u must escape, \"$favBook is the best novel I have read!\"";
        
        // heredoc syntax to create our own delimiter
        echo "<br /><br />";
        $output = <<<ABC
                To quote, "$favBook is the best novel of all time!"
ABC;
        echo $output;

        // declare a constant
        define('MYQUOTE', 'Change is Hard');
        echo "<br /><br />";
        echo MYQUOTE;
        
        // use built in methods
        // reference PHP.net
        echo "<br /><br />";
        // repeat 5 times  with concatenation '.'
        echo str_repeat('I will not resist the future' . '<br /> at any time', 5);
        
        // the concatentation operation (.) is a problem for referencing object
        // properties so PHP has to use a different operator
        
        // declare an array, initialize it as needed 
        // PHP supports index and associative array
        // Index starts a 0 (0,1,2...)
        // Associative allows you to create your own index reference
        $starBucks = array(3.20, 5.95, 7.89);
        echo "<br /><br />";
        echo "Price for the GRANDE is $starBucks[1]";
      
        //
        $coffeePrices = array ('tall'=>3.20, 'grande'=>5.95, 'venti'=>7.89);
        echo "<br /><br />";
        echo "Price for Venti is:  {$coffeePrices['venti']}";

        // Loops
        echo "<br /><br />";
        foreach ($coffeePrices as $aprice) {
            echo "Entry: {$aprice} <br />";
        }
        
        echo "Price for Venti is:  {$coffeePrices['venti']}  yes";
        ?>
    </body>
</html>
