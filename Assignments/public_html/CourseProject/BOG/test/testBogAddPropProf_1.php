<?php
/*
    Class:          CIS665
    Assignment:     Course Project 
    Team-115:       Robert Palumbo, Kiana Vigil, Valerie Duran
    Due Date:       5.7.2019 @ 11:59pm

    Filename:       testBogAddProp.php
    
        PHP based web page used to test adding a new property profile to the
        database.

*/
    require_once ("..\phpCommon\BogSiteCommon.php");
    require_once ("..\sqlCommon\bogSql.php");

    displayPageHeader('BOG - Test testBogAddPropProf()');

    echo '<section>';

    $propertyType = 3;
    $address = '2815 Coyote Drive';
    $city = 'Duluth';
    $state = 'MN'; 
    $zipcode = 55816;
    $dailyPrice = 150;
    $numBedrooms = 1;
    $numBathrooms = 1;
    $sqft = 700;
    $guestCnt = 2;
    $pic = null;

    // add the profile
    bogAddPropProf($propertyType, $address, $city, $state, $zipcode,
                    $dailyPrice, $numBedrooms, $numBathrooms, $sqft,
                    $guestCnt, $pic);

    if (($errCode = bogGetLastErrorCode()) != 0) {
        echo "Property profile FAILED to be added to BOG database, err='$errCode'";
    } else {
        if (($propId = bogGetLastInsertId()) == -1) {
            echo "Property profile failed to be added to database!<br><br>";
        } else {
            $propProfile = bogGetPropProfById($propId);

            echo    '<table id="PropProfiles">
                        <thead>
                            <tr>
                                <th>PropID</th>
                                <th>PropType</th>
                                <th>Address</th>
                                <th>City</th>
                                <th>State</th>
                                <th>Zip</th>
                                <th>$ / Day</th>
                                <th>#Beds</th>
                                <th>#Baths</th>
                                <th>Sqft</th>
                                <th>#Guests</th>
                                <th>Image</th>
                            </tr>
                        </thead>
                        <tbody>';

            // display the results
            foreach ($propProfile as $prop) {
                echo   '<tr>
                           <td>' . $prop['PropertyID.PK'] . '</td>
                           <td>' . $prop['PropertyTypeID.FK'] . '</td>
                           <td>' . $prop['Address'] . '</td>
                           <td>' . $prop['City'] . '</td>
                           <td>' . $prop['State'] . '</td>
                           <td>' . $prop['Zipcode'] . '</td>
                           <td>' . $prop['DailyPrice'] . '</td>
                           <td>' . $prop['NumBedrooms'] . '</td>
                           <td>' . $prop['NumBathrooms'] . '</td>
                           <td>' . $prop['Sqft'] . '</td>
                           <td>' . $prop['GuestCnt'] . '</td>
                           <td>' . $prop['Pic'] . '</td>
                       </tr>';
            }            
            
            echo  '</tbody> </table> </section>';
            
            echo "<pre>";
            print_r($propProfile);
            echo "</pre >";
        }
    }   
    
    displayPageFooter('BOG');
?>
