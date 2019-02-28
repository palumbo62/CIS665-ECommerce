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
       Assignment:    PHP-HOE2
       Name:          Robert Palumbo
       Due Date:      2.26.2019 @ 11:59pm

       PHP - Hands-on-Exercise 2

       Web page to display Big Mac Price information

       Filename: PHPHOE2WP.php
    -->
        <meta charset="UTF-8">
        <title></title>        <meta charset="UTF-8">
        <title>PHP-HOE2 Big Mac Pricing</title>
    </head>
    <body>
        <?php
        // put your code here
        require_once ("..\mySiteCommon.php");
 
        // call the displayPageHeader method in siteCommon.php
        
        displayPageHeader('Big Mac Pricing by Country');

        echo '<section>';

        $bigMacInfo = array('South Africa'=>1.77,
                            'United States'=> 4.93, 
                            'Ukraine'=> 1.54,
                            'Australia'=> 3.74,
                            'China'=> 2.72,
                            'Denmark'=> 4.32,
                            'New Zealand'=> 3.91,
                            'Ireland'=> 4.25,
                            'United Kingdom'=> 4.22,
                            'Israel'=> 4.29
                            );
        
        echo
        '<table>
            <thead>
                <tr>
                    <th>Country</th>
                    <th>Local Big Mac Price</th>
                </tr>
            </thead>
            <tbody>';

        // foreach loop
        $sum = 0;
        foreach ($bigMacInfo as $bigMacCountry => $bigMacPrice) {
            $sum += $bigMacPrice;
            echo
            '<tr>
                <td>'  . $bigMacCountry . '</td>
                <td>$' . $bigMacPrice . '</td>
            </tr>';
        }

        echo  '</tbody> </table> </section>';
        $avgPrice = $sum / count($bigMacInfo);
//        echo "$sum," .  count($bigMacInfo) . ", $avgPrice";
        
        echo '<hr /><body><p style="text-indent: 5em;">Average Price of a Big Mac=> $' . $avgPrice . '</p></body>';
        
        $keys = array_keys($bigMacInfo);
        $closestToAvg = $bigMacInfo[$keys[0]]; 
        $closestToAvgCountry = $keys[0];
 
//        for ($i=0; $i < count($bigMacInfo); $i++) {
//            echo "array $i: Country: $keys[$i]  Price: " . $bigMacInfo[$keys[$i]] . "<br />";
//        }
        
        for ($i=1; $i < count($bigMacInfo); $i++) {
           $nextPrice = $bigMacInfo[$keys[$i]];
//           echo "old-closest=$closestToAvg  next-price=$nextPrice<br />";
           $nextClosest = abs($nextPrice - $avgPrice);
           $currClosest = abs($closestToAvg - $avgPrice);
           
           if ($nextClosest < $currClosest) {
//                echo "Swapping:  old-closest=$closestToAvg  new-closest=" . $nextPrice . "  curr: $currClosest  next: $nextClosest<br />";
                $closestToAvg = $nextPrice;
                $closestToAvgCountry = $keys[$i];
             }
        }
        
        echo '<hr /><p style="text-indent: 5em;">Closest Price to the Average:  Country=> ' . $closestToAvgCountry .
                '    Price=> $' . $closestToAvg . '</p>';
        
//        echo "<pre> ";
//        print_r($bigMacInfo);
//        echo "</pre>";
        displayPageFooter('PHP-HOE2');

        ?>
     </body>
</html>
