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
                       maxlength="50"
                       pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{3,50}$" 
                       title="Enter email address (max 50 chars)">

                <!----- Password ------------------------------------------------------->
                <label for="password">Password:</label>
                <input type="password" name="password" required
                       maxlength="20"
                       pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,20}" 
                       title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"

                <!----- Password Conf -------------------------------------------------->
                <label for="confpass">Confirm Password:</label>
                <input type="password" name="confpass" required
                       maxlength="20"
                       pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,20}" 
                       title="Enter password confirmation">

                <!--<pre></pre>-->

                <!----- Mobile Number -------------------------------------------------->
                <label for="phonenumber">Phone Number:</label>
                <input type="text" name="phonenumber" required
                       maxlength="10"
                       pattern="^[0-9]{10}$"
                       title="Enter 10-digit phone number">

                <!----- First Name ----------------------------------------------------->
                <label for="firstname">First Name:</label>
                <input type="text" name="firstname" required
                       maxlength="30"
                       pattern="^[a-zA-Z ']{1,30}$"
                       title="Enter first name">

                <!----- Last Name ------------------------------------------------------>
                <label for="lastname">Last Name:</label>
                <input type="text" name="lastname" required 
                       maxlength="30"
                       pattern="^[a-zA-Z ']{1,30}$"
                       title="Enter last name">

                <!----- Address -------------------------------------------------------->
                <label for="address">Address:</label>
                <input type="text" name="address" required
                       maxlength="50"
                       pattern="^[a-zA-Z0-9 ']{1,30}$"
                       title="Enter home address">

                <!----- City ----------------------------------------------------------->
                <label for="city">City:</label>
                <input type="text" name="city" required
                       maxlength="30"
                       pattern="^[a-zA-Z ']{1,30}$"
                       title="Enter home city">

                <!----- State ---------------------------------------------------------->
                <label for="state">State:</label>
                <select id="state" name="state" required
                        title="Select home state">
                    <option value="" disabled selected="">Select home state</option>
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
                </select><br>

                <!----- ZIP Code ------------------------------------------------------->
                <label for="zipcode">Zipcode:</label>                
                <input type="text" name="zipcode" required
                       maxlength="5"
                       pattern="^[0-9]{5}$"                       
                       title="Enter 5-digit zipcode">

                <div id="roletype">
                <label>    
                    <input type="radio" id="roletype" 
                           name="roletype" value="2" checked/>User Account&nbsp;&nbsp;
                </label>
                <label>    
                    <input type="radio" id="roletype"
                           name="roletype" value="1"/>Admin Account
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