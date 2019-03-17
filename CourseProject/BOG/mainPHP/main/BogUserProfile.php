<?php
/* 
    Class:          CIS665
    Assignment:     Course Project 
    Team-115:       Robert Palumbo, Kiana Vigil, Valerie Duran
    Due Date:       5.24.2019 @ 11:59pm

    Filename:       BogUserProfile.php
    
        Main entry point to the BOG user profile management page
*/ 
    // this method call should be placed at the start (top) of every php file that uses session variables

    session_start();

    require_once ("..\phpCommon\BogSiteCommon.php");
    require_once ("..\phpCommon\BogLibrary.php");
    require_once ("..\sqlCommon\bogSql.php");

    echo '<section>';

    // the session array element "userInfo" will be set (see d10loginform.php) if the user has been authenticated

    $userId = (isset($_SESSION['userInfo']))? $_SESSION['userInfo']['userId'] : "";   
    $redirect = (isset($_REQUEST['redirect'])) ? $_REQUEST['redirect'] : 'BogHome.php';

    if (!empty($userId)) {
        $tag = "UserID='$userId' ASYNC with Register";
    } else {
        alertRedirect(3, 'BogHome.php',
                      'You must be logged on to update profile information.<br>'
                        . 'You will now be redirected to our home page.');
    }

    // Retrieve the user profile for the current user
    $userProf = bogGetUserProfByUserId($userId);
    
    echo "USER PROFILE <pre><br>";
    print_r($userProf);
    echo "</pre>";
//    die();
    
    // Check for any errors
    if (($errCode = bogGetLastErrorCode()) != 0) { 
        $err = "Failed to retrieve user profile from database, err='$errCode'<br><br>";
    } else if (count($userProf) == 0) {
        $err = "User profile for userId='$userId' not found!<br><br>";
    } else if (count($userProf) > 1) {
        $err = "Multiple property profiles for userId='$userId' found!<br><br>";
    } 
    
    // If any errors are encountered notify the user and bail out
    if (isset($err)) {
        alertRedirect(3, 'BogHome.php', $err);
    }

    // Now extract all the property field that can be updated.  
    // Email is read-only as that is the application level key 
    // to uniquely identify a user
    extract($userProf[0]);

    echo "STATE='$State'<br>";
    
    //echo ($State == 'AL') ? 'true' : 'false';
    echo ($State == 'AL' ? 'true' : 'false');
    displayPageHeader("../cssStyles/updateProfileCSS.css", $tag);
    displayUserProfilePage();
