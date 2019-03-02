<?php
/*
    Class:          CIS665
    Assignment:     Course Project 
    Team-115:       Robert Palumbo, Kiana Vigil, Valerie Duran
    Due Date:       5.7.2019 @ 11:59pm

    Filename:       testBogLogin.php
    
        PHP based web page used to test logging into the BOG website by
        email address and password.

*/
    require_once ("..\phpCommon\BogSiteCommon.php");
    require_once ("..\sqlCommon\bogSql.php");

    displayPageHeader('BOG - Test bogLogin()');

    echo '<section>';

    // call the getActorsList() method in d3sql.php

    $email = 'admin@bog.com';
    $password = 'admin';
    $userProfile = bogLogin($email, $password);
    
    if (($errCode = bogGetLastErrorCode()) != 0) { 
         echo "Failed to retrieve user profile from database, err=$errCode<br><br>";
     } else if (count($userProfile) == 0) {
         echo "User profile for email='$email' not found!<br><br>";
    } else if (count($userProfile) > 1) {
         echo "Multiple user profiles for email='$email' found!<br><br>";
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
                       <td>' . $user['CC.Number'] . '</td>
                       <td>' . $user['CC.ExpDate'] . '</td>
                       <td>' . $user['CC.Cvc'] . '</td>
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
