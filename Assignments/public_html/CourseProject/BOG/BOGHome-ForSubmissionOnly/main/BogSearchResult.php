<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

     session_start();

    require_once ("..\phpCommon\BogSiteCommon.php");
    require_once ("..\sqlCommon\bogSql.php");

    echo '<section>';

    // the session array element "userInfo" will be set (see d10loginform.php) if the user has been authenticated

    $userId = (isset($_SESSION['userInfo']))? $_SESSION['userInfo']['userId'] : "";   

    if (!empty($userId)) {
        $tag = "UserID='$userId' Rent Property - page needs work!";
    } else {
        $tag = "UserID NOT Set";
    }

    displayPageHeader("../cssStyles/BOG_Style_Layout_All.css", $tag);
// $_POST is an associative array of the values passed via the HTTP POST method
 
$proptype = $_POST['PropertyTypeT'];
$city = $_POST['City'];
$state = $_POST['State'];
$zipcode = $_POST['Zipcode'];

// remove any potentially malicious characters
$protype = preg_replace("/[^a-zA-Z0-9\s]/", '', $namelast);
$city = preg_replace("/[^a-zA-Z0-9\s]/", '', $city);
$state = preg_replace("/[^a-zA-Z0-9\s]/", '', $state);
$zipcode = preg_replace("/[^a-zA-Z0-9\s]/", '', $zipcode);

//Call the bogSearchPropProfsByLoc method

$rentalList = bogSearchPropProfsByLoc($propType, $city, $state, $zipcode);

// get a count of the number of rental listing returned by the method

$matchingRecords = count($rentalList);

echo "<section>";

if ($matchingRecords == 0)
{
   echo "<h3>No matches found for search term - '$proptype'</h3>";
}
else
{   
// prepare the output using heredoc syntax

$output = <<<ABC
<table>
   <caption>$matchingRecords Rental(s) found</caption>
   <tbody>
ABC;

   $lastNum = 0;
   foreach ($rentalList as $rental)
    {
        extract($rental);
        $lastNum ++;
        $output .= <<<ABC
        <tr>
            <td>$lastNum: $rental[PropertyTypeT]                
            <td> City:$rental[City]
            <td><td><td><td> State:$rental[State]               
            <td><td><td><td><td><td> ZipCode:$rental[Zipcode]  
            </td>
        </tr>
        
ABC;
    }
    
    $output .= "<tbody></table>";
}
$output .= <<<ABC
<p style="text-align: center">
    <a href="BogHome.php">[Back to Search Page]</a>
</p></section>
ABC;

// display the output

echo $output;


