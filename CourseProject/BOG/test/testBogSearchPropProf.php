<?php
/*
    Class:          CIS665
    Assignment:     Course Project 
    Team-115:       Robert Palumbo, Kiana Vigil, Valerie Duran
    Due Date:       5.7.2019 @ 11:59pm

    Filename:       testBogSearchProp.php
    
        PHP based web page used to test search for properties in the BOG
        database based upon the specified search criteria.

*/
    require_once ("..\phpCommon\BogSiteCommon.php");
    require_once ("..\sqlCommon\bogSql.php");

    displayPageHeader('BOG - Test testBogSearchPropProf()');

    echo '<section>';

    $propertyTypeID = 3;
    $address = '';
    $city = '';
    $state = ''; 
    $zipcode = '';
    $dailyPrice = 1000;
    $numBeds = '';
    $numBaths = '';
    $sqft = '';
    $guestCnt = '';

    // search for matching profiles
    $propProfiles = bogSearhcPropProfs($propertyTypeID, $address, $city, $state, 
                            $zipcode, $dailyPrice, $numBeds, $numBaths, 
                            $sqft, $guestCnt);

    if (($errCode = bogGetLastErrorCode()) != 0) {
        echo "Property profile search failed, err='$errCode'<br><br>";
    } else {
        if (count($propProfiles) == 0) {
            echo "No matching properties were found!<br><br>";
        } else {
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
            foreach ($propProfiles as $prop) {
                echo   '<tr>
                           <td>' . $prop['PropertyID.PK'] . '</td>
                           <td>' . $prop['PropertyTypeName'] . '</td>
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