?>

    <!-- User profile management  -->
    <section id="banner">
        <form action="BogUserProfileAction.php" method='post'>
            <div class="container">
                <h2>Update Profile</h2>

                <!-- Hidden fields -->
                <input type="hidden" name ="redirect" value ="<?php echo $redirect ?>" />
                <input type="hidden" name ="userid" value ="<?php echo $userId ?>" />
                <input type="hidden" name ="roletype" value ="<?php echo $RoleIdFK ?>" />
                <input type="hidden" name ="ccnum" value ="<?php echo $CCNumber ?>" />
                <input type="hidden" name ="ccexpdate" value ="<?php echo $CCExpDate ?>" />
                <input type="hidden" name ="ruserid" value ="<?php echo $CCCvc ?>" />

                <!----- Email Id ---------------------------------------------------------->
                <label for="email">Email Address:</label>
                <input type="text" name="email" id="readonly" readonly
                       value="<?php echo $Email; ?>"
                       title="Readonly Field">

                <!----- Password ---------------------------------------------------------->
                <label for="password">Password:</label>
                <input type="password" name="password" required autofocus
                       value="<?php echo $Password; ?>"
                       maxlength="20"
                       title="Enter password (max 20 chars)">

                <!----- Password Conf---------------------------------------------------------->
                <label for="confpass">Confirm Password:</label>
                <input type="password" name="confpass" required autofocus
                       placeholder="Password-Confirmation"
                       maxlength="20"
                       title="Please confirm your password to update profile">

                <!--<pre></pre>-->

                <!----- Mobile Number ---------------------------------------------------------->
                <label for="phonenumber">Phone Number:</label>
                <input type="text" name="phonenumber" required autofocus
                       value="<?php echo $PhoneNumber?>"
                       maxlength="10"
                       pattern="^[0-9]{10}$"
                       title="Enter phone number">

                <!----- First Name ---------------------------------------------------------->
                <label for="firstname">First Name:</label>
                <input type="text" name="firstname" required autofocus
                       value="<?php echo $FirstName?>"
                       maxlength="30" 
                       pattern="^[a-zA-Z ']+$"
                       title="Enter first name (max 30 chars)">

                <!----- Last Name ---------------------------------------------------------->
                <label for="lastname">Last Name:</label>
                <input type="text" name="lastname" required autofocus
                       value="<?php echo $LastName?>"
                       maxlength="30" 
                       pattern="^[a-zA-Z ']+$"
                       title="Enter last name (max 30 chars)">

                <!----- Address ---------------------------------------------------------->
                <label for="address">Address:</label>
                <input type="text" name="address" required autofocus
                       value="<?php echo $Address?>"
                       maxlength="50"
                       title="Enter home address">

                <!----- City ---------------------------------------------------------->
                <label for="city">City:</label>
                <input type="text" name="city" required autofocus
                       value="<?php echo $City?>"
                       maxlength="30"
                       title="Enter home city (max 30 chars)">

                <!----- ZIP Code ---------------------------------------------------------->
                <label for="zipcode">Zipecode:</label>
                <input type="text" name="zipcode" required autofocus
                       value="<?php echo $Zipcode?>"
                       maxlength="5" 
                       pattern="^[0-9]{5}$"                       
                       title="Enter home zipcode">

                <!----- State ---------------------------------------------------------->
                <label for="state">State:</label>
                <select id="state" name="state" required autofocus
                        title="Enter home state">
                    <!--<option value=""></option>-->
                    <option value="" disabled selected><?php echo $State?></option>
                    <option value="AL" <?php echo ($State == 'AL' ? 'selected' : '');?>>Alabama</option>
                    <option value="AK" <?php echo ($State == 'AK' ? 'selected' : '');?>>Alaska</option>
                    <option value="AZ" <?php echo ($State == 'AZ' ? 'selected' : '');?>>Arizona</option>
                    <option value="AR" <?php echo ($State == 'AR' ? 'selected' : '');?>>Arkansas</option>
                    <option value="CA" <?php echo ($State == 'CA' ? 'selected' : '');?>>California</option>
                    <option value="CO" <?php echo ($State == 'CO' ? 'selected' : '');?>>Colorado</option>
                    <option value="CT" <?php echo ($State == 'CT' ? 'selected' : '');?>>Connecticut</option>
                    <option value="DE" <?php echo ($State == 'DE' ? 'selected' : '');?>>Delaware</option>
                    <option value="DC" <?php echo ($State == 'DC' ? 'selected' : '');?>>District Of Columbia</option>
                    <option value="FL" <?php echo ($State == 'FL' ? 'selected' : '');?>>Florida</option>
                    <option value="GA" <?php echo ($State == 'GA' ? 'selected' : '');?>>Georgia</option>
                    <option value="HI" <?php echo ($State == 'HI' ? 'selected' : '');?>>Hawaii</option>
                    <option value="ID" <?php echo ($State == 'ID' ? 'selected' : '');?>>Idaho</option>
                    <option value="IL" <?php echo ($State == 'IL' ? 'selected' : '');?>>Illinois</option>
                    <option value="IN" <?php echo ($State == 'IN' ? 'selected' : '');?>>Indiana</option>
                    <option value="IA" <?php echo ($State == 'IA' ? 'selected' : '');?>>Iowa</option>
                    <option value="KS" <?php echo ($State == 'KS' ? 'selected' : '');?>>Kansas</option>
                    <option value="KY" <?php echo ($State == 'KY' ? 'selected' : '');?>>Kentucky</option>
                    <option value="LA" <?php echo ($State == 'LA' ? 'selected' : '');?>>Louisiana</option>
                    <option value="ME" <?php echo ($State == 'ME' ? 'selected' : '');?>>Maine</option>
                    <option value="MD" <?php echo ($State == 'MD' ? 'selected' : '');?>>Maryland</option>
                    <option value="MA" <?php echo ($State == 'MA' ? 'selected' : '');?>>Massachusetts</option>
                    <option value="MI" <?php echo ($State == 'MI' ? 'selected' : '');?>>Michigan</option>
                    <option value="MN" <?php echo ($State == 'MN' ? 'selected' : '');?>>Minnesota</option>
                    <option value="MS" <?php echo ($State == 'MS' ? 'selected' : '');?>>Mississippi</option>
                    <option value="MO" <?php echo ($State == 'MO' ? 'selected' : '');?>>Missouri</option>
                    <option value="MT" <?php echo ($State == 'MT' ? 'selected' : '');?>>Montana</option>
                    <option value="NE" <?php echo ($State == 'NE' ? 'selected' : '');?>>Nebraska</option>
                    <option value="NV" <?php echo ($State == 'NV' ? 'selected' : '');?>>Nevada</option>
                    <option value="NH" <?php echo ($State == 'NH' ? 'selected' : '');?>>New Hampshire</option>
                    <option value="NJ" <?php echo ($State == 'NJ' ? 'selected' : '');?>>New Jersey</option>
                    <option value="NM" <?php echo ($State == 'NM' ? 'selected' : '');?>>New Mexico</option>
                    <option value="NY" <?php echo ($State == 'NY' ? 'selected' : '');?>>New York</option>
                    <option value="NC" <?php echo ($State == 'NC' ? 'selected' : '');?>>North Carolina</option>
                    <option value="ND" <?php echo ($State == 'ND' ? 'selected' : '');?>>North Dakota</option>
                    <option value="OH" <?php echo ($State == 'OH' ? 'selected' : '');?>>Ohio</option>
                    <option value="OK" <?php echo ($State == 'OK' ? 'selected' : '');?>>Oklahoma</option>
                    <option value="OR" <?php echo ($State == 'OR' ? 'selected' : '');?>>Oregon</option>
                    <option value="PA" <?php echo ($State == 'PA' ? 'selected' : '');?>>Pennsylvania</option>
                    <option value="RI" <?php echo ($State == 'RI' ? 'selected' : '');?>>Rhode Island</option>
                    <option value="SC" <?php echo ($State == 'SC' ? 'selected' : '');?>>South Carolina</option>
                    <option value="SD" <?php echo ($State == 'SD' ? 'selected' : '');?>>South Dakota</option>
                    <option value="TN" <?php echo ($State == 'TN' ? 'selected' : '');?>>Tennessee</option>
                    <option value="TX" <?php echo ($State == 'TX' ? 'selected' : '');?>>Texas</option>
                    <option value="UT" <?php echo ($State == 'UT' ? 'selected' : '');?>>Utah</option>
                    <option value="VT" <?php echo ($State == 'VT' ? 'selected' : '');?>>Vermont</option>
                    <option value="VA" <?php echo ($State == 'VA' ? 'selected' : '');?>>Virginia</option>
                    <option value="WA" <?php echo ($State == 'WA' ? 'selected' : '');?>>Washington</option>
                    <option value="WV" <?php echo ($State == 'WV' ? 'selected' : '');?>>West Virginia</option>
                    <option value="WI" <?php echo ($State == 'WI' ? 'selected' : '');?>>Wisconsin</option>
                    <option value="WY" <?php echo ($State == 'WY' ? 'selected' : '');?>>Wyoming</option>
                </select>

                <!--Button Should reach out to php page and confirm user or admin access-->
                <br>
                <button name="userUpdate" type="submit" value="update">Update</button>
                <button name="userReset" type="reset" value="reset">Reset</button>
                <button type="button" onclick="location.href='BogHome.php';return false;">Cancel</button>
            </div>
        </form>
    </section>

<?php
    displayPageFooter('');
?>