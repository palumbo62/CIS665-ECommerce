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
    </head>
    <body>
        <?php
        // put your code here
        $coffeePrices = array('tall'=>2.34, 'grande'=> 3.67, 'venti'=> 4.33);
        // foreach loop
        foreach ($coffeePrices as $aPrice) {
            echo "Price: $aPrice <br />";
        }
        
        // Display key and value
        echo "<br /><br />";
        foreach ($coffeePrices as $aSize => $aPrice) {
            echo "Size: $aSize  Price: $aPrice <br />";
        }

        // Display contents of object using print_r
        echo "<br /><br />";
        echo "<pre>";  //html pre tag to well format the output
        print_r($coffeePrices);
        echo "</pre>";

        //'include' file with function
        //can use 'require' and will throw and error if not found
        include ("fnDemo.php");
        echo "<br /><br />";
        echo multiplyTwoNumbers(34, 35);
        
        //if statements
        echo "<br /><br />";
        $starSign = "Aquarius";
        if ($starSign == "Aries") {
            echo 'You are the greatest';
        }
        elseif ($starSign == "Gemini") {
            echo 'Your are rich';
        }
        elseif ($starSign == "Libra") {
            echo 'You are social';
        }
        else {
            echo 'You are smart';
        }
        
        //switch statement
        echo "<br /><br />";
        
        $starSign = "Saggitarius";
        switch ($starSign){
            case "Aquarius":
                echo "You are Aquarius";
                break;
            case "Aries":
                echo "You are Aries";
                break;
            case "Gemini":
                echo "You are Gemini";
                break;
            case "Libra":
                echo "You are Libra";
                break;
            default:
                echo "You are Nothing";
        }
        
        echo "<br /><br />";
        ?>
    </body>
</html>
