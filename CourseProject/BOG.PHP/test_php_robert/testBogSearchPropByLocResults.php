<?php
/*
    Class:          CIS665
    Assignment:     Course Project 
    Team-115:       Robert Palumbo, Kiana Vigil, Valerie Duran
    Due Date:       5.7.2019 @ 11:59pm

    Filename:       testBogSearchPropProfByLocResaults.php
    
        Property search by location results page.
*/
    require_once ("testSiteCommon.php");
    require_once ("bogSql.php");

    displayPageHeader('BOG - Test testBogSearchPropProfByLocResults()');

    echo '<section>';

    $propType = isset($_POST['propType']) ? $_POST['propType'] : '';
    $propCity = isset($_POST['propCity']) ? $_POST['propCity'] : '';
    $propState = isset($_POST['propState']) ? $_POST['propState'] : '';
    $propZip = isset($_POST['propZip']) ? $_POST['propZip'] : '';

    //echo "<br>Type=$propType  City=$propCity  State=$propState  Zip=$propZip<br>";
    
    // search for matching profiles
    $propProfs = bogSearchPropProfsByLoc($propType, $propCity, $propState, $propZip);

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
            
//            echo "<pre>";
//            print_r($propProfs);
//            echo "</pre >";
        }
    }   
?>
<p style="text-align: center">
    <a href="testBogSearchPropByLoc.php">[Back to Search Page]</a>
</p>

<?php
    displayPageFooter('BOG');
?>
