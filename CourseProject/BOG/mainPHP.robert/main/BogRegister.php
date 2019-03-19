<?php
/* 
    Class:          CIS665
    Assignment:     Course Project 
    Team-115:       Robert Palumbo, Kiana Vigil, Valerie Duran
    Due Date:       5.24.2019 @ 11:59pm

    Filename:       BogRegister.php
    
        Main entry point to the BOG Register web page
*/ 
    // this method call should be placed at the start (top) of every php file that uses session variables

    session_start();

    require_once ("..\phpCommon\BogSiteCommon.php");
    require_once ("..\phpCommon\BogLibrary.php");
    require_once ("..\sqlCommon\bogSql.php");
    
    echo '<section>';

    // the session array element "userInfo" will be set (see d10loginform.php) if the user has been authenticated
    $redirect = (isset($_REQUEST['redirect'])) ? $_REQUEST['redirect'] : 'BogLoginPage.php';
    
//    echo "SESSION=";
//    print_r($_SESSION);
    
    // default to User account
    $roletype = 2;
    
    // Pre-populate form data if it is set in the session
    if (isset($_SESSION['regInfo'])) {
        $roletype = $_SESSION['regInfo']['roletype'];
        $email = $_SESSION['regInfo']['email'];
        $password = $_SESSION['regInfo']['password'];
        $firstname = $_SESSION['regInfo']['firstname'];
        $lastname = $_SESSION['regInfo']['lastname'];
        $address = $_SESSION['regInfo']['address'];
        $city = $_SESSION['regInfo']['city'];
        $state = $_SESSION['regInfo']['state'];
        $zipcode = $_SESSION['regInfo']['zipcode'];
        $phoneNumber = $_SESSION['regInfo']['phoneNumber'];
        $ccNumber = $_SESSION['regInfo']['ccNumber'];
        $ccExpDate = $_SESSION['regInfo']['ccExpDate'];
        $ccCvc = $_SESSION['regInfo']['ccCvc'];
    }

    echo "$roletype  $email  $password $firstName  $lastName $city $state $phoneNumber $ccNumber $ccExpDate  $ccCvc<br><br>";
    $tag = "Registration Page";

    displayPageHeader('..\cssStyles\updateProfileCSS.css', $tag);
    displayRegisterPage();
?>

    <section id="banner">
        <form action="BogRegisterAction.php" method='post'>
            <div class="container">

                <h2>Sign Up</h2>

                <!----- Email Id ------------------------------------------------------->
                <label for="email">Email Address:</label>
                <input type="text" name="email" required autofocus
                       value="<?php echo $email?>"
                       maxlength="50"
                       pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{3,50}$" 
                       title="Enter email address (max 50 chars)">

                <!----- Password ------------------------------------------------------->
                                       <!--pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,20}"--> 

                <label for="password">Password:</label>
                <input type="password" name="password" required
                       value="<?php echo $password?>"
                       maxlength="20"
                       title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"

                <!----- Password Conf -------------------------------------------------->
                       <!--pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,20}"--> 

                <label for="confpass">Confirm Password:</label>
                <input type="password" name="confpass" required
                       maxlength="20"
                       title="Enter password confirmation">

                <!--<pre></pre>-->

                <!----- Mobile Number -------------------------------------------------->
                <label for="phonenumber">Phone Number:</label>
                <input type="text" name="phonenumber" required
                       value="<?php echo $phoneNumber?>"
                       maxlength="10"
                       pattern="^[0-9]{10}$"
                       title="Enter 10-digit phone number">

                <!----- First Name ----------------------------------------------------->
                <label for="firstname">First Name:</label>
                <input type="text" name="firstname" required
                       value="<?php echo $firstname?>"
                       maxlength="30"
                       pattern="^[a-zA-Z ']{1,30}$"
                       title="Enter first name">

                <!----- Last Name ------------------------------------------------------>
                <label for="lastname">Last Name:</label>
                <input type="text" name="lastname" required 
                       value="<?php echo $lastname?>"
                       maxlength="30"
                       pattern="^[a-zA-Z ']{1,30}$"
                       title="Enter last name">

                <!----- Address -------------------------------------------------------->
                <label for="address">Address:</label>
                <input type="text" name="address" required
                       value="<?php echo $address?>"
                       maxlength="50"
                       pattern="^[a-zA-Z0-9 ']{1,30}$"
                       title="Enter home address">

                <!----- City ----------------------------------------------------------->
                <label for="city">City:</label>
                <input type="text" name="city" required
                       value="<?php echo $city?>"
                       maxlength="30"
                       pattern="^[a-zA-Z ']{1,30}$"
                       title="Enter home city">

                <!----- State ---------------------------------------------------------->
                State:&nbspl&nbsp;
                <select id="state" name="state" required autofocus
                        style="height: 30px"
                        title="Enter home state">
                    <!--<option value=""></option>-->
                    <option value="" disabled selected><?php echo $state?></option>
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
                </select><br>

                <!----- ZIP Code ------------------------------------------------------->
                <label for="zipcode">Zipcode:</label>                
                <input type="text" name="zipcode" required
                       value="<?php echo $zipcode?>"
                       maxlength="5"
                       pattern="^[0-9]{5}$"                       
                       title="Enter 5-digit zipcode">

                <div id="roletype">
                <label>    
                    <input type="radio" id="roletype" value="2"
                           name="roletype" 
                           <?php echo ($roletype == 2 ? 'checked' : '');?>>User Account&nbsp;&nbsp;
                </label>
                <label>    
                    <input type="radio" id="roletype" value="1"
                           name="roletype" 
                           <?php echo ($roletype == 1 ? 'checked' : '');?>>Admin Account
                </label>
                </div>
                
                <!--Button Should reach out to php page and confirm user or admin access-->
                <div id="button">
                    <button name="regSubmit" type="submit" value="register">Register</button>
                    <button name="regReset" type="reset" value="reset">Reset</button>
                    <button type="button" onclick="location.href='BogHome.php';return false;">Cancel</button>
                </div>
            </div>
        </form>
    </section>

<?php
    displayPageFooter('');
?>