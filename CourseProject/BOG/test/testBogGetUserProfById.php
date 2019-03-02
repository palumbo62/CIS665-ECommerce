<?php
/*
    Class:          CIS665
    Assignment:     Course Project 
    Team-115:       Robert Palumbo, Kiana Vigil, Valerie Duran
    Due Date:       5.7.2019 @ 11:59pm

    Filename:       testGetUserProfById.php
    
        PHP based web page used to test retrieving a user profile from the
        database by user Id.

*/
    require_once ("..\phpCommon\BogSiteCommon.php");
    require_once ("..\sqlCommon\bogSql.php");

    displayPageHeader('BOG - Test bogGetUserProfById()');

    echo '<section>';

    $userId = 2;
    $userProfile = bogGetUserProfById($userId);

    if (($errCode = bogGetLastErrorCode()) != 0) { 
        echo "Failed to retrieve user profile from database, err='$errCode'<br><br>";
    } else if (count($userProfile) == 0) {
        echo "User profile for userId='$userId' not found!<br><br>";
    } else if (count($userProfile) > 1) {
         echo "Multiple property profiles for userId='$userId' found!<br><br>";
    } else {
        echo    '<table id="UserProfiles">
                    <thead>
                        <tr>
                            <th>UserID</th>
                            <th>Email</th>
                            <th>FName</th>
                            <th>LName</th>
                            <th>Addr</th>
                            <th>City</th>
                            <th>State</th>
                            <th>Zip</th>
                            <th>Phone#</th>
                            <th>CC#</th>
                            <th>ExpDate</th>
                            <th>CVC</th>               
                        </tr>
                    </thead>
                    <tbody>';

        // display the results

        foreach ($userProfile as $user) {
            echo   '<tr>
                       <td>' . $user['UserID.PK'] . '</td>
                       <td>' . $user['Email'] . '</td>
                       <td>' . $user['FirstName'] . '</td>
                       <td>' . $user['LastName'] . '</td>
                       <td>' . $user['Address'] . '</td>
                       <td>' . $user['City'] . '</td>
                       <td>' . $user['State'] . '</td>
                       <td>' . $user['Zipcode'] . '</td>
                       <td>' . $user['PhoneNumber'] . '</td>
                       <td>' . $user['CCNumber'] . '</td>
                       <td>' . $user['CCExpDate'] . '</td>
                       <td>' . $user['CCCvc'] . '</td>
                   </tr>';
        }

        echo  '</tbody> </table> </section>';

        echo "<pre>";
        print_r($userProfile);
        echo "</pre >";
    }

    // call the displayPageFooter method in mySiteCommon.php

    displayPageFooter('BOG');
?>
