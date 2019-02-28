<?php
/*
    Class:         CIS665
    Assignment:    PHP-HOE3
    Name:          Robert Palumbo
    Due Date:      2.28.2019 @ 11:59pm

    PHP - Hands-on-Exercise 3

    Retrieve and display all the actors (NameFirst, NameLast, Age and Gender) 
    in the RWStudios database. 
 
    Filename: PHPHOE3WP.php
*/

require_once ("..\mySiteCommon.php");
require_once ("d3Sql.php");

// call the displayPageHeader method in mySiteCommon.php

displayPageHeader('RWStudios Actor List');

echo '<section>';

// call the getActorsList() method in d3sql.php

$ActorsList = getActorsList();

echo    '<table>
            <thead>
                <tr>
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th>Age</th>
                    <th>Gender</th>
                </tr>
            </thead>
            <tbody>';

// use a loop to display the results
foreach ($ActorsList as $actor) {
     echo   '<tr>
                <td>' . $actor['NameLast'] . '</td>
                <td>' . $actor['NameFirst'] . '</td>
                <td>' . $actor['Age'] . '</td>
                <td>' . $actor['Gender'] . '</td>
            </tr>';
}

echo  '</tbody> </table> </section>';

// call the displayPageFooter method in mySiteCommon.php

displayPageFooter('PHP-HOE3');

?>
