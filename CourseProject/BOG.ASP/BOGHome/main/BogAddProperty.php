<?php
/* 
    Class:          CIS665
    Assignment:     Course Project 
    Team-115:       Robert Palumbo, Kiana Vigil, Valerie Duran
    Due Date:       5.24.2019 @ 11:59pm

    Filename:       BogAddProperty.php
    
        Main entry point to the BOG Admin add property management page
*/ 
    // this method call should be placed at the start (top) of every php file that uses session variables

    session_start();

    require_once ("..\phpCommon\BogSiteCommon.php");
    require_once ("..\phpCommon\BogLibrary.php");
    require_once ("..\sqlCommon\bogSql.php");

    echo '<section>';

    // the session array element "userInfo" will be set (see d10loginform.php) if the user has been authenticated

    $userId = (isset($_SESSION['userInfo']))? $_SESSION['userInfo']['userId'] : "";   
    $roleType = (isset($_SESSION['userInfo']))? $_SESSION['userInfo']['roleType'] : "";   
    
    // Must be ADMIN to manage property
    if (($roleType != 1) || empty($userId)) {
        alertRedirect(3, 'BogHome.php', 
                     'Must be Admin to add properties.  You will now be redirected to our Home page.');
    }
    
    // Set some defaults first, they will be overwritten if they exist in the session
    $guestcnt = 0;
    $numbeds = 0;
    $numbaths = 0;
    $sqft = 0;
    $price = 0.00;
    
    // need to check if listing info exists in teh session and if so 
    // pre-populate the form using it
    
    if (isset($_SESSION['listInfo'])) {
        // Save the data to the session 
        $listInfo = $_SESSION['listInfo'];

        $proptype = $_SESSION['listInfo']['proptype'];        
        $title = $_SESSION['listInfo']['title'];
        $address = $_SESSION['listInfo']['address'];
        $city = $_SESSION['listInfo']['city'];
        $state = $_SESSION['listInfo']['state'];
        $zipcode = $_SESSION['listInfo']['zipcode'];
        $price = $_SESSION['listInfo']['price'];
        $numbeds = $_SESSION['listInfo']['numbeds'];
        $numbaths = $_SESSION['listInfo']['numbaths'];
        $guestcnt = $_SESSION['listInfo']['guestcnt'];
        $sqft = $_SESSION['listInfo']['sqft'];
        $pic = $_SESSION['listInfo']['pic'];
        $propdesc = $_SESSION['listInfo']['propdesc'];
        
        $imagefile = ($_FILES['uploadfile']['error'] != UPLOAD_ERR_OK)
                        ? '' : $_FILES['uploadfile']['tmp_name'];
        // Cleanup any text input
        $title = preg_replace("/[^a-zA-Z0-9\s'.]/", '', $title);
        $address = preg_replace("/[^a-zA-Z0-9\s'.]/", '', $address);
        $city = preg_replace("/[^a-zA-Z0-9\s'.]/", '', $city);
        $state = preg_replace("/[^a-zA-Z0-9\s]/", '', $state);
        $zipcode = preg_replace("/[^a-zA-Z0-9\s]/", '', $zipcode);
        $city = preg_replace("/[^a-zA-Z0-9\s]/", '', $city);
    }
        
//    var_dump($_SESSION['listInfo']);

    $tag = "Add Property Listing";

    displayPageHeader('..\cssStyles\BOG_Style_Layout_All.css', $tag);
    displayAddPropertyPage();
