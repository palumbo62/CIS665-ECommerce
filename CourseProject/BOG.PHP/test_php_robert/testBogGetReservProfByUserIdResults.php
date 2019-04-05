<?php
/*
    Class:          CIS665
    Assignment:     Course Project 
    Team-115:       Robert Palumbo, Kiana Vigil, Valerie Duran
    Due Date:       5.12.2019 @ 11:59pm

    Filename:       testBogGetReservByUserIdResults.php
    
        Display the results for reservations made by a specific user.

*/
    require_once ("testSiteCommon.php");
    require_once ("bogSql.php");
    
    displayPageHeader('BOG - testBogGetReservByUserIdResults()');

    echo '<section>';

    // call the getActorsList() method in d3sql.php

    $userid = $_POST['userid'];
    $reservProfs = bogGetReservProfsByUserId($userid);
    
        foreach ($reservProfs as $prof) {
            echo "PROF= '$prof'<br><br>";
        }
    if (($errCode = bogGetLastErrorCode()) != 0) { 
         echo "Failed to retrieve user reservations from database, err=$errCode<br><br>";
     } else if (count($reservProfs) == 0) {
         echo "No reservations found for user id='$userid'!<br><br>";
    } else {
        echo    '<table id="UserProfiles">
                    <thead>
                        <tr>
                            <th>UserID</th>
                            <th>PropID</th>
                            <th>FName</th>
                            <th>LName</th>
                            <th>Addr</th>
                            <th>City</th>
                            <th>State</th>
                            <th>Zip</th>
                            <th>CheckIn</th>
                            <th>CheckOut</th>
                            <th>Payment</th>               
                            <th>GuestCnt</th>               
                        </tr>
                    </thead>
                    <tbody>';

        // display the results

        foreach ($reservProfs as $prof) {
            echo   '<tr>
                        <td>' . $prof['UserID.PK'] . '</td>
                        <td>' . $prof['PropertyID.PK'] . '</td>
                        <td>' . $prof['FirstName'] . '</td>
                        <td>' . $prof['LastName'] . '</td>
                        <td>' . $prof['Address'] . '</td>
                        <td>' . $prof['City'] . '</td>
                        <td>' . $prof['State'] . '</td>
                        <td>' . $prof['Zipcode'] . '</td>
                        <td>' . $prof['CheckIn'] . '</td>
                        <td>' . $prof['CheckOut'] . '</td>
                        <td>' . $prof['TotalPayment'] . '</td>
                        <td>' . $prof['GuestCnt'] . '</td>
                   </tr>';
        }
        
        echo  '</tbody> </table> </section>';

        echo "<pre>";
        print_r($prof);
        echo "</pre >";
    }
?>

    <p style="text-align: center">
        <a href="testBogGetReservProfByUserId.php">[Check another user account]</a>
    </p>

<?php

displayPageFooter('BOG');

?>
