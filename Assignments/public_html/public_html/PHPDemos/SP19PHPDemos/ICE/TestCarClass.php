<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Test Car Class</title>
    </head>
    <body>
        <?php
        // put your code here
        // include the car class
        include "Car.php";
        $myCar = new Car("Suburu", "Impreza");
        
        echo $myCar->make;
        echo $myCar->model;
        
        echo "<br /><br /><pre>";
        
        print_r($myCar);
        
        echo "</pre>";
        
        while ($myCar->accelerat()) {
            echo "Speeding up..." . $myCar->getSpeed() . " mph<br />";
        }
        
        // Call static method
        echo "<br /><br />";
        echo Car::calcMpg(600, 15);
        ?>
    </body>
</html>
