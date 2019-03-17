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
    require_once ("testSiteCommon.php");
    require_once ("..\sqlCommon\bogSql.php");

    displayPageHeader('BOG - Test bogGetUserProfById()');

    echo '<section>';

    $userId = 47;
    $userProfile = bogGetUserProfByUserId($userId);

    $roles = bogGetUserRoles();
    print_r($roles);

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
            echo "<br><br>";
            print_r($user['RoleIdFK']-1);
            echo "<br><br>";
            print_r($roles[1]);
            echo "<br><br>";
            print_r($roles[1]['RoleName']);
            echo "<br><br>";
            $role = $roles[$user['RoleIdFK']-1]['RoleName'];
            print_r($role);
            echo "<br><br>";
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

    // call the displayPageFooter method in mySiteCommon.php

    displayPageFooter('BOG');
?>
