<?php
/*
    Class:          CIS665
    Assignment:     Course Project 
    Team-115:       Robert Palumbo, Kiana Vigil, Valerie Duran
    Due Date:       5.7.2019 @ 11:59pm

    Filename:       testBogLoginResults.php
    
        PHP based web page used to test logging into the BOG website by
        email address and password.

*/
    require_once ("testSiteCommon.php");
    require_once ("bogSql.php");

    displayPageHeader('BOG - testBogLoginResults()');

    echo '<section>';

    // call the getActorsList() method in d3sql.php

    $email = $_POST['emailAddr'];
    $password = $_POST['password'];
    
    $userProfile = bogLogin($email, $password);
    $roles = bogGetUserRoles();    
    
    //echo "email: $email   password: $password<br><br>";
    
    if (($errCode = bogGetLastErrorCode()) != 0) { 
         echo "Failed to retrieve user profile from database, err=$errCode<br><br>";
     } else if (count($userProfile) == 0) {
         echo "User profile for email address='$email' not found!<br><br>";
    } else if (count($userProfile) > 1) {
         echo "Multiple user profiles for email='$email' found!<br><br>";
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

        $roles = bogGetUserRoles();

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
?>

    <p style="text-align: center">
        <a href="testBogLogin.php">[Check another user account]</a>
    </p>

<?php

displayPageFooter('BOG');

?>
