<?php
/* 
    Class:          CIS665
    Assignment:     Course Project 
    Team-115:       Robert Palumbo, Kiana Vigil, Valerie Duran
    Due Date:       5.24.2019 @ 11:59pm

    Filename:       BogHome.php
    
        Main entry point to the BOG website
*/ 
    // this method call should be placed at the start (top) of every php file that uses session variables
    session_start();

    require_once ("..\phpCommon\BogSiteCommon.php");
    require_once ("..\sqlCommon\bogSql.php");

    $userName = (isset($_SESSION['userInfo'])) ? $_SESSION['userInfo']['firstName'] : "";   

    if (!empty($userName)) {
        $tag = "Welcome back to BeOurGuest, $userName!";
    } else {
        $tag = "Hello and welcome to BeOurGuest!";
    }
    
    displayPageHeader("..\cssStyles\BOG_Style_Layout_All.css", $tag);
    displayHomePage();
?>

    <section id="bannerHome">

        <!-- Home Page Custom Banner-->
        <h2>BeOurGuest</h2>
        <p>
            It's time to enjoy our wide range of vacation homes from city 
            townhomes, country cabins, luxury family homes, and even ocean 
            front condos <br>
            Your next getaway is waiting on you!<br>
        </p>
        <p>Book your perfect vacation home today! </p><br>
        
        
        <!----------Search form inside banner ----------- -->
        <div class="SearchState">
            <form  action="BogListings.php" method = "post" >
                <label for="proptype" >Property Type:</label>
                <!--dynamic menu option for property type-->
                <select name="proptype" id="proptype" >
                    $output = '<option value="" disabled selected>Property Type</option>;';
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

                <label for="city" >City:</label>
                <input type="text" placeholder="City" name="city">
            
                <label for="state">State:</label>
                <select id="state" name="state" title="Select state">
                    <option value="" disabled selected="">Select state</option>
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
            
                <label for="zipcode" >Zipcode:</label>
                <input type="text" placeholder="Zipcode" name="zipcode"
                        maxlength="5" 
                        pattern="^[0-9]{5}$"                       
                        size="5"
                        title="Enter 5-digit zipcode">
            
                <button name="propSearch" type="submit" value="search">
                    <i class="fa fa-search"></i>
                </button>
            </form>
        </div>
    </section>

    <section id="secondBannerHome">
        <!-- Home Page Custom Banner-->
        <h2>About</h2>
        <div id="about">
            <p>
            BeOurGuest was founded by Robert Palumbo, Valerie Duran, and Kiana Vigil in 2019. BeOurGuest (BOG) is a 
            web application that provides a variety of vacation rentals from trusted home owners. Our platform allows 
            homeowners to use our service to profit from travelers who would rather be comfortable in their own spacious 
            home, rather than staying at a hotel with limited space. As a startup company, it is our duty to approve and 
            perform background checks on all home owners for the safety of our customers. Our goal is to eliminate the 
            frustration of business for both the customer and home owner. Making it easier on the customer to compare homes 
            and prices, and for the home owners to get a guarantee customer base from our marketing strategies. We want our 
            customers to choose their own style of vacation home, whether they be on business or personal travel at a low cost, 
            competing with the highly rated hotels in the area. BOG is designed to be a one stop application that handles all 
            your travel lodging needs, beginning to end, in a clean, simple, and efficient manner.
            </p><br/>
        </div>
    </section>

<?php
    displayPageFooter('');
?>