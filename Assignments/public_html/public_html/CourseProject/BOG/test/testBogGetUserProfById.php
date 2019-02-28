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

    displayPageHeader('BOG - Test bogAddUserProf()');

    echo '<section>';

    // call the getActorsList() method in d3sql.php

    $userId = 3;
    $userProfile = bogGetUserProfById($userId);

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
    

    // call the displayPageFooter method in mySiteCommon.php

    displayPageFooter('BOG');
?>
