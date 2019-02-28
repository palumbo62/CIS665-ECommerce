<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>PHP Demo to Access SQL Database</title>
    </head>
    <body>
        <?php
        // put your code here
        
        echo "<br /><br />";
        
        // Create connection object, refer to PDO link Week 5 module
        $conn = new PDO("sqlsrv:Server=buscissql1601\cisweb; Database=RWStudios",
                "csu", "rams");
        
        // next create statement object and execute a query
        $stmt = $conn->query("select movietitle, summary from film");
        
        // create a results array - this creates key/value associative array
        // column name is key, column value is value
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo "<pre>";
        print_r($results);
        echo "</pre>";
 
        // display just the titles
        foreach ($results as $film) {
            echo "Film Title: " . $film['movietitle'];
            echo "<br />";
        }
        
        ?>
     </body>
</html>
