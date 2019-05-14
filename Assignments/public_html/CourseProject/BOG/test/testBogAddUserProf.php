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
    require_once ("..\phpCommon\BogSiteCommon.php");
    require_once ("..\sqlCommon\bogSql.php");

    displayPageHeader('BOG - Test testBogAddUserProf()');

    echo '<section>';

    // call the getActorsList() method in d3sql.php

    $email = 'user16@bog.com';
    $password = 'password';
    $firstName = 'User1-First';
    $lastName = 'User1-Last';
    $address = '88457 N. Sante Fe';
    $city = 'Denver';
    $state = 'CO'; 
    $zipcode = 80301;
    $phoneNumber = 3035551000;
    $ccNumber = 888523443;
    $ccExpDate = '01/31/2022';
    $ccCvc = 877;

    // add the profile
    bogAddUserProf($email, $password, $firstName, $lastName, 
                    $address, $city, $state, $zipcode, $phoneNumber, 
                    $ccNumber, $ccExpDate, $ccCvc);

    if (($errCode = bogGetLastErrorCode()) != 0) {
        echo "User profile failed to be added to BOG database, err=$errCode";
    }
    else {
        $userId = bogGetLastInsertId();
        
        echo "GET USER PROFILE FOR LAST INSERT ID='$userId'<br>";
        
        $userProfile = bogGetUserProfById($userId);
        
        echo '<table id="UserProfiles">
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
                       <td>' . $user['CC.Number'] . '</td>
                       <td>' . $user['CC.ExpDate'] . '</td>
                       <td>' . $user['CC.Cvc'] . '</td>
                   </tr>';
        }
   
        echo "<pre>";
        print_r($userProfile);
        echo "</pre >";
    }
        
    echo  '</tbody> </table> </section>';
    
    // call the displayPageFooter method in mySiteCommon.php

    displayPageFooter('BOG');
?>
