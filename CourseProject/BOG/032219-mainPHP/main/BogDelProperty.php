<?php
/* 
    Class:          CIS665
    Assignment:     Course Project 
    Team-115:       Robert Palumbo, Kiana Vigil, Valerie Duran
    Due Date:       5.24.2019 @ 11:59pm

    Filename:       BogDelProperty.php
    
        Main entry point to the BOG Admin delete property management page
*/ 
    // this method call should be placed at the start (top) of every php file that uses session variables

    session_start();

    require_once ("..\phpCommon\BogSiteCommon.php");
    require_once ("..\sqlCommon\bogSql.php");

    echo '<section>';

    // the session array element "userInfo" will be set (see d10loginform.php) if the user has been authenticated

    $userId = (isset($_SESSION['userInfo']))? $_SESSION['userInfo']['userId'] : "";   
    $roleType = (isset($_SESSION['userInfo']))? $_SESSION['userInfo']['roleType'] : "";   
    
    // Must be ADMIN to manage property
    if (($roleType != 1) || empty($userId)) {
        alertRedirect(3, 'BogHome.php', 
                     'Must be Admin to delete properties.  You will now be redirected to our Home page.');
    }
    
    $proptype = $_POST['proptype'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zipcode = $_POST['zipcode'];
    
    // remove any potentially malicious characters
    $city = preg_replace("/[^a-zA-Z0-9\s]/", '', $city);
    $zipcode = preg_replace("/[^a-zA-Z0-9\s]/", '', $zipcode);

    //Call the bogSearchPropProfsByLoc method

    $displayListings = bogSearchPropProfsByLoc($proptype, $city, $state, $zipcode);
    
    //var_dump($displayListings);
    if (empty($displayListings)) {
        alertRedirect(3, 'BogDelProperty.php',
                "No properties found with the specified search criteria.  Please try again!");
    }

    $tag = "Delete Property Listings";
    
    displayPageHeader("..\cssStyles\BOG_Style_Layout_All.css", $tag);
    displayDelPropertyPage();
?>
    <!-- Banner -->
    <section id="bannerList">
        <h2>Narrow your seach here</h2>

        <!----------Search form inside banner ----------- -->
        <div class="SearchState">
            <form  action="BogDelProperty.php" method = "post" >
                <label for="proptype" >Property Type:</label>
                <!--dynamic menu option for property type-->
                <select name="proptype" id="proptype" >
                    <?php
                        $propMenu = '<option value="" disabled selected>Property Type</option>;';
                        $proptypes = bogGetPropertyTypes();

                        foreach ($proptypes as $pt) {
                            extract($pt);
                            $selected = ($proptype == $PropertyTypeIdPK) ? ' selected ' : '';
                            $propMenu .= "<option value=" . $PropertyTypeIdPK . " $selected >$PropertyTypeName</option>";
                        }
                        echo "$propMenu<br>";
                    ?>
                </select>

                <label for="city" >City:</label>
                <input type="text" placeholder="City" name="city"
                       value="<?php echo $city?>"> 
            
                <label for="state">State:</label>
                <select id="state" name="state"
                        title="Select state">
                    <!--<option value=""></option>-->
                    <option value="" disabled selected><?php echo (empty($state)) ? 'Select State' : $state?></option>
                    <option value="AL" <?php echo ($state == 'AL' ? 'selected' : '');?>>Alabama</option>
                    <option value="AK" <?php echo ($state == 'AK' ? 'selected' : '');?>>Alaska</option>
                    <option value="AZ" <?php echo ($state == 'AZ' ? 'selected' : '');?>>Arizona</option>
                    <option value="AR" <?php echo ($state == 'AR' ? 'selected' : '');?>>Arkansas</option>
                    <option value="CA" <?php echo ($state == 'CA' ? 'selected' : '');?>>California</option>
                    <option value="CO" <?php echo ($state == 'CO' ? 'selected' : '');?>>Colorado</option>
                    <option value="CT" <?php echo ($state == 'CT' ? 'selected' : '');?>>Connecticut</option>
                    <option value="DE" <?php echo ($state == 'DE' ? 'selected' : '');?>>Delaware</option>
                    <option value="DC" <?php echo ($state == 'DC' ? 'selected' : '');?>>District Of Columbia</option>
                    <option value="FL" <?php echo ($state == 'FL' ? 'selected' : '');?>>Florida</option>
                    <option value="GA" <?php echo ($state == 'GA' ? 'selected' : '');?>>Georgia</option>
                    <option value="HI" <?php echo ($state == 'HI' ? 'selected' : '');?>>Hawaii</option>
                    <option value="ID" <?php echo ($state == 'ID' ? 'selected' : '');?>>Idaho</option>
                    <option value="IL" <?php echo ($state == 'IL' ? 'selected' : '');?>>Illinois</option>
                    <option value="IN" <?php echo ($state == 'IN' ? 'selected' : '');?>>Indiana</option>
                    <option value="IA" <?php echo ($state == 'IA' ? 'selected' : '');?>>Iowa</option>
                    <option value="KS" <?php echo ($state == 'KS' ? 'selected' : '');?>>Kansas</option>
                    <option value="KY" <?php echo ($state == 'KY' ? 'selected' : '');?>>Kentucky</option>
                    <option value="LA" <?php echo ($state == 'LA' ? 'selected' : '');?>>Louisiana</option>
                    <option value="ME" <?php echo ($state == 'ME' ? 'selected' : '');?>>Maine</option>
                    <option value="MD" <?php echo ($state == 'MD' ? 'selected' : '');?>>Maryland</option>
                    <option value="MA" <?php echo ($state == 'MA' ? 'selected' : '');?>>Massachusetts</option>
                    <option value="MI" <?php echo ($state == 'MI' ? 'selected' : '');?>>Michigan</option>
                    <option value="MN" <?php echo ($state == 'MN' ? 'selected' : '');?>>Minnesota</option>
                    <option value="MS" <?php echo ($state == 'MS' ? 'selected' : '');?>>Mississippi</option>
                    <option value="MO" <?php echo ($state == 'MO' ? 'selected' : '');?>>Missouri</option>
                    <option value="MT" <?php echo ($state == 'MT' ? 'selected' : '');?>>Montana</option>
                    <option value="NE" <?php echo ($state == 'NE' ? 'selected' : '');?>>Nebraska</option>
                    <option value="NV" <?php echo ($state == 'NV' ? 'selected' : '');?>>Nevada</option>
                    <option value="NH" <?php echo ($state == 'NH' ? 'selected' : '');?>>New Hampshire</option>
                    <option value="NJ" <?php echo ($state == 'NJ' ? 'selected' : '');?>>New Jersey</option>
                    <option value="NM" <?php echo ($state == 'NM' ? 'selected' : '');?>>New Mexico</option>
                    <option value="NY" <?php echo ($state == 'NY' ? 'selected' : '');?>>New York</option>
                    <option value="NC" <?php echo ($state == 'NC' ? 'selected' : '');?>>North Carolina</option>
                    <option value="ND" <?php echo ($state == 'ND' ? 'selected' : '');?>>North Dakota</option>
                    <option value="OH" <?php echo ($state == 'OH' ? 'selected' : '');?>>Ohio</option>
                    <option value="OK" <?php echo ($state == 'OK' ? 'selected' : '');?>>Oklahoma</option>
                    <option value="OR" <?php echo ($state == 'OR' ? 'selected' : '');?>>Oregon</option>
                    <option value="PA" <?php echo ($state == 'PA' ? 'selected' : '');?>>Pennsylvania</option>
                    <option value="RI" <?php echo ($state == 'RI' ? 'selected' : '');?>>Rhode Island</option>
                    <option value="SC" <?php echo ($state == 'SC' ? 'selected' : '');?>>South Carolina</option>
                    <option value="SD" <?php echo ($state == 'SD' ? 'selected' : '');?>>South Dakota</option>
                    <option value="TN" <?php echo ($state == 'TN' ? 'selected' : '');?>>Tennessee</option>
                    <option value="TX" <?php echo ($state == 'TX' ? 'selected' : '');?>>Texas</option>
                    <option value="UT" <?php echo ($state == 'UT' ? 'selected' : '');?>>Utah</option>
                    <option value="VT" <?php echo ($state == 'VT' ? 'selected' : '');?>>Vermont</option>
                    <option value="VA" <?php echo ($state == 'VA' ? 'selected' : '');?>>Virginia</option>
                    <option value="WA" <?php echo ($state == 'WA' ? 'selected' : '');?>>Washington</option>
                    <option value="WV" <?php echo ($state == 'WV' ? 'selected' : '');?>>West Virginia</option>
                    <option value="WI" <?php echo ($state == 'WI' ? 'selected' : '');?>>Wisconsin</option>
                    <option value="WY" <?php echo ($state == 'WY' ? 'selected' : '');?>>Wyoming</option>
                </select>
            
                <label for="Zipcode" >Zipcode</label>
                <input type="text" placeholder="Zipcode" name="Zipcode"
                       value="<?php echo $zipcode?>"> 
            
                <button name="propSearch" type="submit" value="search">
                    <i class="fa fa-search"></i>
                </button>
            </form>
        </div>
    </section>

    <!-- Banner -->
    <section id="secondbannerList">
        <form action="BogDelPropertyAction.php" method="post" >

            <!---Vacation Listings-->
            <ul class="article-list-vertical">
                
                <?php foreach($displayListings as $listing){ ?>
                <li>
                <font color='#000000'/>
                    <?php echo              
                        "  Property ID: " . $listing['PropertyIdPK'] .
                        "<br>  Property Title: " . $listing["PropertyTitle"]. 
                        "<br>  Property Type: ".$listing["PropertyTypeName"] . "<br>" .
                        "<br>  Address: " . $listing["Address"]. " ". 
                            $listing["City"]. ", ".$listing["State"]. " ".$listing["Zipcode"].  
                        "<br>".
                        "<br>  Number of Bedrooms: ".$listing["NumBedrooms"]. 
                        "<br>  Number of Bathrooms: ".$listing["NumBathrooms"]. 
                        "<br>  Square Footage: ".$listing["SqFt"]. 
                        "<br>  Number of Guests: ".$listing["GuestCnt"] ; 
                    
                        $imageName = (isset($listing['ImageName'])) 
                            ? $listing['ImageName']
                            : 'default-house.jpg'; 
                    ?>
                
                    <input type="hidden" name="propId" value="<?php echo $listing['PropertyIdPK']?>" />;
                    <img src="<?php echo '../images/'.$imageName?>" />
       
                    <p>Description: <?php echo $listing['Description']?></p><br />
                    
                    <font color='#000000'/>
                    <?php echo 'Price Per Night:  $' . $listing["DailyPrice"] ?>
                    
                    <br/>
                    <br/>
                    <button type="button" onclick="location.href='BogDelPropertyAction.php?propId=<?php echo $listing['PropertyIdPK']?>';return false;">Delete</button>
                    <button type="button" onclick="location.href='BogHome.php?propId=<?php echo $listing['PropertyIdPK']?>';return false;">Home Page</button>
                </li>
                <?php } ?>
            </ul>      
        </form>
    </section>

<?php
    displayPageFooter('');
?>

    
    
    