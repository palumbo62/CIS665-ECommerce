<?php
/*
    Class:          CIS665
    Assignment:     Course Project 
    Team-115:       Robert Palumbo, Kiana Vigil, Valerie Duran
    Due Date:       5.7.2019 @ 11:59pm

    Filename:       testGetPropProfById.php
    
        PHP based web page used to test retrieving a property profile from the
        database by property Id.

*/
    require_once ("..\phpCommon\BogSiteCommon.php");
    require_once ("..\sqlCommon\bogSql.php");

    displayPageHeader('BOG - Test bogGetPropProfById()');

    echo '<section>';

    $propId = 5;
    $propProfile = bogGetPropProfById($propId);

    if (($errCode = bogGetLastErrorCode()) != 0) { 
        echo "Failed to retrieve property profile from database, err='$errCode'<br><br>";
    } else if (count($propProfile) == 0) {
        echo "Property profile for propId='$propId' not found!<br><br>";
    } else if (count($propProfile) > 1) {
         echo "Multiple property profiles for propId='$propId' found!<br><br>";
    } else {
        echo    '<table id="PropProfiles">
                    <thead>
                        <tr>
                            <th>ProdId</th>
                            <th>PropTypeId</th>
                            <th>Addr</th>
                            <th>City</th>
                            <th>State</th>
                            <th>Zip</th>
                            <th>Price</th>
                            <th>#Beds</th>
                            <th>#Baths</th>
                            <th>Sqft</th>               
                            <th>#Guest</th>               
                            <th>Pic</th>               
                            <th>Type</th>               
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
                       <td>' . $prop['SqFt'] . '</td>
                       <td>' . $prop['GuestCnt'] . '</td>
                       <td>' . $prop['Pic'] . '</td>
                       <td>' . $prop['PropertyTypeName'] . '</td>
                   </tr>';
        }

        echo  '</tbody> </table> </section>';

        echo "<pre>";
        print_r($propProfile);
        echo "</pre >";
    }
    
    // call the displayPageFooter method in mySiteCommon.php

    displayPageFooter('BOG');
?>