?>
    <section id="bannerList">       
        <h2>Add Property</h2>        
    </section>

    <section id="banner">
        <form action="BogAddPropertyAction.php" method='post'
              enctype ="multipart/form-data">
            <div class="containerAddProp">

                <!--dynamic menu option for property type-->
                <p>
                <label class="BogLabel" for="proptype">Property Type:</label>
                <select class="BogInput" name="proptype" id="proptype">
                    <?php
                        $proptypes = bogGetPropertyTypes();
                        
                        foreach ($proptypes as $proptype) {
                            extract($proptype);
                            $output .= <<<HTML
                            <option value="$PropertyTypeIdPK">$PropertyTypeName</option>
HTML;
                        }
                        echo "$output<br>";
                    ?>
                </select>
                </p>
                
                <!----- Listing Title -------------------------------------------------->
                <p>
                <label class="BogLabel" for="title">Listing Title:</label>
                <input class="BogInput" type="text" name="title" required
                       value="<?php echo $title?>"
                       maxlength="50"
                       pattern="^[a-zA-Z '!?.]{1,50}$"
                       title="Enter listing title">
                </p>

                <!----- Address -------------------------------------------------------->
                <p>
                <label class="BogLabel" for="address">Address:</label>
                <input class="BogInput" type="text" name="address" required
                       value="<?php echo $address?>"
                       maxlength="50"
                       pattern="^[a-zA-Z0-9 '.]{1,30}$"                       
                       title="Enter listing address">
                </p>

                <!----- City ---------------------------------------------------------->
                <p>
                <label class="BogLabel" for="city">City:</label>
                <input class="BogInput" type="text" name="city" required
                       value="<?php echo $city?>"                       
                       maxlength="30"
                       pattern="^[a-zA-Z '.]+$"
                       title="Enter listing city">
                </p>
                
                <!----- State ---------------------------------------------------------->
                <p>
                <label class="BogLabel" for="state">State:</label>
                <select class="BogInput" id="state" name="state" 
                        title="Select listing state">
                    <option value="" disabled selected="">Select listing state</option>
                    <option value="AL">Alabama</option>
                    <option value="AK">Alaska</option>
                    <option value="AZ">Arizona</option>
                    <option value="AR">Arkansas</option>
                    <option value="CA">California</option>
                    <option value="CO">Colorado</option>
                    <option value="CT">Connecticut</option>
                    <option value="DE">Delaware</option>
                    <option value="DC">District Of Columbia</option>
                    <option value="FL">Florida</option>
                    <option value="GA">Georgia</option>
                    <option value="HI">Hawaii</option>
                    <option value="ID">Idaho</option>
                    <option value="IL">Illinois</option>
                    <option value="IN">Indiana</option>
                    <option value="IA">Iowa</option>
                    <option value="KS">Kansas</option>
                    <option value="KY">Kentucky</option>
                    <option value="LA">Louisiana</option>
                    <option value="ME">Maine</option>
                    <option value="MD">Maryland</option>
                    <option value="MA">Massachusetts</option>
                    <option value="MI">Michigan</option>
                    <option value="MN">Minnesota</option>
                    <option value="MS">Mississippi</option>
                    <option value="MO">Missouri</option>
                    <option value="MT">Montana</option>
                    <option value="NE">Nebraska</option>
                    <option value="NV">Nevada</option>
                    <option value="NH">New Hampshire</option>
                    <option value="NJ">New Jersey</option>
                    <option value="NM">New Mexico</option>
                    <option value="NY">New York</option>
                    <option value="NC">North Carolina</option>
                    <option value="ND">North Dakota</option>
                    <option value="OH">Ohio</option>
                    <option value="OK">Oklahoma</option>
                    <option value="OR">Oregon</option>
                    <option value="PA">Pennsylvania</option>
                    <option value="RI">Rhode Island</option>
                    <option value="SC">South Carolina</option>
                    <option value="SD">South Dakota</option>
                    <option value="TN">Tennessee</option>
                    <option value="TX">Texas</option>
                    <option value="UT">Utah</option>
                    <option value="VT">Vermont</option>
                    <option value="VA">Virginia</option>
                    <option value="WA">Washington</option>
                    <option value="WV">West Virginia</option>
                    <option value="WI">Wisconsin</option>
                    <option value="WY">Wyoming</option>
                </select>
                </p>

                <!----- ZIP Code ---------------------------------------------------------->
                <p>
                <label class="BogLabel" for="zipcode">Zipcode:</label>
                <input class="BogInput" type="text" name="zipcode" required
                       value="<?php echo $zipcode?>"
                       maxlength="5"
                       pattern="^[0-9]{5}$"                       
                       title="Enter listing zipcode">
                </p>

                <hr>
                
                <p>
                <label class="BogLabel" for="price">Daily Price: $</label>
                <input class="BogInput" type="number" name="price" id="price" required 
                       maxlength="8" min="0.01" step="0.01" max="9999.99" 
                       value="<?php echo  sprintf("%.2f",$price)?>" 
                       style="width: 8em"
                       pattern="^[(\d{3})([\.])(\d{2})]{8}$"
                       title="Enter daily rental price"/>
                </p>
                
                <p>
                <label class="BogLabel" for="numbeds">Bedrooms:&nbsp;</label>
                <input class="BogInput" type="number" name="numbeds" id="numbeds" required 
                       maxlength="3" min="0" max="50" 
                       value="<?php echo $numbeds?>" 
                       style="width: 5em"
                       pattern="^[(0-9)]{3}$"
                       title="Enter number of bedrooms"/>
                </p>

                <p>
                <label class="BogLabel" for="numbaths">Bathrooms:&nbsp;</label>
                <input class="BogInput" type="number" name="numbaths" id="numbaths" required 
                       maxlength="3" min="0" max="50"
                       value="<?php echo $numbaths?>" 
                       pattern="^[(0-9)]{3}$"
                       style="width: 5em"
                       title="Enter number of bathrooms"/>
                </p>

                <p>
                <label class="BogLabel" for="guestcnt">Sleeps:&nbsp;</label>
                <input class="BogInput" type="number" name="guestcnt" id="guestcnt" required 
                       maxlength="3" min="0" max="50" 
                       value="<?php echo $guestcnt?>" 
                       pattern="^[(0-9)]{3}$"
                       style="width: 5em"
                       title="Enter maximum number of guests"/>
                </p>

                <p>
                <label class="BogLabel" for="sqft">Square Footage:&nbsp;</label>
                <input class="BogInput" type="number" name="sqft" id="sqft" required 
                       maxlength="3" min="0" max="10000" 
                       value="<?php echo $sqft?>" 
                       pattern="^[(0-9)]{5}$"
                       style="width: 5em"
                       title="Enter square footage of property"/>
                </p>
   
                <p>
                <label class="BogLabel" for="propdesc">Description:&nbsp;</label>
                <textarea class="BogInput" rows="5" cols="50" 
                          pattern="^[a-zA-Z0-9 '!?.]{1,250}$"  
                          value="<?php echo $propdessc?>"></textarea>
                </p>
                        
                <p>
                <label class="BogLabel" for="uploadfile">Image File:&nbsp;</label>                
                <input class="BogInput" type="file" name="uploadfile" id="imagename" maxlength="50" />
                </p>
                
                <!--Button Should reach out to php page and confirm user or admin access-->
                <br>
                <button name="propAdd" type="submit" value="add">Add</button>
                <button name="propReset" type="reset" value="reset">Reset</button>
                <button type="button" onclick="location.href='BogHome.php';return false;">Cancel</button>
            </div>
        </form>
    </section>

<?php
    displayPageFooter('');
?>