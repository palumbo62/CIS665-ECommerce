<?php
/*
    Class:          CIS665
    Assignment:     Course Project 
    Team-115:       Robert Palumbo, Kiana Vigil, Valerie Duran
    Due Date:       5.7.2019 @ 11:59pm

    Filename:       testGetAllPropProf.php
    
        PHP based web page used to test retrieving all property profiles from 
        the database.

*/
    require_once ("testSiteCommon.php");
    require_once ("bogSql.php");

    displayPageHeader('BOG - Test bogGetAllPropProf()');

    echo '<section>';

    $propProfiles = bogGetAllPropProf();

    if (($errCode = bogGetLastErrorCode()) != 0) {
        echo "User profile failed to be added to BOG database, err='$errCode'";
    } else if (count($propProfiles) == 0) {
        echo "No property profiles found in database!<br><br>";
    }
    else {
        $propTypes = bogGetPropertyTypes();
        
        echo    '<table id="PropProfiles">
                    <thead>
                        <tr>
                            <th>PropId</th>
                            <th>Type</th>
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
                        </tr>
                    </thead>
                    <tbody>';

        // display the results
        
        foreach ($propProfiles as $prop) {
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
                       <td>' . $prop['SqFt'] . '</td>
                       <td>' . $prop['GuestCnt'] . '</td>
                       <td>' . $prop['Pic'] . '</td>
                   </tr>';
        }
        
        echo  '</tbody> </table> </section>';

//        echo "<pre>";
//        print_r($propProfiles);
//        echo "</pre >";
    }
    
    // call the displayPageFooter method in mySiteCommon.php

    displayPageFooter('BOG');
?>
