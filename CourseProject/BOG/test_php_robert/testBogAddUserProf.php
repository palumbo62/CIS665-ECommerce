<?php
/*
    Class:          CIS665
    Assignment:     Course Project 
    Team-115:       Robert Palumbo, Kiana Vigil, Valerie Duran
    Due Date:       5.7.2019 @ 11:59pm

    Filename:       testBogAddUserProf.php
    
        PHP based web page used to test adding a new user profile to the
        database.

*/
    require_once ("testSiteCommon.php");
    require_once ("bogSql.php");

    displayPageHeader('BOG - Test testBogAddUserProf()');

    echo '<section>';

    $roleType = 2;
    $email = 'aa@gmail.com';
    $password = '1234';
    $firstName = 'user';
    $lastName = 'user5';
    $address = 'Unknown';
    $city = 'Denver';
    $state = 'CO'; 
    $zipcode = 80301;
    $phoneNumber = 8005551234;
    $ccNumber = -1;
    $ccExpDate = '';
    $ccCvc = -1;

    // add the profile
    bogAddUserProf($roleType, $email, $password, $firstName, $lastName, 
                    $address, $city, $state, $zipcode, $phoneNumber, 
                    $ccNumber, $ccExpDate, $ccCvc);

    if (($errCode = bogGetLastErrorCode()) != 0) {
        echo "User profile failed to be added to BOG database, err'$errCode'";
    } else {
        if (($userId = bogGetLastInsertId()) == -1) {
            echo "User profile failed to be added to database!<br><br>";
        } else {
            $userProfile = bogGetUserProfByUserId($userId);
            $roles = bogGetUserRoles();

            echo '<table id="UserProfiles">
                    <thead>
                        <tr>
                            <th>UserID</th>
                            <th>RoleID</th>
                            <th>RoleName</th>
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
                           <td>' . $user['UserIdPK'] . '</td>
                           <td>' . $user['RoleIdFK'] . '</td>
                           <td>' . $roles[$user['RoleIdFK']-1]['RoleName'] . '</td>
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
     }
        
    // call the displayPageFooter method in mySiteCommon.php

    displayPageFooter('BOG');
?>
