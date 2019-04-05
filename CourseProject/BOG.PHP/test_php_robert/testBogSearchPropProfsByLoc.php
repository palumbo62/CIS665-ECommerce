<?php
/*
    Class:          CIS665
    Assignment:     Course Project 
    Team-115:       Robert Palumbo, Kiana Vigil, Valerie Duran
    Due Date:       5.7.2019 @ 11:59pm

    Filename:       testBogSearchPropProfByLocResults.php
    
        PHP based web page used to test search for properties in the BOG
        database based upon the specified search criteria.

*/
    require_once ("testSiteCommon.php");
    require_once ("bogSql.php");

    displayPageHeader('BOG - Test testBogSearchPropProfByLoc()');

    echo '<section>';

    $propType = '';
    $city = '';
    $state = 'CO'; 
    $zipcode = '';

    // search for matching profiles
    $propProfs = bogSearchPropProfsByLoc($propType, $city, $state, $zipcode);

    if (($errCode = bogGetLastErrorCode()) != 0) {
        echo "Property profile search failed, err='$errCode'<br><br>";
    } else {
        if (count($propProfs) == 0) {
            echo "No matching properties were found!<br><br>";
        } else {
            $propTypes = bogGetPropertyTypes();
            
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
            foreach ($propProfs as $prop) {
                echo   '<tr>
                           <td>' . $prop['PropertyIdPK'] . '</td>
                           <td>' . $propTypes[$prop['PropertyTypeIdFK']-1]['PropertyTypeName'] . '</td>
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
            print_r($propProfs);
            echo "</pre >";
        }
    }   
    
    displayPageFooter('BOG');
?>
